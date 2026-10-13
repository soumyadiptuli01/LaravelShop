@extends('layout.layout')
@section('pageTitle','Dashboard')
@section('content')
	<section class="content">
		<div class="page-head">
			<div><h1>Dashboard</h1><p>Here's what's happening with your store today.</p></div>
			<a class="btn" href="{{route('addproductview')}}">+ Add product</a>
		</div>
		<div class="grid">
			<div class="stat">
				<div class="label">Total products</div>
				<div class="value">{{$products}}</div>
				<div class="hint">Products in catalogue</div>
			</div>
			
			<div class="stat">
				<div class="label">Categories</div>
				<div class="value">{{$categories}}</div>
				<div class="hint">Organised collections</div>
			</div>
			
			<div class="stat"><div class="label">Total orders</div><div class="value">356</div><div class="hint">Across all customers</div></div><div class="stat"><div class="label">Customers</div><div class="value">241</div><div class="hint">Registered accounts</div></div></div>
	</section>
@endsection