<?php

namespace Modules\Restaurant\Http\Controllers;

use App\Traits\FileStore;
use App\Traits\SetResponse;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Restaurant\Entities\Restaurant;

class RestaurantController extends Controller
{
    use SetResponse, FileStore;

    public function index()
    {
        return view('restaurant::index');
    }

    public function listing()
    {
        return view('restaurant::restaurant-list');
    }

    public function store(Request $request)
    {
        $request->validate([
            'restaurant_name' => 'required|max:1000',
            'user' => 'required|integer',
            'logo' => 'required',
            'id' => 'nullable|integer',
        ]);

        if($request->id){
            $restaurant = Restaurant::findOrFail($request->id);
        } else{
            $restaurant = new Restaurant();
        }

        if ($request->hasFile('logo')){
            $resolution = [
                'large' => [1000,1000],
            ];
            $main_image = $this->saveImage($request->logo, 'restaurant', $resolution);
            $restaurant->logo = $main_image['large'];
        }
        $restaurant->name = $request->restaurant_name;
        $restaurant->address = $request->address;
        $restaurant->user_id = $request->user;
        $restaurant->save();
        $returnData = $this->prepareResponse(false, 'Success <br> Restaurant created/updated successfully', compact('restaurant'), []);
        return response()->json($returnData, 200);
    }

    public function apiListing(Request $request)
    {
        $filter = $request->filter ? $request->filter : '';
        $per_page = $request->per_page ? $request->per_page : 20;
        $query = Restaurant::query();
        $query->with('user');
        $query->where('name', 'LIKE', '%'.$filter.'%')
            ->orderBy('id', 'desc');

        $restaurants = $query->paginate($per_page);

        $returnData = $this->prepareResponse(false, 'success', compact('restaurants'), []);
        return response()->json($returnData, 200);
    }

    public function destroy($id)
    {

    }
}
