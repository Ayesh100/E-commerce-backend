@extends('layouts.auth.auth')
@section('form-content')

<div class="container mt-5">
    <h2 class="text-center">LOGIN FORM</h2>
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email" required>
            <div class="invalid-feedback">
                Please enter a valid email address.
            </div>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
            <div class="invalid-feedback">
                Please enter your password.
            </div>
        </div>
        <div class="container d-flex justify-content-between">
        <div class=" form-check">
            <input type="checkbox" class="form-check-input" id="remember" name="remember">
            <label class="form-check-label" for="remember">Remember me</label>
        </div>
        <div class="">
            <a href="#">Forgot your password?</a>
        </div>
    </div>
        <button type="submit" class="btn btn-primary mt-5 mb-5 w-100">LOGIN</button>
    </form>
</div>


@endsection