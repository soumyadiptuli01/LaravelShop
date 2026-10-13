@extends('layout.layout')
@section('pageTitle', 'All Category')
@section('content')
<section class="content">
<div class="page-head">
	<div>
		<h1>Categories</h1>
		<p>Organise products into categories.</p>
	</div>
	<a class="btn" href="{{url()->to('add-category')}}">+ Add category</a>
</div>
<div class="table-wrap">
	<table>
		<thead>
			<tr>
				<th>ID</th>
				<th>Category</th>
				<th>Description</th>
				<th>Products</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			@foreach($cats as $cat)
				<tr>
					<td>{{$cat->id}}</td>
					<td><strong>{{$cat->name}}</strong></td>
					<td>{{$cat->description}}</td>
					<td>{{count($cat->products)}}</td>
					<td class="actions"><a class="btn secondary small" href="category-add.html">Edit</a><button class="btn danger small" type="button">Delete</button></td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>
</section>
@endsection