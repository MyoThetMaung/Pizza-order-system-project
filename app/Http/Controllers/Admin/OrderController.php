<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function orderList(){
        $orders = Order::select('orders.*', 'users.name as customer_name', 'pizzas.name as pizza_name', DB::raw('COUNT(orders.pizza_id) as count'))
            ->join('users', 'users.id', 'orders.customer_id')
            ->join('pizzas', 'pizzas.id', 'orders.pizza_id')
            ->groupBy('orders.pizza_id', 'orders.customer_id')
            ->paginate();

        return view('admin.order.list',compact('orders'));
    }

    public function orderSearch(Request $request){
        $orders = Order::select('orders.*', 'users.name as customer_name', 'pizzas.name as pizza_name', DB::raw('COUNT(orders.pizza_id) as count'))
            ->join('users', 'users.id', 'orders.customer_id')
            ->join('pizzas', 'pizzas.id', 'orders.pizza_id')
            ->orwhere('users.name', 'like', '%'.$request->search.'%')
            ->orwhere('pizzas.name', 'like', '%'.$request->search.'%')
            ->groupBy('orders.pizza_id', 'orders.customer_id')
            ->paginate();
        $orders->appends($request->all());

        return view('admin.order.list',compact('orders'));
    }
}
