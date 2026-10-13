<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminController extends Controller
{
    function login(Request $request){
		$validate = $request->validate([
			'email'=>'required|email|exists:users,email',
			'password'=>'required'
		],[
			'email.required'=>'Email field is mandatory',
			'email.email'=>'Please enter valid email address',
			'email.exists'=>'No user found with this email address',
			'password.required'=>'Password field is mandatory'
		]);
		
		if(Auth::attempt($validate)){
			$request->session()->regenerate();
			
			$user = Auth::user();
			if($user->role != 'admin'){
				Auth::logout();
				$request->session()->invalidate();
				$request->session()->regenerateToken();
				
				return redirect()->to("/")->with("error","You are not allowed");
			}
			
			return redirect("/dashboard");
		} else {
			return redirect()->to("/")->with("error","Email or Password is invalid");
		}
	}
	
	function logout(Request $request){
		$user = Auth::user();
		if($user->role != 'admin'){
			abort('403');
		}
		Auth::logout();
		$request->session()->invalidate();
		$request->session()->regenerateToken();
		
		return redirect("/");
	}
	
	function registerCustomer(Request $request){
		//dd($request->all());
		$validator=Validator::make($request->all(),[
			'name'=>'required',
			'email'=>'required|email|unique:users,email',
			'password'=>'required',
		],[
			'name.required'=>'Please enter name',
			'email.required'=>'Please enter email',
			'email.email'=>'Please enter valid email',
			'email.unique'=>'This email already in use',
			'password.required'=>'Please enter password',
		]);
		
		 if ($validator->fails()) {
			return response()->json([
				'status' => false,
				'errors' => $validator->errors()
			], 422);
		}
		
		$customer = User::create([
			'name'=>$request->name,
			'email'=>$request->email,
			'password'=>$request->password,
			'role'=>'customer',
		]);
		
		if($customer){
			return response()->json([
				'status'=>true,
				'message'=>'Registration Successful',
				'details'=>$customer
			],201);
		} else {
			return response()->json([
				'status'=>false,
				'message'=>'Try again'
			],400);
		}
	}
	
	function loginCustomer(Request $request){
		$validator = Validator::make($request->all(),[
			'email'=>'required|email|exists:users,email',
			'password'=>'required'
		]);
		
		if($validator->fails()){
			return response()->json([
				'status' => false,
				'errors' => $validator->errors()
			], 422);
		}
		
		$user = User::where('email',$request->email)->first();
		if($user && Hash::check($request->password, $user->password)){
			$token = $user->createToken('myapp')->plainTextToken;
			return response()->json([
				'status' => true,
				'message'=>'Login Success',
				'details' => $user,
				'token'=>$token
			], 200);
		} else {
			return response()->json([
				'status' => false,
				'message'=>'Try again'
			], 400);
		}
	}
	
	function apiLogout(Request $request){
		$request->user()->currentAccessToken()->delete();
		return response()->json([
			'status'=>true,
			'message'=>'Logout Successful'
		],200);
	}
}
