@extends('layouts.auth')

@section('content')
    <h4 class="fw-bold">Confirm Password</h4>
    <p class="mb-0">This is a secure area of the application. Please confirm your password before continuing.</p>

    <div class="form-body mt-4">
        <form method="POST" action="{{ route('password.confirm') }}" class="row g-3">
            @csrf

            <!-- Password -->
            <div class="col-12">
                <label for="password" class="form-label">Password</label>
                <div class="input-group" id="show_hide_password">
                    <input type="password" class="form-control" id="password" name="password" required
                        autocomplete="current-password" placeholder="Enter your password">
                    <a href="javascript:;" class="input-group-text bg-transparent"><i class="bi bi-eye-slash-fill"></i></a>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Submit Button -->
            <div class="col-12">
                <div class="d-grid">
                    <button type="submit" class="btn btn-grd-primary">Confirm</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function() {
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
        });
    </script>
@endsection
