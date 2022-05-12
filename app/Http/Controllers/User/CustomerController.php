<?php

namespace App\Http\Controllers\User;

use App\Models\Pizza;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function index(){
        $pizzas = Pizza::where('publish_status','1')->get();
        return view('user.index',compact('pizzas'));
    }
}
