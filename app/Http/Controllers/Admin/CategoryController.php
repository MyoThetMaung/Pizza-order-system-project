<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{

    public function category()
    {
        $categories = Category::paginate(2);
        return view('admin.category.list',compact('categories'));
    }

    public function addCategory()
    {
        $user = User::where('id',Auth::user()->id)->first();
        return view('admin.category.addCategory',compact('user'));
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
