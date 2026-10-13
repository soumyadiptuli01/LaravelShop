@extends('layout.layout')
@section('pageTitle','All Customer')
@section('content')
<section class="content">
	<div class="page-head">
		<div>
			<h1>Customers</h1>
			<p>View registered customer accounts.</p>
		</div>
	</div>
	<div class="table-wrap">
		<table>
			<thead>
				<tr>
					<th>Customer</th>
					<th>Email</th>
					<th>Joined</th>
					<th>Total orders</th>
				</tr>
			</thead>
			<tbody>
				@foreach($customers as $customer)
					<tr>
						<td><strong>{{$customer->name}}</strong></td>
						<td>{{$customer->email}}</td>
						<td>{{$customer->created_at->format('d/m/Y')}}</td>
						<td>{{count($customer->orders)}}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</section>
@endsection