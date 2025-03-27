@extends('layouts.auth')

@section('content')
<!-- Logo -->
<div class="d-flex justify-content-center align-items-center mb-4" style="height: 200px;">
    <img src="{{ asset('assets/images/logo1.png') }}" alt="Logo" class="img-fluid" style="max-height: 100px;">
</div>

<h4 class="fw-bold">Get Started Now</h4>
<p class="mb-0">Enter your credentials to login your account</p>

<!-- Session Status -->
<x-auth-session-status class="mb-4" :status="session('status')" />

<div class="form-body mt-4">
    <form method="POST" action="{{ route('login') }}" class="row g-3">
        @csrf

        <!-- Email Address -->
        <div class="col-12">
            <label for="name" class="form-label">Username</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                required autofocus autocomplete="username" placeholder="Enter your username">
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="col-12">
            <label for="password" class="form-label">Password</label>
            <div class="input-group" id="show_hide_password">
                <input type="password" class="form-control" id="password" name="password" required
                    autocomplete="current-password" placeholder="Enter Password">
                <a href="javascript:;" class="input-group-text bg-transparent"><i class="bi bi-eye-slash-fill"></i></a>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="col-md-6">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="remember_me" name="remember">
                <label class="form-check-label" for="remember_me">Remember Me</label>
            </div>
        </div>

        <!-- Forgot Password -->
        <div class="col-md-6 text-end">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">Forgot Password?</a>
            @endif
        </div>

        <!-- Login Button -->
        <div class="col-12">
            <div class="d-grid">
                <button type="submit" class="btn btn-grd-primary">Login</button>
            </div>
        </div>

        <!-- Register Link -->
        <div class="col-12">
            <div class="text-start">
                <p class="mb-0">Don't have an account yet? <a href="{{ route('register') }}">Sign up here</a></p>
            </div>
        </div>
    </form>
</div>
@endsection
