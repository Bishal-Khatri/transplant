<?php

namespace Modules\Application\Http\Controllers;

use App\Enum\CategoryType;
use App\Models\District;
use App\Models\Category;
use App\Models\Street;
use App\Traits\SetResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Application\Entities\Banner;
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
            $categories = Category::has('items')
                ->where('type', CategoryType::GROCERY)
                ->inRandomOrder()
                ->limit(5)
                ->get()
                ->map(function($categories) {
                    $categories->setRelation('items', $categories->items->take(5));
                    return $categories;
                });

            $categories->transform(function ($value) {
                $items = $value->items;

                foreach ($items as $item){
                    $item->price =  $item->currentPrice();
                }

                $value->setRelation('items', $items);

                return $value;
            });

            $data['grocery'] = $categories;
        }

        if(Module::has('Restaurant')){
            $restaurant = Restaurant::has('menu')
                ->where('status', 1)
                ->inRandomOrder()
                ->limit(5)
                ->get()
                ->map(function($restaurant) {
                    $restaurant->setRelation('menu', $restaurant->menu->take(5));
                    return $restaurant;
                });

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
