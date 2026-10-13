@extends('layout.layout')
@section('pageTitle','Add Product')
@section('content')
	<section class="content">
		<div class="page-head">
			<div>
				<h1>Add product</h1>
				<p>Add a new item to your store catalogue.</p>
			</div>
			<a class="btn secondary" href="products.html">← Back to products</a>
		</div>
		<div class="form-card">
			@if($errors->any())
				@foreach($errors->all() as $error)
				{{$error}}
				@endforeach
			@endif
			<form action="{{route('storeproduct')}}" method="post" enctype="multipart/form-data">
				@csrf
				<div class="form-grid">
					<div class="field">
						<label for="name">Product name *</label>
						<input id="name" name="name" placeholder="e.g. Cotton T-shirt" value="{{old('name')}}">
						@error('name')<span>{{$message}}</span>@enderror
					</div>
					<div class="field">
						<label for="category">Category *</label>
						<select id="category" name="category_id">
							<option value="">Select category</option>
							@foreach($cats as $cat)
								<option value="{{$cat->id}}">{{$cat->name}}</option>
							@endforeach
						</select>
						@error('category_id')<span>{{$message}}</span>@enderror
					</div>
					<div class="field">
						<label for="price">Price (₹) *</label>
						<input id="price" name="price" type="text" min="0" step="0.01" placeholder="999.00" value="{{old('price')}}">
						@error('price')<span>{{$message}}</span>@enderror
					</div>
					<div class="field">
						<label for="stock">Stock quantity *</label>
						<input id="stock" name="stock" type="text" min="0" placeholder="25" value="{{old('stock')}}">
						@error('stock')<span>{{$message}}</span>@enderror
					</div>
					<div class="field">
						<label for="image">Product image</label>
						<input id="image" name="image" type="file" accept="image/*">
						@error('image')<span>{{$message}}</span>@enderror
					</div>
					<div class="field full">
						<label for="description">Description</label>
						<textarea id="description" name="description" placeholder="Describe the product...">{{old('description')}}</textarea>
						@error('description')<span>{{$message}}</span>@enderror
					</div>
				</div>
				<div class="form-actions">
					<button class="btn" type="submit">Save product</button>
					<a class="btn secondary" href="products.html">Cancel</a>
				</div>
			</form>
		</div>
	</section>
@endsection