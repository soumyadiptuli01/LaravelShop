<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;

Route::post('/v1/register',[AdminController::class, 'registerCustomer']);
Route::post('/v1/login',[AdminController::class, 'loginCustomer']);
Route::middleware('auth:sanctum')->group(function(){
	Route::get('/v1/products',[ProductController::class,'apiAllProducts']);
	Route::get('/v1/product/{id}',[ProductController::class,'apiSingleProduct']);
	Route::get('/v1/categories',[CategoryController::class,'apiAllCategories']);
	Route::post('/v1/placeorder',[OrderController::class,'placeOrder']);
	Route::get('/v1/logout',[AdminController::class,'apiLogout']);
});