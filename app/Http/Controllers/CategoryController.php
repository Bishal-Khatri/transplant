<?php

namespace App\Http\Controllers;

use App\Enum\CategoryType;
use App\Models\Category;
use App\Traits\FileStore;
use App\Traits\SetResponse;
use App\Traits\Slug;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    use Slug,FileStore, SetResponse;
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function groceryIndex()
    {
        $type = CategoryType::GROCERY;
        $categories = Category::with('parent')->where('type', CategoryType::GROCERY)->orderBy('id', 'desc')->paginate(10);
        $root_categories = Category::where('parent_id', 0)->where('type', CategoryType::GROCERY)->get();

        return view('category.index', compact('categories', 'root_categories', 'type'));
    }

    public function restaurantIndex()
    {
        $type = CategoryType::RESTAURANT;
        $categories = Category::with('parent')->where('type', CategoryType::RESTAURANT)->orderBy('id', 'desc')->paginate(10);
        $root_categories = Category::where('parent_id', 0)->where('type', CategoryType::RESTAURANT)->get();

        return view('category.index', compact('categories', 'root_categories', 'type'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if (isset($request->id) AND !blank($request->id)){
            $cat = Category::find($request->id);
        } else {
            $cat = new Category();
            $cat->type = $request->type;
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
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $root_categories = Category::where('id', '<>', $id)->where('type', CategoryType::GROCERY)->where('parent_id', 0)->get();
        $category_data = Category::with(['parent'])->where('type', CategoryType::GROCERY)->where('id', $id)->firstOrFail();

        return view('category.edit', compact('category_data', 'root_categories'));
    }

    /**
     * Remove the specified resource from storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function destroy(Request $request, $id)
    {
        $category = Category::with('child')->where('id', $id)->firstOrFail();

        // remove parent
        if(!blank($category->child)){
            foreach($category->child as $value){
                $value->parent_id = 0;
                $value->save();
            }
        }

        if (isset($request->type) AND $request->type == 'permanent'){
            // remove files
            $this->removeFile($category);

            $category->forceDelete();
        } else {
            $category->delete();
        }

        session()->flash('success', 'Success <br> Category deleted successfully.');
        return response()->json($this->prepareResponse(false, 'Success', [], []));
    }

    /**
     * @param Category $cat
     */
    public function removeFile(Category $cat)
    {
        Storage::delete('public/'.$cat->image_original);
        Storage::delete('public/'.$cat->image_large);
        Storage::delete('public/'.$cat->image_medium);
        Storage::delete('public/'.$cat->image_thumbnail);
    }


}
