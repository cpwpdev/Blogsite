@extends('layout')
 @section('title','Login')
 @section('content')
 
<div class="container pt-lg-5">
    <div class="row justify-content-center">
    <div class="col-md-6 ">
<h1>Login</h1>
<form method="POST" action="{{ route('login') }}">
@csrf
<div class="form-group  mb-3">
<label for="email">Email</label>
    <input type="email" name="email" class="form-control" id="email" placeholder="Email">
    @error('email')
        {{ $message }}
        @enderror
</div>
<div class="form-group mb-3">
<label for="password">Password</label>
    <input type="password" name="password" class="form-control" id="password" placeholder="Password">
    @error('password')
        {{ $message }}
        @enderror
</div>
<button type="submit" class="btn btn-primary">Login</button>

</form>
</div>
</div>
</div>
 @endsection