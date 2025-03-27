@extends('layouts.auth')

@section('content')
    <h4 class="fw-bold">Reset Password</h4>
    <p class="mb-0">Create a new password for your account</p>

    <div class="form-body mt-4">
        <form method="POST" action="{{ route('password.store') }}" class="row g-3">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div class="col-12">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email"
                    value="{{ old('email', $request->email) }}" required autofocus autocomplete="username" readonly>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="col-12">
                <label for="password" class="form-label">New Password</label>
                <div class="input-group" id="show_hide_password">
                    <input type="password" class="form-control" id="password" name="password" required
                        autocomplete="new-password" placeholder="Enter new password">
                    <a href="javascript:;" class="input-group-text bg-transparent"><i class="bi bi-eye-slash-fill"></i></a>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="col-12">
                <label for="password_confirmation" class="form-label">Confirm New Password</label>
                <div class="input-group" id="show_hide_password_confirm">
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                        required autocomplete="new-password" placeholder="Confirm new password">
                    <a href="javascript:;" class="input-group-text bg-transparent"><i class="bi bi-eye-slash-fill"></i></a>
                </div>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Submit Button -->
            <div class="col-12">
                <div class="d-grid">
                    <button type="submit" class="btn btn-grd-primary">Reset Password</button>
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

    <script>
        $(document).ready(function() {
            // For password field
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("bi-eye-slash-fill");
                    $('#show_hide_password i').removeClass("bi-eye-fill");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("bi-eye-slash-fill");
                    $('#show_hide_password i').addClass("bi-eye-fill");
                }
            });

            // For password confirmation field
            $("#show_hide_password_confirm a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password_confirm input').attr("type") == "text") {
                    $('#show_hide_password_confirm input').attr('type', 'password');
                    $('#show_hide_password_confirm i').addClass("bi-eye-slash-fill");
                    $('#show_hide_password_confirm i').removeClass("bi-eye-fill");
                } else if ($('#show_hide_password_confirm input').attr("type") == "password") {
                    $('#show_hide_password_confirm input').attr('type', 'text');
                    $('#show_hide_password_confirm i').removeClass("bi-eye-slash-fill");
                    $('#show_hide_password_confirm i').addClass("bi-eye-fill");
                }
            });
        });
    </script>
@endsection
