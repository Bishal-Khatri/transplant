<?php

namespace Modules\Restaurant\Http\Controllers;

use App\Enum\CategoryType;
use App\Models\Category;
use App\Traits\SetResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Cart\Entities\Cart;
use Modules\Restaurant\Entities\Restaurant;
use Modules\Restaurant\Entities\RestaurantMenu;
use Modules\Cart\Enum\ItemStatus;

class RestaurantClientController extends Controller
{
    use SetResponse;
    public function index()
    {
        $categories = Category::where('type', CategoryType::RESTAURANT)->get();
        $user = Auth::user();
        $restaurant = Restaurant::where('user_id', $user->id)->firstOrFail();
        $menu = RestaurantMenu::where('restaurant_id', $restaurant->id)->get();
        return view('restaurant::client.index', compact('restaurant', 'menu', 'categories'));
    }

    public function getMenu(Request $request)
    {
        $user = Auth::user();
        $restaurant = Restaurant::where('user_id', $user->id)->firstOrFail();

        $query = RestaurantMenu::query();
        $query->where('restaurant_id', $restaurant->id);
        if (isset($request->filter) AND !blank($request->filter)){
            $query->where('name','LIKE', '%'.$request->filter.'%');
        }
        $items = $query->paginate(5);
        $returnData = $this->prepareResponse(false, 'success', compact('items'), []);
        return response()->json($returnData, 200);
    }

    public function orderList(Request $request)
    {
        try {
            $status = $request->status_filter ? $request->status_filter: 0;
            $user = Auth::user();
            $restaurant = $user->restaurant();

            $query = Cart::query()
                ->where('cartable_type', RestaurantMenu::class)
                ->where('restaurant_id', $restaurant->id)
                ->has('order')
                ->with(['cartable','order', 'subscriber']);

            if ($status == ItemStatus::NEW_ORDER){
                $query->whereStatus(ItemStatus::NEW_ORDER);
                $query->OrWhere('status',ItemStatus::PROCESSING);
            }
            elseif($status ==ItemStatus::PROCESSING){
                $query->whereStatus(ItemStatus::PROCESSING);
            }
            elseif($status ==ItemStatus::COMPLETED){
                $query->whereStatus(ItemStatus::COMPLETED);
            }
            elseif($status ==ItemStatus::FAILED){
                $query->whereStatus(ItemStatus::FAILED);
            }

            $cart_items = $query->paginate(10);

            $returnData = $this->prepareResponse(false, 'success', compact('cart_items'), []);
            return response()->json($returnData, 200);
        }catch (\Exception $exception){
            $returnData = $this->prepareResponse(true, $exception->getMessage(), [], []);
            return response()->json($returnData, 500);
        }
    }

    public function updateItemStatus(Request $request)
    {
        $request->validate([
            'cart_item_id' => 'required|integer',
            'status' => 'required|integer',
        ]);

        try{
            $cartItem = Cart::findOrFail($request->cart_item_id);
            $cartItem->status = $request->status;
            $cartItem->save();

            $returnData = $this->prepareResponse(false, 'Success <br> Status created/updated successfully', [], []);
            return response()->json($returnData, 200);
        }catch (\Exception $exception){
            $returnData = $this->prepareResponse(true, $exception->getMessage(), [], []);
            return response()->json($returnData, 500);
        }
    }
}
