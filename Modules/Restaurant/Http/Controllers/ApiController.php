<?php

namespace Modules\Restaurant\Http\Controllers;

use App\Traits\SetResponse;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Application\Entities\Banner;
use Modules\Restaurant\Entities\Restaurant;

class ApiController extends Controller
{
    use SetResponse;

   public function listRestaurants(Request $request)
   {
       $banner = Banner::where('key', 'restaurant')->get();

       $filter = $request->filter ? $request->filter : '';
       $per_page = $request->per_page ? $request->per_page : 20;

       $query = Restaurant::query();
       $query->where('name', 'LIKE', '%'.$filter.'%')
           ->orderBy('id', 'desc');

       $restaurants = $query->paginate($per_page);

       $returnData = $this->prepareResponse(false, 'success', compact('restaurants','banner'), []);
       return response()->json($returnData, 200);
   }
}
