<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Resources\CategoryDetailsResource;

class CategoryController extends Controller
{
    function storeCategory(Request $request){
		$request->validate([
			'name'=>'required|unique:categories,name',
		],[
			'name.required'=>'Category name is required field',
			'name.unique'=>'Category name already exist'
		]);
		
		$cat = Category::create([
			'name'=>$request->name,
			'description'=>$request->description
		]);
		
		if($cat){
			return redirect('/add-category')->with('success','Category added');
		} else {
			return redirect('/add-category')->with('error','Try again');
		}
	}
	
	function allcategory(){
		$cats = Category::with('products')->get();
		return view('category',['cats'=>$cats]);
	}
	
	function apiAllCategories(){
		$cats = Category::all();
		return response()->json([
			'status'=>true,
			'categories'=>CategoryDetailsResource::collection($cats)
		],200);
	}
	
	
}
