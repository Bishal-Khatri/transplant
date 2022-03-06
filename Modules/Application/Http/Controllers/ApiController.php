<?php

namespace Modules\Application\Http\Controllers;

use App\Traits\SetResponse;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Application\Entities\Banner;
use Modules\Grocery\Entities\Item;
use Nwidart\Modules\Facades\Module;

class ApiController extends Controller
{
    use SetResponse;
    public function getHome()
    {
        $data = [];
        $data['banners'] = Banner::where('key', 'home')->get();
        $data['modules'] = $this->getActiveModules();
        if(Module::has('Grocery')){
            $data['grocery'] = Item::with(['brand', 'category', 'images'])->limit(5)->get();
        }

        if(Module::has('Restaurant')){
            $data['restaurant'] = [];
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
