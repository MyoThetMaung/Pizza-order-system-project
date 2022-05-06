<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pizza;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class PizzaController extends Controller
{

    public function pizza()
    {
        $pizzas = Pizza::paginate(2);
        if(count($pizzas) == 0){
            $emptyStatus = 0;
        }else{
            $emptyStatus = 1;
        }
        return view('admin.pizza.list',compact('pizzas',['emptyStatus']));
    }

    public function addPizza()
    {
        $categories = Category::all();
        return view('admin.pizza.addPizza',compact('categories'));
    }

    public function createPizza(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required',
            'price' => 'required',
            'discount_price' => 'required',
            'category_id' => 'required',
            'publish_status' => 'required',
            'buy_one_get_one_status' => 'required',
            'waiting_time' => 'required',
            'description' => 'required',
        ]);
        $file = $request->file('image');
        $fileName = uniqid().'_'.$file->getClientOriginalName();
        $file->move(public_path().'/uploads/',$fileName);

        $data = $this->pizzaData($request,$fileName);
        Pizza::create($data);
        return redirect()->route('admin#pizza')->with('success', 'Pizza added successfully');
    }

    public function deletePizza($id){
        $data = Pizza::select('image')->where('id',$id)->first();
        $imageName = $data['image'];

        //database delete
        Pizza::where('id',$id)->delete();
        //local file delete
        File::delete(public_path().'/uploads/'.$imageName);

        return redirect()->route('admin#pizza')->with('success', 'Pizza deleted successfully');
    }

    public function editPizza($id){
        $pizza = Pizza::select('pizzas.*',DB::raw('categories.name as category_name'))
                 ->join('categories','pizzas.category_id','=','categories.id')
                 ->where('pizzas.id',$id)
                 ->first();
        $categories = Category::all();
        return view('admin.pizza.editPizza',compact('pizza','categories'));
    }

    public function updatePizza(Request $request,$id){
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'discount_price' => 'required',
            'category_id' => 'required',
            'publish_status' => 'required',
            'buy_one_get_one_status' => 'required',
            'waiting_time' => 'required',
            'description' => 'required',
        ]);
        $updateData = $this->updatePizzaData($request);
        if (isset($updateData['image'])) {
            $data = Pizza::select('image')->where('id', $id)->first();
            $imageName = $data['image'];
            File::delete(public_path().'/uploads/'.$imageName);

            $file = $request->file('image');
            $fileName = uniqid().'_'.$file->getClientOriginalName();
            $file->move(public_path().'/uploads/', $fileName);
            $updatePizzaData['image'] = $fileName;
        }
        Pizza::where('id',$id)->update($updateData);
        return redirect()->route('admin#pizza')->with('success', 'Pizza updated successfully');
    }

    public function seemorePizza($id){
        $pizza = Pizza::where('id',$id)->first();
        return view('admin.pizza.seemorePizza',compact('pizza'));
    }

    public function searchPizza(Request $request){
        $search_key  = $request->search;
        $pizzas = Pizza::orwhere('name','like','%'.$search_key.'%')
                        ->orWhere('price','like','%'.$search_key.'%')
                        ->paginate(2);
        if (count($pizzas) == 0) {
            $emptyStatus = 0;
        }else{
            $emptyStatus = 1;
        }
        return view('admin.pizza.list',compact('pizzas',['emptyStatus']));
    }

    public function pizzaData($request,$fileName){
        return
            [
                'name' => $request['name'],
                'image' => $fileName,
                'price' => $request['price'],
                'discount_price' => $request['discount_price'],
                'category_id' => $request['category_id'],
                'publish_status' => $request['publish_status'],
                'buy_one_get_one_status' => $request['buy_one_get_one_status'],
                'waiting_time' => $request['waiting_time'],
                'description' => $request['description'],
            ];
    }

    public function updatePizzaData($request){
        $arr =
            [
                'name' => $request['name'],
                'price' => $request['price'],
                'discount_price' => $request['discount_price'],
                'category_id' => $request['category_id'],
                'publish_status' => $request['publish_status'],
                'buy_one_get_one_status' => $request['buy_one_get_one_status'],
                'waiting_time' => $request['waiting_time'],
                'description' => $request['description'],
            ];
        if($request['image']){
            $arr['image'] = $request['image'];
        }
        return $arr;
    }

}
