<?php

namespace Modules\ContentManagement\Http\Controllers\admin;

use App\Traits\SetResponse;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Modules\ContentManagement\Entities\Gallery;
use Modules\ContentManagement\Entities\GalleryImage;

class StorageController extends Controller
{
    use SetResponse;

    public function index()
    {
        return view('contentmanagement::admin.storage.index');
    }

    public function gallery_index()
    {
        return view('contentmanagement::admin.storage.gallery-index');
    }

    public function galleryImages($galleryId)
    {
        return view('contentmanagement::admin.storage.gallery-images', compact('galleryId'));
    }

    public function getGalleries()
    {
        $galleries = Gallery::with('images')->get();

        $responseData = $this->prepareResponse(false, 'success', compact('galleries'), []);
        return response()->json($responseData);
    }

    public function getGalleryImages($gallery_id)
    {
        $gallery = Gallery::with('images')->whereId($gallery_id)->first();

        $responseData = $this->prepareResponse(false, 'success', compact('gallery'), []);
        return response()->json($responseData);
    }

    public function createGallery(Request $request)
    {
        $request->validate([
            'title' => 'required'
        ]);

        try{
            if ($request->has('gallery_id') AND !blank($request->gallery_id)){
                $gallery = Gallery::findOrFail($request->gallery_id);
            }else{
                $gallery = new Gallery();
            }

            $gallery->title = $request->title;
            $gallery->slug = Str::slug($request->title, '-');
            $gallery->created_by = auth()->user()->id;
            $gallery->save();

            $responseData = $this->prepareResponse(false, 'Success <br> Gallery created successfully.', [], []);
            return response()->json($responseData);
        }catch (\Exception $exception){
//            $responseData = $this->prepareResponse(true, 'Error <br> Gallery could not be created.', [], []);
            $responseData = $this->prepareResponse(true, $exception->getMessage(), [], []);
            return response()->json($responseData, 500);
        }
    }

    public function addImageToGallery(Request $request)
    {
        $request->validate([
            'gallery_id' => 'required',
            'image' => 'required',
        ]);

        try {
            $path = $request->file('image')->store('gallery_images', 'public');
            $galleryImage = new GalleryImage();
            $galleryImage->gallery_id = $request->gallery_id;
            $galleryImage->image_original = $path;
            $galleryImage->save();

            $responseData = $this->prepareResponse(false, 'Success <br> Gallery created successfully.', [], []);
            return response()->json($responseData);
        }catch (\Exception $exception){
            $responseData = $this->prepareResponse(true, $exception->getMessage(), [], []);
            return response()->json($responseData, 500);
        }
    }

    public function removeImageFromGallery($gallery_image_id)
    {
        try {
            $galleryImage = GalleryImage::findOrFail($gallery_image_id);
            // remove file
            $galleryImage->delete();

            $responseData = $this->prepareResponse(false, 'Success <br> Image removed successfully.', [], []);
            return response()->json($responseData);
        }catch (\Exception $exception){
            $responseData = $this->prepareResponse(true, 'Error <br> Image could not be removed.', [], []);
            return response()->json($responseData, 500);
        }
    }

    public function removeGallery($gallery_id)
    {
        try {
            $gallery = Gallery::findOrFail($gallery_id);
            $gallery_images = $gallery->images();
            // remove files

            $gallery_images->delete();
            $gallery->delete();

            $responseData = $this->prepareResponse(false, 'Success <br> Gallery and images removed successfully.', [], []);
            return response()->json($responseData);
        }catch (\Exception $exception){
            $responseData = $this->prepareResponse(true, $exception->getMessage(), [], []);
            return response()->json($responseData, 500);
        }
    }
}
