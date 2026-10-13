<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use App\Models\Order;

class OrderController extends Controller
{
    function placeOrder(Request $request){
		$validator = Validator::make($request->all(),[
			'user_id'=>'required|exists:users,id',
			'shipping_address'=>'required'
		],[
			'user_id.required'=>'Please login',
			'user_id.exists'=>'Not allowed',
			'shipping_address.required'=>'Please enter shipping address',
		]);
		
		if($validator->fails()){
			return response()->json([
				'status'=>false,
				'errors'=>$validator->errors()
			],400);
		} else {
			$price = $request->price;
			$quantity = $request->quantity;
			$order = Order::create([
				'user_id'=>$request->user_id,
				'total_amount'=>$price*$quantity,
				'shipping_address'=>$request->shipping_address,
				'notes'=>$request->notes
			]);
			if($order){
				$order->products()->attach($request->product_id,[
					'quantity' => $quantity,
					'price' => $price
				]);
				
				return response()->json([
					'status'=>true,
					'message'=>'Order Placed',
					'order'=>$order
				],201);
			}
		}
	}
	
	function allOrders(){
		$orders = Order::with(['products','user'])->get();
		return view('order',['orders'=>$orders]);
	}
	
	function updateStatus(Request $request, $id){
		$order = Order::find($id);
		$order->status = $request->update_status;
		if($order->save()){
			return to_route('orders');
		}
	}
}
