<?php

namespace Modules\Grocery\Http\Controllers;

use App\Enum\OrderStatus;
use App\Traits\SetResponse;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Cart\Entities\Order;

class OrderController extends Controller
{
    use SetResponse;

    public function index()
    {
        return view('grocery::order.index');
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
}
