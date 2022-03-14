<?php

namespace Modules\Cart\Http\Controllers;

use App\Models\UserAddress;
use App\Traits\SetResponse;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\Cart\Entities\Cart;
use Modules\Cart\Entities\Order;
use Modules\Grocery\Entities\Item;

class CartController extends Controller
{
    use SetResponse;

    public function addToCart(Request $request)
    {
        $validator = Validator::make($request->all(),  [
            'item_id' => 'required|int',
            'quantity' => 'required|int',
        ]);
        if($validator->fails()){
            return response()->json($this->prepareResponse(true, "validation error.", [], []));
        }
        try {
            $user_id = auth()->user()->id;
            $cart = null;
            if ($request->item_type === 'grocery') {
                if (Cart::where('item_id', $request->item_id)->where('user_id', $user_id)->where('order_id', null)->exists()) {
                    $cart = Cart::where('item_id', $request->item_id)->where('user_id', $request->user_id)->where('order_id', null)->first();
                }
                $item = Item::findOrFail($request->item_id);
            } else {
                return response()->json($this->prepareResponse(true, 'Item type not found.', [], []));
            }

            $item_price = $item->currentPrice();

            if (blank($item_price)){
                return response()->json($this->prepareResponse(true, 'Item cannot be added to cart.', [], []));
            }

            if (!$cart) {
                $cart = new Cart();
                $cart->user_id = auth()->user()->id;
                $cart->item_id = $item->id;
                $cart->quantity = $request->quantity;
                $cart->price = $item_price;
            } else {
                $cart->quantity = (int)$cart->quantity + (int)$request->quantity;
            }
            $cart->save();
            $cart->load('item');
            $returnData = $this->prepareResponse(false, 'Item added to cart.', compact('cart'), []);
        } catch (\Exception $e) {
            $returnData = $this->prepareResponse(true, $e->getMessage(), [], []);
        }
        return response()->json($returnData);
    }

    public function removeFromCart(Request $request)
    {
        $request->validate([
            'cart_id' => 'required|int',
        ]);
        try {
            $cart = Cart::findOrFail($request->cart_id);
            $cart->delete();

            $returnData = $this->prepareResponse(false, 'Item removed from cart.', [], []);
        } catch (\Exception $e) {
            $returnData = $this->prepareResponse(true, $e->getMessage(), [], []);
        }

        return response()->json($returnData);

    }

    public function cartListing(Request $request)
    {
        try {
            $user = auth()->user();
            if (!blank($user)) {
                $cart = Cart::with('item')->where('user_id', $user->id)->where('order_id', null)->get();
            }
            $returnData = $this->prepareResponse(false, 'success', compact('cart'), []);
        } catch (\Exception $e) {
            $returnData = $this->prepareResponse(true, $e->getMessage(), [], []);
        }
        return response()->json($returnData);
    }

    public function createOrder(Request $request)
    {
        $request->validate([
            'address_id' => 'nullable|int',
            'district_id' => 'nullable|int',
            'street_id' => 'nullable|int',
            'local_address' => 'nullable|string',
            'payment_method' => 'required|string',
        ]);
        if (!isset($request->address_id) OR blank($request->address_id)){
            $address = $this->createAddress($request);
            $address_id = $address->id;
        }else{
            $address_id = $request->address_id;
        }
        $user_id = auth()->user()->id;
        $cart = Cart::with('item')->where('user_id', $user_id)->where('order_id', null)->get();
        if (blank($cart)){
            return response()->json($this->prepareResponse(true, 'Your cart is empty',[],[]));
        }
        $price = [];
        foreach ($cart as $value){
            $price[] = (int) $value->price * (int) $value->quantity;
        }
        $total_price = array_sum($price);

        $order = new Order();
        $order->user_id = $user_id;
        $order->payment_method = $request->payment_method;
        $order->payment_status = 0;
        $order->total_price = $total_price;
        $order->shipping_price = 0;
        $order->address_id = $address_id;
        $order->save();

        // update cart data for order_id
        foreach ($cart as $val){
            $val->order_id = $order->id;
            $val->save();
        }
        $order->load('cart', 'cart.item');
        $returnData = $this->prepareResponse(false, 'success', compact('order'), []);
        return response()->json($returnData);
    }

    public function createAddress(Request $request)
    {
        $address = new UserAddress();
        $address->user_id = auth()->user()->id;
        $address->district_id = $request->district_id;
        $address->street_id = $request->street_id;
        $address->local_address = $request->local_address;
        $address->save();
        return $address;
    }

    public function displayOrder(Request $request)
    {
        $request->validate([
            'order_id' => 'required|int',
        ]);

        $orders = Order::with(['cart', 'cart.item'])->whereId($request->order_id)->first();
        $returnData = $this->prepareResponse(false, 'success', compact('orders'), []);
        return response()->json($returnData);
    }

    public function listOrders()
    {
        $orders = Order::with(['cart', 'cart.item'])->where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();
        $returnData = $this->prepareResponse(false, 'success', compact('orders'), []);
        return response()->json($returnData);
    }
}
