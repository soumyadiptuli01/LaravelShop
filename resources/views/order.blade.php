@extends('layout.layout')
@section('pageTitle','All Orders')
@section('content')
<section class="content">
	<div class="page-head">
		<div>
			<h1>Orders</h1>
			<p>View customer purchases and order status.</p>
		</div>
	</div>
	<div class="table-wrap">
		<?php //echo "<pre>"; print_r($orders->toArray()); echo "</pre>"; ?>
		<table>
			<thead>
				<tr>
					<th>Order ID</th>
					<th>Customer</th>
					<th>Order date</th>
					<th>Item</th>
					<th>Quantity</th>
					<th>Total</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($orders as $order)
					<tr>
						<td><strong>#{{$order->id}}</strong></td>
						<td>{{$order->user->name}}</td>
						<td>{{$order->created_at->format('d/m/Y')}}</td>
						@foreach ($order->products as $product) 
							<td>{{$product->name}}</td>
							<td>{{$product->pivot->quantity}}</td>
							<td>₹{{$product->pivot->price * $product->pivot->quantity}}</td>
							<td><span class="badge orange">{{$order->status}}</span></td>
						@endforeach
						@if($order->status!=='Completed' && $order->status!=='Cancelled')
							<td>
								<form action="/updatestatus/{{$order->id}}" method="post">
								@csrf
								@method('PUT')
									<select name="update_status">
										<option>Update Status</option>
										<option value="Completed">Completed</option>
										<option value="Cancelled">Cancelled</option>
									</select>
									
									<br />
									<button type="submit">Update</button>
								</form>
							</td>
						@else 
							<td>Already Updated</td>
						@endif
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</section>
@endsection