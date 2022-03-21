<?php

namespace Modules\Application\Http\Controllers;

use App\Models\District;
use App\Models\Street;
use App\Traits\SetResponse;
use Illuminate\Contracts\Support\Renderable;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Application\Entities\Banner;
use Modules\Grocery\Entities\GroceryCategory;
use Modules\Grocery\Entities\Item;
use Modules\Restaurant\Entities\Restaurant;
use Nwidart\Modules\Facades\Module;

class ApiController extends Controller
{
    use SetResponse;
    public function getHome()
    {
        $data = [];
        $data['district'] = District::all();
        $data['streets'] = Street::all();
        $data['banners'] = Banner::where('key', 'home')->get();
        $data['modules'] = $this->getActiveModules();

        if(Module::has('Grocery')){
            $items = Item::with(['brand', 'category', 'images'])->limit(5)->get();
            $categories = GroceryCategory::with(['items' => function($query) {
                return $query->limit(5);
            }])->inRandomOrder(5)->get();

//            $items->transform(function ($value, $key) {
//                return [
//                    'id' => $value->id,
//                    'sku' => $value->sku,
//                    'name' => $value->name,
//                    'description' => $value->description,
//                    'main_image_original' => $value->main_image_original,
//                    'main_image_large' => $value->main_image_large,
//                    'main_image_medium' => $value->main_image_medium,
//                    'main_image_thumbnail' => $value->main_image_thumbnail,
//                    'category' => $value->category,
//                    'brand' => $value->brand,
//                    'current_price' => $value->,
//                    'images' => $value->images,
//                    'current_price' => $current_price,
//                    'old_price' => null,
//                    'has_discount' => false,
//                ];
//            });

            $data['grocery'] = $items;
            $data['categories'] = $categories;
        }

        if(Module::has('Restaurant')){
            $restaurant = Restaurant::with(['items' => function($query) {
                return $query->limit(5);
            }])->inRandomOrder(5)->get();
            $data['restaurant'] = $restaurant;
        }

        $returnData = $this->prepareResponse(false, 'success', $data, []);
        return response()->json($returnData, 200);
    }

    private function getActiveModules()
    {
        return collect([
            [
                "name" => "Grocery",
                "icon" => $this->getImageUrl('/images/modules/grocery.png')
            ],
            [
                "name" => "Restaurant",
                "icon" => $this->getImageUrl('/images/modules/restaurant.png')
            ],
            [
                "name" => "Fashion",
                "icon" => $this->getImageUrl('/images/modules/fashion.png')
            ],
            [
                "name" => "Electronics",
                "icon" => $this->getImageUrl('/images/modules/electronics.png')
            ],
            [
                "name" => "Cosmetics",
                "icon" => $this->getImageUrl('/images/modules/cosmetic.png')
            ],
            [
                "name" => "Hotels",
                "icon" => $this->getImageUrl('/images/modules/hotels.png')
            ],
            [
                "name" => "Travel",
                "icon" => $this->getImageUrl('/images/modules/travel.png')
            ],
        ]);
    }

    private function getImageUrl($path)
    {
        return url($path);
    }
}
