<?php

namespace Modules\Grocery\Http\Controllers;

use App\Enum\ContentType;
use App\Models\Category;
use App\Traits\SetResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Application\Entities\Banner;
use Modules\Grocery\Entities\Brand;
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
                $current_price = $value->currentPrice();
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
                    'current_price' => $current_price,
                    'old_price' => null,
                    'has_discount' => false,
                ];
            })
        );
        $categories = Category::where('type', ContentType::GROCERY)->get();
        $brands = Brand::all();
        $banner = Banner::where('key', 'grocery')->get();
        $returnData = $this->prepareResponse(false, 'success', compact('items', 'categories', 'brands', 'banner'), []);
        return response()->json($returnData, 200);
    }

    public function show(Request $request)
    {
        if (isset($request->item_id) AND !blank($request->item_id)){
            $item = Item::where('id', $request->item_id)->with(['brand', 'category', 'images'])->first();
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
