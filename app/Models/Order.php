<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\User;

class Order extends Model
{
    protected $fillable=[
		'user_id',
		'total_amount',
		'shipping_address',
		'notes',
		'status',
	];
	
	function products(){
		return $this->belongsToMany(Product::class)->withPivot('quantity', 'price');
	}
	
	function user(){
		return $this->belongsTo(User::class);
	}
}
