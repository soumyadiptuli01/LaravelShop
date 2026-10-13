<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerController;
use App\Models\Product;
use App\Models\Category;

Route::get('/', function () {
    return view('login');
})->name('login');
Route::post('/login',[AdminController::class,'login'])->name('loginsubmit');

Route::middleware('auth')->group(function(){
	Route::get('/dashboard', function () {
		$products = Product::count();
		$categories = Category::count();
		return view('dashboard',['products'=>$products, 'categories'=>$categories]);
	});
	Route::get('/logout',[AdminController::class,'logout']);
	
	Route::get('/add-category',function(){
		return view('addcategory');
	});
	Route::post('/post-category',[CategoryController::class,'storeCategory'])->name('storecategory');
	Route::get('/categories',[CategoryController::class,'allCategory'])->name('allcategory');
	
	Route::get('/add-product',[ProductController::class,'addProduct'])->name('addproductview');
	Route::post('/add-product',[ProductController::class,'storeProduct'])->name('storeproduct');
	Route::get('/products',[ProductController::class,'productList'])->name('allproducts');
	
	Route::get('/orders',[OrderController::class,'allOrders'])->name('orders');
	Route::put('/updatestatus/{id}',[OrderController::class,'updateStatus']);
	
	Route::get('/customers',[CustomerController::class,'allCustomers'])->name('customer');
});