<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Category;
use App\Models\Pizza;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{

    public function category()
    {
        $categories = Category::select('categories.id','categories.name',DB::raw('COUNT(pizzas.category_id) as count'))
                        ->join('pizzas', 'pizzas.category_id','categories.id')
                        ->groupBy('categories.name','categories.id')
                        ->paginate(2);
                        // dd($categories->toarray());
        return view('admin.category.list',compact('categories'));
    }

    public function addCategory()
    {
        $user = User::where('id',Auth::user()->id)->first();
        return view('admin.category.addCategory',compact('user'));
    }

    public function categoryItem($id)
    {
        $pizzas = Pizza::select('pizzas.*', 'categories.name as category_name')
                        ->join('categories', 'categories.id','pizzas.category_id')
                        ->where('categories.id',$id)
                        ->paginate(2);
        return view('admin.category.item',compact('pizzas'));
    }

    public function createCategory(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $data = [
            'name' => $request->name
        ];
        Category::create($data);
        return redirect()->route('admin#category')->with('success','Category created successfully');

    }

    public function deleteCategory($id)
    {
        Category::where('id',$id)->delete();
        return redirect()->route('admin#category')->with('success','Category deleted successfully');
    }

    public function editCategory($id)
    {
        $category = Category::where('id',$id)->first();
        return view('admin.category.editCategory',compact('category'));
    }

    public function updateCategory(Request $request,$id)
    {
        $request->validate([
            'name' => 'required',
        ]);
        Category::where('id',$id)->update(["name" => $request['name']]);
        return redirect()->route('admin#category')->with('success','Category updated successfully');
    }

    public function searchCategory(Request $request)
    {
        $categories = Category::where('name','like','%'.$request->search.'%')->paginate(2);
        $categories->appends($request->all());
        return view('admin.category.list')->with('categories',$categories);
    }

}
