<?php

namespace Modules\ContentManagement\Http\Controllers;

use App\Traits\SetResponse;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Modules\ContentManagement\Entities\Menu;
use Modules\ContentManagement\Entities\Page;
use Modules\ContentManagement\Entities\PageCategory;
use Modules\ContentManagement\Entities\Theme;
use Modules\ContentManagement\Enum\ContentType;

class ThemeController extends Controller
{
    use SetResponse;
    public  $active_theme;
    public function __construct()
    {
        $this->active_theme = Theme::where('is_active', 1)->first();
    }

    public function getPage($slug)
    {
        $active_theme = $this->active_theme;



        if (!$content OR blank($content)){
            return view('contentmanagement::default-page');
        }

        $index_file = 'contentmanagement::theme'.'.'.$active_theme->name.'.'.'index';

        return view($index_file, compact('content', 'active_theme'));
    }

    public function getCategory($slug)
    {
        $page = PageCategory::where('slug', $slug)->with('pages')->firstOrFail();

    }

    public function index($slug = null)
    {
        $active_theme = $this->active_theme;

        if (!$active_theme OR blank($active_theme)){
            return abort(404, 'Theme not activated');
        }

        $query = Page::query();
        $query->where('content_type', ContentType::PAGE)
            ->where('visibility', 1)->with('sections');

        if (!blank($slug)){
            $content = $query->where('slug', $slug)->firstOrFail();
        } else {
            $content = $query->whereId($active_theme->homepage_id)->firstOrFail();
        }

        if (!$content OR blank($content)){
            return view('contentmanagement::default-page');
        }

        $index_file = 'contentmanagement::theme'.'.'.$active_theme->name.'.'.'index';

        return view($index_file, compact('content', 'active_theme'));
    }

    public function adminIndex()
    {
        $available_themes = Theme::all();
        $menus = Menu::all();

        if (!Theme::where('is_active', 1)->exists()){
            Theme::create([
                'name' => 'Default',
                'is_active' => 1
            ]);
        }
        $active_theme = Theme::where('is_active', 1)->first();
        $pages = Page::where('visibility', 1)->get();
        return view('contentmanagement::admin.theme.index', compact('active_theme', 'pages', 'available_themes', 'menus'));
    }

    public function updateTheme(Request $request)
    {
        $theme_id = $request->theme_id;

        if (!$theme_id){
            $theme = new Theme();
        }else {
            $theme = Theme::findOrFail($theme_id);
        }
        $theme->logo = 'filemanager/'.$request->logo;
        $theme->homepage_id = $request->homepage_id;
        $theme->nav_menu_id = $request->nav_menu_id;
        $theme->title = $request->website_name;
        $theme->copyright = $request->copyright_text;
        $theme->footer = $request->footer;
        $theme->save();

        $returnData = $this->prepareResponse(false, 'Success <br> Theme updated successfully.', [], []);
        return response()->json($returnData);
    }

    public function scanTheme()
    {
        $path = '../Modules/ContentManagement/Resources/views/theme';
        $available_themes = array_diff(scandir($path), array('.', '..'));

        // remove obsolete themes
        Theme::whereNotIn('name', $available_themes)->delete();

        foreach ($available_themes as $value){
            if (!Theme::where('name', $value)->exists()){
                Theme::create([
                    'name' => $value,
                    'is_active' => 0
                ]);
            }
        }

        session()->flash('success', 'Success <br> Themes scanned successfully.');
        return redirect()->back();
    }

    public function activateTheme($id)
    {
        $themes = Theme::all();
        foreach ($themes as $value){
            $value->is_active = 0;
            $value->save();
        }

        $activate = Theme::find($id);
        $activate->is_active = 1;
        $activate->save();

        session()->flash('success', 'Success <br> Themes scanned successfully.');
        return redirect()->back();
    }
}
