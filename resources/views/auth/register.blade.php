@extends('layouts.auth')

@section('content')
    <h4 class="fw-bold">Create an Account</h4>
    <p class="mb-0">Please fill in your details to register</p>

    <div class="form-body mt-4">
        <form method="POST" action="{{ route('register') }}" class="row g-3">
            @csrf

            <!-- Name -->
            <div class="col-12">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required
                    autofocus autocomplete="name" placeholder="Enter your name">
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="col-12">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}"
                    required autocomplete="username" placeholder="Enter your email">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="col-12">
                <label for="password" class="form-label">Password</label>
                <div class="input-group" id="show_hide_password">
                    <input type="password" class="form-control" id="password" name="password" required
                        autocomplete="new-password" placeholder="Enter Password">
                    <a href="javascript:;" class="input-group-text bg-transparent"><i class="bi bi-eye-slash-fill"></i></a>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="col-12">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <div class="input-group" id="show_hide_password_confirm">
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                        required autocomplete="new-password" placeholder="Confirm Password">
                    <a href="javascript:;" class="input-group-text bg-transparent"><i class="bi bi-eye-slash-fill"></i></a>
                </div>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Select Role -->
            <div class="col-12">
                <label for="role" class="form-label">Role</label>
                <select class="form-select" id="role" name="role" class="text-black">
                    <option value="apprentice" selected class="text-black">Apprentice</option>
                    <option value="tutor" class="text-black">Tutor</option>
                    <option value="admin" class="text-black">Admin</option>
                </select>
            </div>

            <!-- Register Button -->
            <div class="col-12">
                <div class="d-grid">
                    <button type="submit" class="btn btn-grd-primary">Register</button>
                </div>
            </div>

            <!-- Login Link -->
            <div class="col-12">
                <div class="text-start">
                    <p class="mb-0">Already have an account? <a href="{{ route('login') }}">Login here</a></p>
                </div>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function() {
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
