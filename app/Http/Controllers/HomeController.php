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
}
