<?php

namespace Modules\ContentManagement\Http\Controllers\admin;

use App\Traits\FileStore;
use App\Traits\SetResponse;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Modules\ContentManagement\Entities\Gallery;
use Modules\ContentManagement\Entities\Page;
use Illuminate\Support\Str;
use Modules\ContentManagement\Entities\PageCategory;
use Modules\ContentManagement\Entities\PageSection;
use Modules\ContentManagement\Enum\ContentType;

class PageController extends Controller
{
    use SetResponse, FileStore;

    public function index()
    {
        $pages = Page::where('content_type', ContentType::PAGE)->orderBy('id', 'desc')->get();
        return view('contentmanagement::admin.page.index', compact('pages'));
    }

    public function create()
    {
        $page = new Page();
        $page->title = 'Untitled';
        $page->slug = Str::random(50);
        $page->content_type = ContentType::PAGE;
        $page->created_by = auth()->user()->id;
        $page->visibility = 1;
        $page->save();

        return redirect()->route('cms.page.edit', $page->id);
    }

    public function updatePage(Request $request)
    {
        $page = Page::whereId($request->page_id)->firstOrFail();
        $page->title = $request->title;
        $page->slug = Str::slug($request->title, '-');
        $page->short_description = $request->short_description;
        $page->category_id = $request->category_id;
        $page->save();

        $returnData = $this->prepareResponse(false, 'Success<br> Page updated successfully.', [], []);
        return response()->json($returnData, 200);
    }

    public function edit($id)
    {
        $page = Page::findOrFail($id);
        $galleries = Gallery::all();
        $sliders = Gallery::all();
        $categories = PageCategory::where('type', ContentType::PAGE)->get();
        return view('contentmanagement::admin.page.edit', compact('page', 'galleries','categories', 'sliders'));
    }

    public function pageDetails($id)
    {
        $page = Page::with(['sections'])->whereId($id)->firstOrFail();
        $categories = PageCategory::where('type', ContentType::PAGE)->get();
        $returnData = $this->prepareResponse(false, 'success', compact('page', 'categories'), []);
        return response()->json($returnData, 200);
    }

    public function deleteSection($id)
    {
        try{
            $section = PageSection::findOrFail($id);
            if (isset($section->image_url) AND !blank($section->image_url)) {
                Storage::delete('public/' . $section->image_url);
            }
            $section->delete();

            $returnData = $this->prepareResponse(false, 'Success<br> Record deleted successfully.', [], []);
            return response()->json($returnData, 200);
        }catch (\Exception $e){
            $returnData = $this->prepareResponse(true, 'Error <br> Error deleting record.', [], []);
            return response()->json($returnData, 200);
        }

    }

    public function addSection(Request $request)
    {
        $request->validate([
            'page_id' => 'required|integer',
            'section_name' => 'required',
            'section_type' => 'required',
        ]);

        $section = new PageSection();
        $section->page_id = $request->page_id;
        $section->title = 'Untitled';
        $section->order = 0;
        $section->section_type = $request->section_type;
        $section->section_name = $request->section_name;
        $section->visibility = 0;
        $section->save();

        $returnData = $this->prepareResponse(false, 'Success <br>Section Added Successfully.', [], []);
        return response()->json($returnData, 200);
    }

    public function updateSection(Request $request)
    {
//        dd($request->all());
        $request->validate([
            'section_id' => 'required|integer',
        ]);
        $section = PageSection::findOrFail($request->section_id);

        if ($request->hasFile('image')){
            if (isset($section->image_url) AND !blank($section->image_url)){
                // remove old file
                Storage::delete('public/'.$section->image_url);
            }
            $image = $request->file('image');
            $resolution = [
                'large' => [1000,1000],
            ];
            $url = $this->saveImage($image, 'page_images', $resolution);
            $section->image_url =  $url['large'];
        }

        $section->order = $request->order ? $request->order : 0;
        $section->slider_id = $request->slider_id;
        $section->title = $request->title;
        $section->text = $request->text;
        $section->pdf_url = $request->pdf_url;
        $section->gallery_id = $request->gallery_id;
        $section->file_download_urls = $request->file_download_urls;
        $section->visibility = $request->visibility;
        $section->save();

        $returnData = $this->prepareResponse(false, 'Success <br>Section Added Successfully.', [], []);
        return response()->json($returnData, 200);
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return view('contentmanagement::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */


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
        //
    }
}
