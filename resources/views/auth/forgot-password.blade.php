@extends('layouts.auth')

@section('content')
    <h4 class="fw-bold">Forgot Password</h4>
    <p class="mb-0">Enter your email to receive a password reset link</p>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="form-body mt-4">
        <form method="POST" action="{{ route('password.email') }}" class="row g-3">
            @csrf

            <!-- Email Address -->
            <div class="col-12">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}"
                    required autofocus placeholder="Enter your email">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Submit Button -->
            <div class="col-12">
                <div class="d-grid">
                    <button type="submit" class="btn btn-grd-primary">Email Password Reset Link</button>
                </div>
            </div>

            <!-- Back to Login Link -->
            <div class="col-12">
                <div class="text-start">
                    <p class="mb-0">Remember your password? <a href="{{ route('login') }}">Back to login</a></p>
                </div>
            </div>
        </form>
    </div>
@endsection
