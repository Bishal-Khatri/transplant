<?php

namespace Modules\Grocery\Http\Controllers;

use App\Traits\FileStore;
use App\Traits\SetResponse;
use App\Traits\Slug;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Modules\Grocery\Entities\GroceryCategory;

class GroceryCategoryController extends Controller
{
    use Slug,FileStore, SetResponse;
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $categories = GroceryCategory::with('parent')->orderBy('id', 'desc')->paginate(10);
        $root_categories = GroceryCategory::where('parent_id', 0)->get();
        return view('grocery::category.index', compact('categories', 'root_categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if (isset($request->id) AND !blank($request->id)){
            $cat = GroceryCategory::find($request->id);
        }else{
            $cat = new GroceryCategory();
        }

        if ($request->hasFile('image')){
            if (isset($request->id) AND !blank($request->id)){
                // remove old file
                $this->removeFile($cat);
            }
            $image = $request->file('image');
            $url = $this->saveImage($image, 'grocery_category');
            $cat->image_original = $url['original'];
            $cat->image_large = $url['large'];
            $cat->image_medium = $url['medium'];
            $cat->image_thumbnail = $url['thumbnail'];
        }
        $cat->name = $request->name;
        $cat->slug = $this->createSlug($request->name);
        $cat->parent_id = !blank($request->parent) ? $request->parent : 0;
        $cat->save();
        session()->flash('success', 'Success <br> Category created/updated successfully.');
        return redirect(route('grocery.category.index'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('grocery::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $root_categories = GroceryCategory::where('id', '<>', $id)->where('parent_id', 0)->get();
        $category_data = GroceryCategory::with(['parent'])->where('id', $id)->firstOrFail();
        return view('grocery::category.edit', compact('category_data', 'root_categories'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $category = GroceryCategory::findOrFail($id);
        // remove files
        $this->removeFile($category);
        $category->delete();
        session()->flash('success', 'Success <br> Category deleted successfully.');
        return response()->json($this->prepareResponse(false, 'Success', [], []));

//        return redirect()->route('grocery.category.index');
    }

    /**
     * @param GroceryCategory $cat
     */
    public function removeFile(GroceryCategory $cat)
    {
        Storage::delete($cat->image_original);
        Storage::delete($cat->image_large);
        Storage::delete($cat->image_medium);
        Storage::delete($cat->image_thumbnail);
    }


}
