<?php

namespace Modules\Cart\Http\Controllers;

use App\Enum\OrderPaymentStatus;
use App\Enum\OrderStatus;
use App\Models\UserAddress;
use App\Traits\SetResponse;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\Cart\Entities\Cart;
use Modules\Cart\Entities\Order;
use Modules\Grocery\Entities\Item;
use Modules\Restaurant\Entities\RestaurantMenu;

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
                $item = Item::findOrFail($request->item_id);
                $item_price = $item->currentPrice();

                if (blank($item_price)){
                    return response()->json($this->prepareResponse(true, 'Item cannot be added to cart.', [], []));
                }

                if (!$item->cart()->where('user_id', $user_id)->where('order_id', null)->exists()) {
                    $item->cart()->create([
                        'user_id' => auth()->user()->id,
                        'quantity' => $request->quantity,
                        'price' => $item_price
                    ]);
                } else {
                    $item->cart->update(['quantity' => (int)$item->cart->quantity + (int)$request->quantity]);
                }

                $returnData = $this->prepareResponse(false, 'Item added to cart.', [], []);
            }

            elseif ($request->item_type === 'restaurant') {
                $restaurantItem = RestaurantMenu::findOrFail($request->item_id);

                if (!$restaurantItem->cart()->where('user_id', $user_id)->where('order_id', null)->exists()) {
                    $restaurantItem->cart()->create([
                        'user_id' => auth()->user()->id,
                        'quantity' => $request->quantity,
                        'price' => $restaurantItem->price,
                        'restaurant_id' => $restaurantItem->restaurant_id
                    ]);
                } else {
                    $restaurantItem->cart->update(['quantity' => (int)$restaurantItem->cart->quantity + (int)$request->quantity]);
                }

                $returnData = $this->prepareResponse(false, 'Item added to cart.', [], []);
            } else {
                return response()->json($this->prepareResponse(true, 'Item type not found.', [], []));
            }
            return response()->json($returnData);
        } catch (\Exception $e) {
            $returnData = $this->prepareResponse(true, $e->getMessage(), [], []);
            return response()->json($returnData);
        }
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

    public function cartListing()
    {
        try {
            $user = auth()->user();
            if (!blank($user)) {
                $cart = Cart::with('cartable')->where('user_id', $user->id)->where('order_id', null)->get();
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

        if (!isset($request->address_id) OR blank($request->address_id) OR $request->address_id == '-1'){
            $address = $this->createAddress($request);
            $address_id = $address->id;
        }else {
            $address_id = $request->address_id;
        }

        $user_id = auth()->user()->id;

        $cart = Cart::with('cartable')->where('user_id', $user_id)->where('order_id', null)->get();

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
        $order->unique_id = 0;
        $order->payment_method = $request->payment_method;
        $order->payment_status = OrderPaymentStatus::UNPAID;
        $order->status = OrderStatus::SUCCESS;
        $order->total_price = $total_price;
        $order->shipping_price = 0;
        $order->address_id = $address_id;
        $order->device_id = $request->device_id;

        // image order
        if($request->hasFile('image')){
            $path = $request->file('image')->store('image_orders', 'public');
            $order->image = $path;
        }

        $order->save();

        $order->setUniqueId();

        // update cart data for order_id
        foreach ($cart as $val){
            $val->order_id = $order->id;
            $val->save();
        }

        $order->load('cart', 'cart.cartable');
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

        $orders = Order::with(['cart', 'cart.cartable'])->whereId($request->order_id)->first();
        $returnData = $this->prepareResponse(false, 'success', compact('orders'), []);
        return response()->json($returnData);
    }

    public function listOrders()
    {
        $orders = Order::with(['cart', 'cart.cartable'])->where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();
        $returnData = $this->prepareResponse(false, 'success', compact('orders'), []);
        return response()->json($returnData);
    }
}
