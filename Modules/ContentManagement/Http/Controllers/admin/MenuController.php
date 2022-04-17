<?php

namespace Modules\ContentManagement\Http\Controllers\admin;

use App\Traits\SetResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Routing\Controller;
use Modules\ContentManagement\Entities\Menu;
use Modules\ContentManagement\Entities\MenuPage;
use Modules\ContentManagement\Entities\Page;
use Modules\ContentManagement\Entities\PageCategory;
use Modules\ContentManagement\Enum\MenuPageType;

class MenuController extends Controller
{
    use SetResponse;

    public function getMainMenu()
    {
//        dd('sdf');
        $mainMenu = MenuPage::where('parent_id', 0)->first();

        $child = MenuPage::with(['category:id,slug','post:id,slug','children'])
            ->where('parent_id', $mainMenu->id)
            ->orderBy('order', 'asc')
            ->get();

        $returnData = $this->prepareResponse(false, 'success', compact('mainMenu', 'child'), []);
        return response()->json($returnData, 200);
    }

    public function getChildMenu($id)
    {
        $mainMenu = MenuPage::find($id);
        $child = MenuPage::with(['category:id,slug', 'post:id,slug'])->where('parent_id', $id)->get()->toArray();

        $data['mainMenu'] = $mainMenu;
        $data['child'] = $child;

        $returnData = $this->prepareResponse(false, 'success', $data, []);
        return response()->json($returnData, 200);
    }

    // admin
    public function admin_index()
    {
        $menus = Menu::all();
        $menu_items = [];
        $categories = PageCategory::all();
        $pages = Page::where('visibility', 1)->get();

        $posts = Page::where('visibility', 1)
            ->with('category:id,name')
            ->get()->map(function ($query){
                $category_title = (!blank($query->category)) ? Str::limit($query->category->name, 40) : '';
                return [
                    'id' => $query->id,
                    'title' => $query->name,
                    'category' => $category_title,
                    'title_category' => Str::limit($query->title, 40) . ' - ' . $category_title,
                    'slug' => $query->slug,
                ];
            });

        $menu = Menu::where('is_selected', 1)->first();

        if ($menu){
            $menu_items = MenuPage::where('menu_id',$menu->id)
                ->where('parent_id',0)
                ->with(['menu','parent'])
                ->orderBy('order', 'asc')
                ->get();
        }

        return view('contentmanagement::admin.menu.index', compact('menu', 'menu_items', 'posts', 'pages','categories', 'menus'));
    }

    public function saveMenuOrder(Request $request)
    {
        $input = $request->data;
        $dataCount = 1;
        $childCount = 1;
        $subchildCount = 1;
        foreach ($input as $data) {
            if(isset($data['children'])){
                foreach($data['children'] as $child){
                    if(isset($child['children'])){
                        foreach ($child['children'] as $subchild) {
                            $menusub = MenuPage::find($subchild['id']);
                            $menusub->parent_id = $child['id'];
                            $menusub->order = $subchildCount;
                            $menusub->save();
                            $subchildCount++;
                        }
                    }
                    $menuch = MenuPage::find($child['id']);
                    $menuch->parent_id = $data['id'];
                    $menuch->order = $childCount;
                    $menuch->save();
                    $childCount++;
                }
            }
            $menu = MenuPage::find($data['id']);
            $menu->parent_id = 0;
            $menu->order = $dataCount;
            $menu->save();
            $dataCount++;
        }
        Session::flash('message', 'Menu updated successfully.');
        return 'true';
    }

    public function save(Request $request)
    {
        $request->validate([
            'display_name' => 'required',
            'link' => 'required|url',
        ]);
        $menu = new MenuPage();
        $menu->display_name = $request->display_name;
        $menu->type = MenuPageType::URL;
        $menu->url = $request->link;
        $menu->parent_id = 0;
        $menu->menu_id = 1;
        $menu->save();

        session()->flash('success', 'Success <br> Link added successfully.');
        return redirect()->back();
    }

    public function delete(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|integer'
        ]);
        $menu = MenuPage::find($request->menu_id);
        if($menu){
            $child = MenuPage::where('parent_id', $menu->id)->delete();
            $menu->delete();
        }
        Session::flash('message', 'Menu deleted successfully.');
        return redirect()->back();
    }

    public function addPageToMenu(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|integer',
            'page_id' => 'required|integer'
        ]);

        $page = Page::findOrFail($request->page_id);

        $menu = new MenuPage();
        $menu->display_name = $page->title;
        $menu->slug = $page->slug;
        $menu->type = MenuPageType::PAGE;
        $menu->menu_id = $request->menu_id;
        $menu->order = 0;
        $menu->parent_id = 0;
        $menu->save();

        session()->flash('success', 'Success <br> Page added successfully.');
        return redirect()->back();
    }

    public function addCategoryToMenu(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|integer',
            'category_id' => 'required|integer'
        ]);

        $category = PageCategory::findOrFail($request->category_id);

        $menu = new MenuPage();
        $menu->display_name = $category->name;
        $menu->slug = $category->slug;
        $menu->type = MenuPageType::CATEGORY;
        $menu->menu_id = $request->menu_id;
        $menu->order = 0;
        $menu->parent_id = 0;
        $menu->save();

        session()->flash('success', 'Success <br> Category added successfully.');
        return redirect()->back();
    }

    public function update(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|integer',
            'display_name' => 'required|string|max:255',
        ]);

        $menu = MenuPage::find($request->menu_id);
        $menu->display_name = $request->display_name;
        $menu->slug = Str::slug($request->display_name);
        $menu->alt_text = $request->alt_text;
        $menu->target = $request->target;
        $menu->custom_css = $request->custom_css;
        $menu->save();

        session()->flash('success', 'Success <br> Menu updated successfully.');
        return redirect()->back();
    }
}
