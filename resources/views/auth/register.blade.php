@extends('layouts.app')

@section('content')
<style>
    .auth-shell {
        min-height: calc(100vh - 220px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2.5rem 1rem;
    }
    .auth-card {
        width: 100%;
        max-width: 960px;
        border-radius: 1.25rem;
        overflow: hidden;
        box-shadow: 0 1.5rem 3rem rgba(20, 20, 43, 0.12);
        background: #fff;
    }
    .auth-card .row {
        min-height: 560px;
    }
    .auth-brand {
        background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        color: #fff;
        padding: 3rem 2.5rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }
    .auth-brand::before,
    .auth-brand::after {
        content: "";
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.08);
    }
    .auth-brand::before { width: 220px; height: 220px; top: -60px; right: -60px; }
    .auth-brand::after { width: 160px; height: 160px; bottom: -50px; left: -40px; }
    .auth-brand h2 { font-weight: 700; }
    .auth-brand p { opacity: .85; }
    .auth-form-side {
        padding: 3rem 2.5rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .auth-form-side .btn-primary {
        background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        border: none;
        padding: .65rem 1.25rem;
        font-weight: 600;
    }
    .auth-form-side .form-control {
        border-radius: .6rem;
        padding: .7rem .9rem;
    }
    .auth-form-side .form-floating > label { color: #6b7280; }
    @media (max-width: 767.98px) {
        .auth-brand { padding: 2rem; text-align: center; }
        .auth-card .row { min-height: auto; }
    }
</style>

<div class="auth-shell">
    <div class="auth-card">
        <div class="row g-0">
            <div class="col-md-5 auth-brand">
                <h2 class="mb-3">{{ config('app.name', 'Laravel') }}</h2>
                <p class="mb-0">{{ __('Join the alumni network to reconnect with classmates, discover events, and grow your community.') }}</p>
            </div>
            <div class="col-md-7 auth-form-side">
                <h4 class="fw-bold mb-1">{{ __('Register') }}</h4>
                <p class="text-muted mb-4">{{ __('Create your account to get started') }}</p>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-floating mb-3">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Your name">
                        <label for="name">{{ __('Name') }}</label>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="name@example.com">
                        <label for="email">{{ __('Email Address') }}</label>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">
                        <label for="password">{{ __('Password') }}</label>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-floating mb-4">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm password">
                        <label for="password-confirm">{{ __('Confirm Password') }}</label>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        {{ __('Register') }}
                    </button>

                    @if (Route::has('login'))
                        <p class="text-center text-muted mt-4 mb-0">
                            {{ __('Already have an account?') }}
                            <a href="{{ route('login') }}" class="text-decoration-none fw-semibold">{{ __('Login') }}</a>
                        </p>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
