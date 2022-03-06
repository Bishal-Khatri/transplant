<?php

namespace Modules\Grocery\Http\Controllers;

use App\Traits\SetResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Grocery\Entities\Brand;
use Modules\Grocery\Entities\GroceryCategory;
use Modules\Grocery\Entities\Item;

class ApiController extends Controller
{
    use SetResponse;
    public function listItems(Request $request)
    {
        $filter = $request->filter ? $request->filter : '';
        $category = $request->category ? $request->category : '';
        $brand = $request->brand ? $request->brand : '';
        $query = Item::query();
        $query->with(['category', 'brand', 'images'])->where('parent_id', null)
            ->where('name', 'LIKE', '%'.$filter.'%')
            ->orderBy('id', 'desc');
        if (!blank($category)){
            $query->whereHas('category', function($q) use ($category) {
                $q->where('id', '=', $category);
            });
        }
        if (!blank($brand)){
            $query->whereHas('brand', function($q) use ($brand) {
                $q->where('id', '=', $brand);
            });
        }
        $items = $query->paginate(20);

        $items->setCollection(
            $items->getCollection()->transform(function ($value) {
                $quantity = $value->quantity();
                return [
                    'id' => $value->id,
                    'sku' => $value->sku,
                    'name' => $value->name,
                    'description' => $value->description,
                    'main_image_original' => $value->main_image_original,
                    'main_image_large' => $value->main_image_large,
                    'main_image_medium' => $value->main_image_medium,
                    'main_image_thumbnail' => $value->main_image_thumbnail,
                    'category' => $value->category,
                    'brand' => $value->brand,
                    'quantity' => $quantity,
                    'images' => $value->images,
                ];
            })
        );
        $categories = GroceryCategory::all();
        $brands = Brand::all();
        $returnData = $this->prepareResponse(false, 'success', compact('items', 'categories', 'brands'), []);
        return response()->json($returnData, 200);
    }

    public function show($id)
    {
        if ($id){
            $item = Item::where('id', $id)->with(['brand', 'category', 'images'])->first();
            $inventory_details = [
                'available_quantity' => $item->quantity(),
                'max_price' => $item->itemMaxPrice(),
            ];
            $returnData = $this->prepareResponse(false, 'success', compact('item', 'inventory_details'), []);
        }else{
            $returnData = $this->prepareResponse(true, 'item not found.', [], []);
        }
        return response()->json($returnData, 200);
    }

}