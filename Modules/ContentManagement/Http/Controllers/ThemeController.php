<?php

namespace Modules\ContentManagement\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ContentManagement\Entities\Page;
use Modules\ContentManagement\Entities\Theme;
use Modules\ContentManagement\Enum\ContentType;

class ThemeController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $active_theme = Theme::where('is_active', 1)->first();

        if (!$active_theme OR blank($active_theme)){
            return abort(404, 'Theme not activated');
        }

        $content = Page::where('content_type', ContentType::PAGE)->where('visibility', 1)->with('sections')->whereId($active_theme->homepage_id)->first();

        if (!$content OR blank($content)){
            return view('contentmanagement::default-page');
        }

        $index_file = 'contentmanagement::theme'.'.'.$active_theme->name.'.'.'index';
        return view($index_file, compact('content', 'active_theme'));
    }

    public function adminIndex()
    {
        if (!Theme::where('is_active', 1)->exists()){
            Theme::create([
                'name' => 'Default',
                'is_active' => 1
            ]);
        }
        $active_theme = Theme::where('is_active', 1)->first();
        $pages = Page::where('visibility', 1)->get();
        return view('contentmanagement::admin.theme.index', compact('active_theme', 'pages'));
    }

    public function updateTheme(Request $request)
    {
        $theme_id = $request->theme_id;

        if (!$theme_id){
            $theme = new Theme();
        }else{
            $theme = Theme::findOrFail($theme_id);
        }
        $theme->homepage_id = $request->homepage_id;
        $theme->title = $request->title;
        $theme->copyright = $request->copyright_text;
        $theme->save();

        session()->flash('success', 'Success <br> Theme updated successfully.');
        return redirect()->back();
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('contentmanagement::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('contentmanagement::edit');
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
        //
    }
}
