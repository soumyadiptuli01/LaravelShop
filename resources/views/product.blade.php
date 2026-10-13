@extends('layout.layout')
@section('pageTitle','All Products')
@section('content')
<section class="content">
	<div class="page-head">
		<div>
			<h1>Products</h1>
			<p>Manage the products available in your store.</p>
		</div>
		<a class="btn" href="{{route('addproductview')}}">+ Add product</a>
	</div>
	<div class="table-wrap">
		<table>
			<thead>
				<tr>
					<th>Product</th>
					<th>Category</th>
					<th>Price</th>
					<th>Stock</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach($products as $product)
					<tr>
						<td>
							<div class="product">
								<div class="thumb"><img src="{{asset('storage/productimages/'.$product->image)}}" style="width:35px; height: 35px;"/></div>
								<div><strong>{{$product->name}}</strong></div>
							</div>
						</td>
						<td>{{$product->category->name}}</td>
						<td>${{$product->price}}</td>
						<td>{{$product->stock}}</td>
						<td class="actions">
							<a class="btn secondary small" href="product-add.html">Edit</a>
							<button class="btn danger small" type="button">Delete</button>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</section>
@endsection