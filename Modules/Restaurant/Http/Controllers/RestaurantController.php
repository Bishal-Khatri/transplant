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

    public function apiListing(Request $request)
    {
        $filter = $request->filter ? $request->filter : '';
        $query = Restaurant::query();
        $query->where('name', 'LIKE', '%'.$filter.'%')
            ->orderBy('id', 'desc');


        $restaurants = $query->paginate(20);

        $returnData = $this->prepareResponse(false, 'success', compact('restaurants'), []);
        return response()->json($returnData, 200);
    }

    public function destroy($id)
    {

    }
}
