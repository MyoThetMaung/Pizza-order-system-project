<?php

namespace App\Http\Controllers\User;

use App\Models\Order;
use App\Models\Pizza;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    public function index(){
        $pizzas = Pizza::where('publish_status','1')->paginate(5);
        $categories = Category::get();
        $status = count($pizzas) == 0 ? 0 : 1;
        return view('user.index',compact('pizzas','categories','status'));
    }

    public function pizzaDetail($id){
        $pizza = Pizza::where('id',$id)->get();
        Session::put('PIZZA_INFO',$pizza);
        return view('user.pizzaDetail',compact('pizza'));
    }

    public function categorySearch($id){
        $pizzas = Pizza::where('category_id',$id)->paginate(5);
        $categories = Category::get();
        $status = count($pizzas) == 0 ? 0 : 1;
        return view('user.index',compact('pizzas','categories','status'));
    }

    public function searchPizza(Request $request){
        $pizzas = Pizza::where('name','like','%'.$request->search.'%')->paginate(5);
        $categories = Category::get();
        $status = count($pizzas) == 0 ? 0 : 1;
        $pizzas->appends($request->all());
        return view('user.index',compact('pizzas','categories','status'));
    }

    public function searchDatePrice(Request $request){
        $min_price = $request->min_price;
        $max_price = $request->max_price;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $pizzas = Pizza::select('*');

        if(!is_null($start_date) && !is_null($end_date)){
            $pizzas = $pizzas->whereBetween('created_at',[$start_date,$end_date]);
        }elseif(!is_null($start_date)){
            $pizzas = $pizzas->where('created_at','>=',$start_date);
        }elseif(!is_null($end_date)){
            $pizzas = $pizzas->where('created_at','<=',$end_date);
        }

        if(!is_null($min_price) && !is_null($max_price)) {
            $pizzas = $pizzas->whereBetween('price', [$min_price,$max_price]);
        }elseif(!is_null($min_price)){
            $pizzas = $pizzas->where('price','>=',$min_price);
        }elseif(!is_null($max_price)){
            $pizzas = $pizzas->where('price','<=',$max_price);
        }

        $pizzas = $pizzas->paginate(5);
        $status = count($pizzas) == 0 ? 0 : 1;
        $pizzas->appends($request->all());
        $categories = Category::get();
        return view('user.index',compact('pizzas','categories','status'));
    }

    public function order(){
        $pizzaInfo = Session::get('PIZZA_INFO');
        return view('user.order',compact('pizzaInfo'));
    }

    public function placeOrder(Request $request){
        $pizzaInfo = Session::get('PIZZA_INFO');
        $customer_id = Auth::user()->id;
        $request->validate([
            'pizzaCount' => 'required',
            'paymentType' => 'required'
        ]);
        $placeOrder = [
            'customer_id' => $customer_id,
            'pizza_id' =>  $pizzaInfo[0]['id'],
            'carrier_id' => 1,
            'order_time' => Carbon::now(),
            'payment_status' => $request->paymentType,
        ];

        $count = $request->pizzaCount;
        $waitingTime = $pizzaInfo[0]['waiting_time'] * $count;
        for($i = 0; $i < $count; $i++){
            Order::create($placeOrder);
        }
        return back()->with('success','Order Placed Successfully! Please wait '.$waitingTime.' minutes for delivery');
    }

}
