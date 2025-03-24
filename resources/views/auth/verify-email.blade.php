@extends('layouts.auth')

@section('content')
    <h4 class="fw-bold">Verify Your Email</h4>
    <p class="mb-3">
        Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just
        emailed to you? If you didn't receive the email, we will gladly send you another.
    </p>

    @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success mb-4">
            A new verification link has been sent to the email address you provided during registration.
        </div>
    @endif

    <div class="form-body mt-4">
        <div class="row g-3">
            <div class="col-12">
                <div class="d-flex justify-content-between">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="btn btn-grd-primary">
                            Resend Verification Email
                        </button>
                    </form>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-secondary">
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
