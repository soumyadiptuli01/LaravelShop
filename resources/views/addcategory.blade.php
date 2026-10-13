@extends('layout.layout')
@section('pageTitle','Add Category')
@section('content')
<section class="content">
	<div class="page-head">
		<div><h1>Add category</h1><p>Create a category to organise your products.</p></div>
		<a class="btn secondary" href="categories.html">← Back to categories</a>
	</div>
	<div class="form-card">
	@if(session('success'))<span>{{session('success')}}</span>@endif
			@if(session('error'))<span>{{session('error')}}</span>@endif
		<form action="{{route('storecategory')}}" method="post">
			@csrf
			<div class="form-grid">
				<div class="field full">
					<label for="name">Category name *</label>
					<input id="name" name="name" placeholder="e.g. Clothing">
					@error('name')<span>{{$message}}</span>@enderror
				</div>
				<div class="field full">
					<label for="description">Description</label>
					<textarea id="description" name="description" placeholder="Short category description..."></textarea>
				</div>
			</div>
			<div class="form-actions">
				<button class="btn" type="submit">Save category</button>
				<a class="btn secondary" href="categories.html">Cancel</a>
			</div>
		</form>
	</div>
</section>
@endsection