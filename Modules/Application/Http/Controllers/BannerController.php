<?php

namespace Modules\Application\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Modules\Application\Entities\Banner;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $banners = Banner::orderBy('key')->get()->groupBy('key');
        return view('application::banner.index', compact('banners'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'key' => 'required',
            'image' => 'required'
        ]);

        if ($request->hasFile('image')){
            $image = $request->file('image');
            $path = "banners/850x475".$image->hashName();
            $image_large = Image::make($image)->resize(850, 475)->encode();

            Storage::put('public/'.$path, (string) $image_large);

            $banner = new Banner();
            $banner->key = $request->key;
            $banner->image = $path;
            $banner->save();
        }

        session()->flash('success', "Success <br> Banner created successfully.");
        return redirect(route('application.banners'));
    }

    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);
        if (Banner::where('key', $banner->key)->count() <= 1){
            session()->flash('error', "Error !! <br> Cannot delete last banner.");
            return redirect(route('application.banners'));
        }

        $banner->delete();
        session()->flash('success', "Success <br> Banner deleted successfully.");
        return redirect(route('application.banners'));
    }
}
