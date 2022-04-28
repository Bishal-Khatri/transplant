<?php

namespace Modules\Cart\Http\Controllers;

use App\Enum\OrderStatus;
use App\Enum\UserType;
use App\Models\User;
use App\Traits\SetResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Kreait\Firebase\Messaging\CloudMessage;
use Modules\Cart\Entities\Delivery;
use Modules\Cart\Entities\ImageOrder;
use Modules\Cart\Entities\Order;
use Kreait\Firebase\Contract\Messaging;

class OrderController extends Controller
{
    use SetResponse;

    private $messaging;

    public function __construct(Messaging $messaging)
    {
        $this->messaging = $messaging;
    }

    public function sendFcm()
    {
        $deviceToken = 'device_token';
        $notification = [
            'title' => 'Apple',
            'body' => 'Ball',
        ];
        $data = [
            'first_key' => 'First Value',
            'second_key' => 'Second Value',
        ];
        $message = CloudMessage::withTarget('token', $deviceToken)
            ->withNotification($notification) // optional
            ->withData($data);

        $result = $this->messaging->send($message);
        dd($result);
    }

    public function index()
    {
        return view('cart::order.index');
    }

    public function imageOrder()
    {
        return view('cart::order.image-order');
    }

    public function getImageOrders(Request $request)
    {
        $query = ImageOrder::query();
        $query->whereNull('order_id')->with(['order', 'orderBy']);

        if ($request->has('status_filter') AND $request->status_filter != 0 ){
            if ($request->status_filter == OrderStatus::COMPLETED){
                $query->where('order_status',OrderStatus::COMPLETED);
            }
            elseif($request->status_filter == OrderStatus::CANCELED){
                $query->where('order_status',OrderStatus::CANCELED);
            }
            elseif($request->status_filter == OrderStatus::FAILED){
                $query->where('order_status',OrderStatus::FAILED);
            }elseif($request->status_filter == OrderStatus::PROCESSING){
                $query->where('order_status',OrderStatus::PROCESSING);
            }
        }
        else{
            $query->where('order_status','<>',OrderStatus::COMPLETED);
            $query->where('order_status','<>',OrderStatus::FAILED);
            $query->where('order_status','<>',OrderStatus::CANCELED);
        }

        $imageOrders = $query->get();

        $returnData = $this->prepareResponse(false, 'success', compact('imageOrders'), []);
        return response()->json($returnData, 200);
    }

    public function saveImageOrder(Request $request)
    {
        $validator = Validator::make($request->all(),  [
            'image' => 'required',
        ]);

        $user = auth()->user();

        if($validator->fails() OR !$user){
            return response()->json($this->prepareResponse(true, "validation error.", [], []));
        }

        $path = $request->file('image')->store('image_orders', 'public');

        $imageOrder = new ImageOrder();
        $imageOrder->image = $path;
        $imageOrder->order_by = $user->id;
        $imageOrder->order_status = OrderStatus::SUCCESS;
        $imageOrder->save();

        $returnData = $this->prepareResponse(false, 'success', compact('imageOrder'), []);
        return response()->json($returnData, 200);
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
            $delivery_persons = User::where('user_type', UserType::DELIVERY_PERSON)->get();
            $order = Order::with(['cart', 'cart.cartable', 'user', 'address', 'address.district', 'address.street', 'delivery.user'])->whereId($order_id)->firstOrFail();

            $returnData = $this->prepareResponse(false, 'success', compact('order', 'delivery_persons'), []);
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

            $returnData = $this->prepareResponse(false, 'Success <br> Payment status changed successfully.', [], []);
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

            $returnData = $this->prepareResponse(false, 'Success <br> Order status changed successfully.', [], []);
            return response()->json($returnData,200);
        }catch (\Exception $exception){
            $returnData = $this->prepareResponse(true, $exception->getMessage(), [], []);
            return response()->json($returnData,500);
        }
    }

    public function assignOrder(Request $request)
    {
        $request->validate([
            'order_id' => 'required|integer',
            'delivery_person' => 'required|integer',
        ]);
        try {
            $delivery = Delivery::where('order_id', $request->order_id)->first();

            if (!$delivery){
                $delivery = new Delivery();
            }

            $delivery->order_id = $request->order_id;
            $delivery->deliverer_id = $request->delivery_person;
            $delivery->save();

            $returnData = $this->prepareResponse(false, 'Success <br> Delivery assigned successfully.', [], []);
            return response()->json($returnData,200);
        }catch (\Exception $exception){
            $returnData = $this->prepareResponse(true, $exception->getMessage(), [], []);
            return response()->json($returnData,500);
        }
    }

    public function getAssignedOrder()
    {
        $user = auth()->user();
        $deliveries = Delivery::with(['order', 'order.user', 'order.address.district', 'order.address.street'])->where('deliverer_id', $user->id)->get();
        $returnData = $this->prepareResponse(false, 'success', compact('deliveries'), []);
        return response()->json($returnData);
    }

    public function updateImageOrderStatus(Request $request)
    {
        try{
            $image_order = ImageOrder::findOrFail($request->order_id);
            $image_order->order_status = $request->status;
            $image_order->save();

            $returnData = $this->prepareResponse(false, 'Success <br> Order status updated successfully.', [], []);
            return response()->json($returnData);
        }catch (\Exception $exception){
            $returnData = $this->prepareResponse(true, $exception->getMessage(), [], []);
            return response()->json($returnData);
        }
    }
}
