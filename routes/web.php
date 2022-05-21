<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\UserCheckMiddleware;
use App\Http\Middleware\AdminCheckMiddleware;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PizzaController;
use App\Http\Controllers\User\ContactController;
use App\Http\Controllers\User\CustomerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AdminContactController;



Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        if(Auth::check()){
            if(Auth::user()->role == 'admin'){
                return redirect()->route('admin#profile');
            }else{
                return redirect()->route('user#index');
            }
        }
    });
});

Route::group(['prefix'=>'admin', 'namespace'=>'Admin','middleware'=>[AdminCheckMiddleware::class]], function(){

    Route::get('/profile', [AdminController::class, 'profile'])->name('admin#profile');
    Route::post('/updateProfile/{id}', [AdminController::class, 'updateProfile'])->name('admin#updateProfile');
    Route::get('/changePasswordPage', [AdminController::class, 'changePasswordPage'])->name('admin#changePasswordPage');
    Route::post('/changePassword/{id}', [AdminController::class, 'changePassword'])->name('admin#changePassword');

    Route::get('/category', [CategoryController::class, 'category'])->name('admin#category');
    Route::get('/categoryItem/{id}', [CategoryController::class, 'categoryItem'])->name('admin#categoryItem');
    Route::get('/addCategory', [CategoryController::class, 'addCategory'])->name('admin#addCategory');
    Route::post('/createCategory', [CategoryController::class, 'createCategory'])->name('admin#createCategory');

    Route::post('/deleteCategory/{id}', [CategoryController::class, 'deleteCategory'])->name('admin#deleteCategory');
    Route::get('/editCategory/{id}', [CategoryController::class, 'editCategory'])->name('admin#editCategory');
    Route::post('/updateCategory/{id}', [CategoryController::class, 'updateCategory'])->name('admin#updateCategory');
    Route::get('/searchCategory', [CategoryController::class, 'searchCategory'])->name('admin#searchCategory');
    Route::get('/downloadCategory', [CategoryController::class, 'downloadCategory'])->name('admin#downloadCategory');


    Route::get('/pizza', [PizzaController::class, 'pizza'])->name('admin#pizza');
    Route::get('/addPizza', [PizzaController::class, 'addPizza'])->name('admin#addPizza');
    Route::post('/createPizza', [PizzaController::class, 'createPizza'])->name('admin#createPizza');
    Route::get('/deletePizza/{id}', [PizzaController::class, 'deletePizza'])->name('admin#deletePizza');
    Route::get('/editPizza/{id}', [PizzaController::class, 'editPizza'])->name('admin#editPizza');
    Route::post('/updatePizza/{id}', [PizzaController::class, 'updatePizza'])->name('admin#updatePizza');
    Route::get('/seemorePizza/{id}', [PizzaController::class, 'seemorePizza'])->name('admin#seemorePizza');
    Route::post('/pizza', [PizzaController::class, 'searchPizza'])->name('admin#pizza');
    Route::get('/downloadPizza', [PizzaController::class, 'downloadPizza'])->name('admin#downloadPizza');


    Route::get('/userList', [UserController::class, 'userList'])->name('admin#userList');
    Route::get('/userListDelete/{id}', [UserController::class, 'userListDelete'])->name('admin#userListDelete');
    Route::get('/userListSearch', [UserController::class, 'userListSearch'])->name('admin#userListSearch');
    Route::get('/adminList', [UserController::class, 'adminList'])->name('admin#adminList');
    Route::get('/adminListDelete/{id}', [UserController::class, 'adminListDelete'])->name('admin#adminListDelete');
    Route::get('/adminListEdit/{id}', [UserController::class, 'adminListEdit'])->name('admin#adminListEdit');
    Route::post('/adminListUpdate/{id}', [UserController::class, 'adminListUpdate'])->name('admin#adminListUpdate');
    Route::get('/adminListSearch', [UserController::class, 'adminListSearch'])->name('admin#adminListSearch');

    Route::get('/contactList', [AdminContactController::class, 'contactList'])->name('admin#contactList');
    Route::get('/contactSearch', [AdminContactController::class, 'contactSearch'])->name('admin#contactSearch');

    Route::get('/orderList', [OrderController::class, 'orderList'])->name('admin#orderList');
    Route::get('/orderSearch', [OrderController::class, 'orderSearch'])->name('admin#orderSearch');
});

Route::group(['prefix'=>'user','namespace'=>'User', 'middleware'=>[UserCheckMiddleware::class]], function(){
    Route::get('/', [CustomerController::class, 'index'])->name('user#index');
    Route::post('/contactCreate', [ContactController::class, 'contactCreate'])->name('user#contactCreate');
    Route::get('/pizzaDetail/{id}', [CustomerController::class, 'pizzaDetail'])->name('user#pizzaDetail');
    Route::get('/categorySearch/{id}', [CustomerController::class, 'categorySearch'])->name('user#categorySearch');
    Route::get('/searchPizza', [CustomerController::class, 'searchPizza'])->name('user#searchPizza');
    Route::get('/searchDatePrice', [CustomerController::class, 'searchDatePrice'])->name('user#searchDatePrice');
    Route::get('/order', [CustomerController::class, 'order'])->name('user#order');
    Route::post('/placeOrder', [CustomerController::class, 'placeOrder'])->name('user#placeOrder');
});
