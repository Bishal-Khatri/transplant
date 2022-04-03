<?php

namespace Modules\Cart\Http\Controllers;

use App\Enum\OrderStatus;
use App\Traits\SetResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Cart\Entities\Order;

class OrderController extends Controller
{
    use SetResponse;

    public function index()
    {
        return view('cart::order.index');
    }

    public function edit($order_id)
    {
        return view('cart::order.edit', compact('order_id'));
    }

    public function listOrders(Request $request)
    {
        $query = Order::query();

        $query->with(['cart', 'user']);

        if ($request->has('status_filter') AND $request->status_filter != 0 ){
            if ($request->status_filter == OrderStatus::COMPLETED){
                $query->where('status',OrderStatus::COMPLETED);
            }
            elseif($request->status_filter == OrderStatus::CANCELED){
                $query->where('status',OrderStatus::CANCELED);
            }
            elseif($request->status_filter == OrderStatus::FAILED){
                $query->where('status',OrderStatus::FAILED);
            }elseif($request->status_filter == OrderStatus::PROCESSING){
                $query->where('status',OrderStatus::PROCESSING);
            }
        }
        else{
            $query->where('status','<>',OrderStatus::COMPLETED);
            $query->where('status','<>',OrderStatus::FAILED);
        }

        if ($request->has('filter')){
            $searchTerm = $request->filter;
            $query->where('unique_id', 'LIKE', "%{$searchTerm}%");
        }

        if ($request->has('status')){
            $query->where('status', $request->status);
        }

        $orders = $query->orderBy('id', 'desc')->paginate(20);

        $status = Order::getStatus();

        $returnData = $this->prepareResponse(false, 'success', compact('orders', 'status'), []);
        return response()->json($returnData, 200);
    }

    public function orderDetails($order_id)
    {
        try {
            $order = Order::with(['cart', 'cart.cartable', 'user', 'address', 'address.district', 'address.street'])->whereId($order_id)->firstOrFail();

            $returnData = $this->prepareResponse(false, 'success', compact('order'), []);
            return response()->json($returnData,200);
        }catch (\Exception $exception){
            $returnData = $this->prepareResponse(true, $exception->getMessage(), [], []);
            return response()->json($returnData,500);
        }
    }

    public function updatePaymentStatus(Request $request)
    {
        $request->validate([
            'order_id' => 'required|integer',
            'status' => 'required|integer',
        ]);
        try {
            $order = Order::findOrFail($request->order_id);
            $order->payment_status = $request->status;
            $order->save();

            $returnData = $this->prepareResponse(false, 'Payment status changed successfully.', [], []);
            return response()->json($returnData,200);
        }catch (\Exception $exception){
            $returnData = $this->prepareResponse(true, $exception->getMessage(), [], []);
            return response()->json($returnData,500);
        }
    }

    public function updateOrderStatus(Request $request)
    {
        $request->validate([
            'order_id' => 'required|integer',
            'status' => 'required|integer',
        ]);
        try {
            $order = Order::findOrFail($request->order_id);
            $order->status = $request->status;
            $order->save();

            $returnData = $this->prepareResponse(false, 'Order status changed successfully.', [], []);
            return response()->json($returnData,200);
        }catch (\Exception $exception){
            $returnData = $this->prepareResponse(true, $exception->getMessage(), [], []);
            return response()->json($returnData,500);
        }
    }
}
