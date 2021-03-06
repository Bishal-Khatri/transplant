<?php

namespace Modules\Grocery\Http\Controllers;

use App\Enum\CategoryType;
use App\Models\Category;
use App\Traits\FileStore;
use App\Traits\SetResponse;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Modules\Grocery\Entities\Brand;
use Modules\Grocery\Entities\Item;
use Modules\Grocery\Entities\ItemImage;
use Modules\Grocery\Entities\ItemQuantity;

class ItemController extends Controller
{
    use SetResponse, FileStore;

    public function index()
    {
        return view('grocery::item.index');
    }

    public function edit($id)
    {
        $brands = Brand::all();
        $categories = Category::where('type', CategoryType::GROCERY)->get();
        $item = Item::findOrFail($id);

        return view('grocery::item.edit', compact('brands', 'categories', 'item'));
    }

    public function listing(Request $request)
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
                $variants = [];
                $stock_level = null;

                if ($value->has_variant){
                    $variants_all = $value->load('variants');
                    $variants = $variants_all->variants;
                    $variants = $variants->map(function ($item) {
                        $item->quantity = $item->quantity();
                        $item->stock = $item->stockLevel();
                        return $item;
                    });
                } else {
                    $stock_level = $value->stockLevel();
                }

                return [
                    'id' => $value->id,
                    'sku' => $value->sku,
                    'name' => $value->name,
                    'description' => $value->description,
                    'service_charge' => $value->service_charge,
                    'main_image_original' => $value->main_image_original,
                    'main_image_large' => $value->main_image_large,
                    'main_image_medium' => $value->main_image_medium,
                    'main_image_thumbnail' => $value->main_image_thumbnail,
                    'category_id' => $value->category_id,
                    'brand_id' => $value->brand_id,
                    'category' => $value->category,
                    'brand' => $value->brand,
                    'quantity' => $quantity,
                    'stock' => $stock_level,
                    'has_variant' => $value->has_variant,
                    'parent_id' => $value->parent_id,
                    'variations' => $variants,
                    'min_quantity_threshold' => $value->min_quantity_threshold,
                    'images' => $value->images,
                    'images_count' => count($value->images),
                    'created_at' => $value->created_at,
                ];
            })
        );

        $categories = Category::where('type', CategoryType::GROCERY)->get();
        $brands = Brand::all();

        $returnData = $this->prepareResponse(false, 'success', compact('items', 'categories', 'brands'), []);
        return response()->json($returnData, 200);
    }

    public function save(Request $request)
    {
        $request->validate([
            'item_name' => 'required|max:255',
            'sku' => 'nullable|max:50',
            'unit_size' => 'nullable|max:50',
            'min_quantity_threshold' => 'nullable|integer',
        ]);

        if ($request->item_id) {
            $item = Item::findOrFail($request->item_id);
        } else {
            $item = new Item();
        }

        if ($request->hasFile('main_image')){
            $main_image = $this->saveImage($request->main_image, 'items');
            $item->main_image_original = $main_image['original'];
            $item->main_image_large = $main_image['large'];
            $item->main_image_medium = $main_image['medium'];
            $item->main_image_thumbnail = $main_image['thumbnail'];
        }

        $item->name = $request->item_name;
        $item->sku = $request->sku;
        $item->service_charge = $request->service_charge;
        $item->unit_size = $request->unit_size;
        $item->description = $request->description;
        $item->category_id = $request->category_id ? $request->category_id : null;
        $item->brand_id = $request->brand_id ? $request->brand_id : null;
        $item->save();

        $returnData = $this->prepareResponse(false, 'Success <br> Item created/updated successfully', compact('item'), []);
        return response()->json($returnData, 200);
    }

    public function addQuantity(Request $request)
    {
        $request->validate([
            'item_id' => 'required|integer',
            'quantity' => 'required|integer',
            'selling_price' => 'required',
        ]);

        $quantity = new ItemQuantity();
        $quantity->item_id = $request->item_id;
        $quantity->quantity = $request->quantity;
        $quantity->initial_quantity = $request->quantity;
        $quantity->purchase_price = $request->purchase_price;
        $quantity->selling_price = $request->selling_price;
        $quantity->purchase_date = $request->purchase_date;
        $quantity->save();

        $returnData = $this->prepareResponse(false, 'Success <br> Quantity added successfully', [], []);
        return response()->json($returnData, 200);
    }

    public function getItemDetails($item_id)
    {
        $item_data = Item::where('id', $item_id)->with(['brand', 'category', 'images'])->first();
//        dd($item_data->itemLatestPrice());
        $inventory_details = [
            'quantity' => $item_data->quantityList,
            'available_quantity' => $item_data->quantity(),
            'max_price' => $item_data->itemMaxPrice(),
            'current_price' => $item_data->currentPrice(),
            'old_price' => null,
            'stock_level' => $item_data->stockLevel(),
        ];

        $returnData = $this->prepareResponse(false, 'success', compact('item_data', 'inventory_details'), []);
        return response()->json($returnData, 200);
    }

    public function delete(Request $request, $item_id)
    {
        try {
            $item = Item::findOrFail($item_id);

            if (isset($request->type) AND $request->type == 'permanent'){
                Storage::delete('public/'.$item->main_image_original);
                Storage::delete('public/'.$item->main_image_large);
                Storage::delete('public/'.$item->main_image_medium);
                Storage::delete('public/'.$item->main_image_thumbnail);

                $item->forceDelete();

            } else {
                $item->delete();
            }

            $returnData = $this->prepareResponse(false, 'Success <br> Record deleted successfully.', [], []);
            return response()->json($returnData, 200);
        } catch (\Exception $e) {
            $returnData = $this->prepareResponse(true, "Fail <br> Could not delete record.", [], []);
            return response()->json($returnData, 500);
        }
    }

    public function deleteQuantity($item_quantity_id)
    {
        try {
            $itemQuantity = ItemQuantity::findOrFail($item_quantity_id);
            $itemQuantity->delete();

            $returnData = $this->prepareResponse(false, 'Success <br> Record deleted successfully.', [], []);
            return response()->json($returnData, 200);
        } catch (\Exception $e) {
            $returnData = $this->prepareResponse(true, "Fail <br> Could not delete record.", [], []);
            return response()->json($returnData, 500);
        }
    }

    public function uploadAdditionalImage(Request $request)
    {
        $request->validate([
            'item_id' => 'required|int',
            'file' => 'required',
        ]);

        $file = $request->file('file');
        $item = Item::findOrFail($request->item_id);

//            // check for old logo
//            if ($college->logo){
//                Storage::disk('local')->delete('public/'. $college->logo);
//                File::delete(public_path($college->logo_thumbnail));
//            }
        $filePath = $file->store('item_additional_images', 'public');

        $item_image = new ItemImage();
        $item_image->original = $filePath;
        $item_image->item_id = $item->id;
        $item_image->save();

        $returnData = $this->prepareResponse(false, 'Success <br> Image uploaded successfully', [], []);
        return response()->json($returnData);
    }
    public function deleteAdditionalImage($image_id)
    {
        if ($image_id) {
            $item_image = ItemImage::findOrFail($image_id);

            Storage::disk('local')->delete('public/' . $item_image->original);

            $item_image->delete();

            $returnData = $this->prepareResponse(false, 'Success <br> Image deleted successfully', [], []);
            return response()->json($returnData);
        }
    }
}
