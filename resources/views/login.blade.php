<!doctype html>
<html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Admin Login</title><link rel="stylesheet" href="{{asset('css/style.css')}}"></head>
<body class="login-page">
  <main class="login-card">
    <div class="brand">Shop<span>Admin</span></div>
    <p>Sign in to manage your store.</p>
    <h1>Welcome back</h1>
    <form action="{{route('loginsubmit')}}" method="post">
	@csrf
	@if(session('error'))<p class="error">{{session('error')}}</p>@endif
		<div class="field">
			<label for="email">Email address</label>
			<input id="email" name="email" type="email" placeholder="admin@example.com" value="{{old('email')}}">
			@error('email')<span class="error">{{$message}}</span>@enderror
		</div>
		<div class="field">
			<label for="password">Password</label>
			<input id="password" name="password" type="password" placeholder="Enter your password" value="{{old('password')}}">
			@error('password')<span class="error">{{$message}}</span>@enderror
		</div>
      <button class="btn" type="submit">Sign in</button>
    </form>
    <p class="muted" style="font-size:12px;margin-top:20px">UI demo only. Connect this form to Laravel authentication.</p>
  </main>
<style>
.error{color:#ff0000;}
</style>
</body></html>
