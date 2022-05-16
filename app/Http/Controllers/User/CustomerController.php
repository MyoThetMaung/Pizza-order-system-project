<?php

namespace App\Http\Controllers\User;

use App\Models\Pizza;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
}
