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
           'item_type' => 'required|string'
        ]);
        if ($request->item_type === 'grocery'){
            $item = Item::findOrFail($request->item_id);
        }else{
            return;
        }

        $cart = new Cart();
        $cart->user_id = auth()->user()->id;
        $cart->item_id = $item->id;
        $cart->save();

        $returnData = $this->prepareResponse(false, 'Item added to cart.', [], []);
        return response()->json($returnData);
    }
}
