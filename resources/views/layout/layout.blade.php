<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('pageTitle') | ShopAdmin</title>
	<link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>
	<div class="layout">
		<aside class="sidebar">
			<div class="brand">Shop<span>Admin</span></div>
			<div class="nav-label">Workspace</div>
			<nav class="nav">
				<a class="active" href="/dashboard">▦ &nbsp; Dashboard</a>
				<a href="{{route('allproducts')}}">▣ &nbsp; Products</a>
				<a href="{{route('allcategory')}}">▤ &nbsp; Categories</a>
				<a href="{{route('orders')}}">▧ &nbsp; Orders</a>
				<a href="{{route('customer')}}">♙ &nbsp; Customers</a>
				<a href="/logout">↪ &nbsp; Logout</a>
			</nav>
		</aside>
	<main class="main">
		<header class="topbar"><span class="small">Store management</span><span class="admin">Admin ▾</span></header>
		@yield('content')
	</main></div></body></html>
