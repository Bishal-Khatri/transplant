<?php

namespace Modules\Grocery\Http\Controllers;

use App\Traits\FileStore;
use App\Traits\SetResponse;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Modules\Grocery\Entities\Brand;
use File;
class BrandController extends Controller
{
    use SetResponse, FileStore;
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('grocery::brand.index');
    }

    public function listing(Request $request)
    {
        $filter = $request->filter ? $request->filter : '';
        $query = Brand::query();
        $query->where('name', 'LIKE', '%'.$filter.'%');
        $query->orderBy('id', 'desc');
        $brands = $query->paginate(20);
        $returnData = $this->prepareResponse(false, 'success', compact('brands'), []);
        return response()->json($returnData, 200);
    }

    public function save(Request $request)
    {
        $request->validate([
            'brand_name' => 'required|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if (isset($request->id) AND !blank($request->id)){
            $brand = Brand::find($request->id);
        }else{
            $brand = new Brand();
        }
        if ($request->hasFile('main_image')){
            if (isset($request->id) AND !blank($request->id)){
                // remove old file
                $this->removeFile($brand);
            }
            $image = $request->file('main_image');
            $url = $this->saveImage($image, 'grocery_brands');
            $brand->image_original = $url['original'];
            $brand->image_large = $url['large'];
            $brand->image_medium = $url['medium'];
            $brand->image_thumbnail = $url['thumbnail'];
        }


        $brand->name = $request->brand_name;
        $brand->save();
        $returnData = $this->prepareResponse(false, 'Success <br> Brand created successfully', [], []);
        return response()->json($returnData, 200);
    }

    public function delete(Request $request, $brand_id)
    {
        try {
            $brand = Brand::findOrFail($brand_id);

            if (isset($request->type) AND $request->type == 'permanent'){
                // remove files
                $this->removeFile($brand);

                $brand->forceDelete();
            } else {
                $brand->delete();
            }

            $returnData = $this->prepareResponse(false, 'Success <br> Record deleted successfully.', [], []);
            return response()->json($returnData, 200);
        } catch (\Exception $e) {
            $returnData = $this->prepareResponse(true, "Fail <br>Could not delete record.", [], []);
            return response()->json($returnData, 500);
        }
    }

    public function removeFile(Brand $brand)
    {
        Storage::delete('public/'.$brand->image_original);
        Storage::delete('public/'.$brand->image_large);
        Storage::delete('public/'.$brand->image_medium);
        Storage::delete('public/'.$brand->image_thumbnail);
    }
}
