<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    function addProduct(){
		$cats = Category::select('name','id')->get();
		return view('addproduct',['cats'=>$cats]);
	}
	
	function storeProduct(Request $request){
		$request->validate([
			'name'=>'required',
			'category_id'=>'required|exists:categories,id',
			'price'=>'required|numeric|min:0',
			'stock'=>'required|numeric|min:0',
			'image'=>'required|image|mimes:jpg,jpeg,png,webp|max:2048',
		]);
		
		$path = $request->file('image')->store('productimages','public');
		$filename = explode("/",$path);
		$image = $filename[1];
		
		$product = Product::create([
			'category_id'=>$request->category_id,
			'name'=>$request->name,
			'description'=>$request->description,
			'price'=>$request->price,
			'stock'=>$request->stock,
			'image'=>$image
		]);
		
		if($product){
			return to_route('allproducts');
		} else {
			return to_route('addproductview');
		}
	}
	
	function productList(){
		$products = Product::with('category')->get();
		return view('product',['products'=>$products]);
	}
	
	function apiAllProducts(){
		$products = Product::all();
		return response()->json([
			'status'=>true,
			'product'=>ProductResource::collection($products)
		],200);
	}
	
	function apiSingleProduct($id){
		$product = Product::find($id);
		return response()->json([
			'status'=>true,
			'product'=>new ProductResource($product)
		],200);
	}
}
