<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class CustomerController extends Controller
{
    function allCustomers(){
		$customers = User::where('role','customer')->with('orders')->get();
		return view('customer',['customers'=>$customers]);
	}
}
