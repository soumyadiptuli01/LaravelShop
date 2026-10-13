<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Order;

class Product extends Model
{
    protected $fillable=[
		'category_id',
		'name',
		'description',
		'price',
		'stock',
		'image',
	];
	
	function category(){
		return $this->belongsTo(Category::class);
	}
	
	function orders(){
		return $this->belongsToMany(Order::class)->withPivot('quantity', 'price');
	}
}
