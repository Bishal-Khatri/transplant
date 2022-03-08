<?php

namespace Modules\Cart\Http\Controllers;

use App\Traits\SetResponse;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Cart\Entities\Cart;
use Modules\Grocery\Entities\Item;

class CartController extends Controller
{
    use SetResponse;

    public function addToCart(Request $request)
    {
        $request->validate([
           'user_id' => 'required|int',
           'item_id' => 'required|int',
           'quantity' => 'required|int',
           'item_type' => 'required|string'
        ]);
        $cart = null;
        if ($request->item_type === 'grocery'){
            if (Cart::where('item_id', $request->item_id)->where('user_id', $request->user_id)->exists()){
                $cart = Cart::where('item_id', $request->item_id)->where('user_id', $request->user_id)->first();
//                return response()->json($this->prepareResponse(true, 'Item already exists in your cart.', [], []));
            }
            $item = Item::findOrFail($request->item_id);
        }else{
            return response()->json($this->prepareResponse(true, 'Item type not found.', [], []));
        }

        if (!$cart){
            $cart = new Cart();
            $cart->user_id = auth()->user()->id;
            $cart->item_id = $item->id;
            $cart->quantity = $request->quantity;
        }else{
            $cart->quantity = (int)$cart->quantity + (int)$request->quantity;
        }
        $cart->save();

        $returnData = $this->prepareResponse(false, 'Item added to cart.', [], []);
        return response()->json($returnData);
    }

    public function cartListing(Request $request)
    {
        $user = auth()->user();
        if (!blank($user)){
            $cart = Cart::with('item')->where('user_id', $user->id)->where('status', 0)->get();

            $returnData = $this->prepareResponse(false, 'success', compact('cart'), []);
            return response()->json($returnData);
        }
    }
}
