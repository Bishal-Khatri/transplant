<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\SetResponse;
use Illuminate\Http\Request;
use Modules\Grocery\Entities\Item;
use Modules\Restaurant\Entities\Restaurant;
use Modules\Restaurant\Entities\RestaurantMenu;

class HomeController extends Controller
{
    use SetResponse;
    public function __construct()
    {
        $this->middleware('auth')->except('search');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

//    public function getUserByEmail(Request $request)
//    {
//        $request->validate([
//            'user_email' => 'required'
//        ]);
//        try {
//            $user = User::where('email', $request->user_email)->firstOrFail();
//            return  response()->json($this->prepareResponse(false, 'success', compact('user'), []));
//        } catch (\Exception $exception){
//            return response()->json($this->prepareResponse(true, $exception->getMessage(), [], []), 404);
//        }
//    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $items = $restaurants = $restaurant_menu = [];

        if ($query){
            $items = Item::where('name', 'LIKE', "%{$query}%")->get();
            $restaurants = Restaurant::where('status', 1)->where('name', 'LIKE', "%{$query}%")->get();
            $restaurant_menu = RestaurantMenu::with('restaurant')->where('name', 'LIKE', "%{$query}%")->get();
        }

        return response()->json($this->prepareResponse(false, 'success', compact('items', 'restaurants', 'restaurant_menu'), []));
    }
}
