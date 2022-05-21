<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Pizza;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{

    public function category()
    {
        if(Session::has('CATEGORY_SEARCH')){
            Session::forget('CATEGORY_SEARCH');
        }
        $categories = Category::select('categories.id','categories.name',DB::raw('COUNT(pizzas.category_id) as count'))
                        ->leftJoin('pizzas', 'pizzas.category_id','categories.id')
                        ->groupBy('categories.name','categories.id')
                        ->paginate(4);
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
        $categories = Category::select('categories.id','categories.name',DB::raw('COUNT(pizzas.category_id) as count'))
                        ->leftJoin('pizzas', 'pizzas.category_id','categories.id')
                        ->where('categories.name','like','%'.$request->search.'%')
                        ->groupBy('categories.name','categories.id')
                        ->paginate(2);

        Session::put('CATEGORY_SEARCH',$request->search);

        $categories->appends($request->all());
        return view('admin.category.list',compact('categories'));
    }

    public function downloadCategory(){
        if (Session::has('CATEGORY_SEARCH')) {
            $search = Session::get('CATEGORY_SEARCH');
            $categories = Category::select('categories.id', 'categories.name', DB::raw('COUNT(pizzas.category_id) as count'))
                            ->leftJoin('pizzas', 'pizzas.category_id', 'categories.id')
                            ->where('categories.name', 'like', '%'.$search.'%')
                            ->groupBy('categories.name', 'categories.id')
                            ->get();
        }else{
            $categories = Category::select('categories.id', 'categories.name', DB::raw('COUNT(pizzas.category_id) as count'))
                            ->leftJoin('pizzas', 'pizzas.category_id', 'categories.id')
                            ->groupBy('categories.name', 'categories.id')
                            ->get();
        }

        $csvExporter = new \Laracsv\Export();
        $csvExporter->build($categories, [
            'id' => 'Category ID',
            'name' => 'Category Name',
            'count' => 'Category Count',
            'created_at' => 'Created',
            'updated_at' => 'Updated',
        ]);

        $csvReader = $csvExporter->getReader();
        $csvReader->setOutputBOM(\League\Csv\Reader::BOM_UTF8);
        $filename = 'CategoryList.csv';
        return response((string) $csvReader)
                ->header('Content-Type', 'text/csv; charset=UTF-8')
                ->header('Content-Disposition', 'attachment; filename="'.$filename.'"');
    }
}
