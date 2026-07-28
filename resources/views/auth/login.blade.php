@extends('layouts.app')

@section('content')
<style>
    .auth-shell {
        min-height: calc(100vh - 220px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2.5rem 1rem;
        background: radial-gradient(circle at 15% 15%, rgba(124, 58, 237, 0.07), transparent 45%),
                    radial-gradient(circle at 85% 85%, rgba(79, 70, 229, 0.07), transparent 45%);
    }
    .auth-card {
        width: 100%;
        max-width: 980px;
        border-radius: 1.5rem;
        overflow: hidden;
        box-shadow: 0 2rem 4rem rgba(20, 20, 43, 0.14), 0 0.25rem 0.75rem rgba(20, 20, 43, 0.06);
        background: #fff;
        animation: authCardIn .5s ease both;
    }
    @keyframes authCardIn {
        from { opacity: 0; transform: translateY(14px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .auth-card .row { min-height: 540px; }

    .auth-brand {
        background: linear-gradient(160deg, #4338ca 0%, #6d28d9 55%, #9333ea 100%);
        color: #fff;
        padding: 3rem 2.75rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }
    .auth-brand .brand-badge {
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        width: fit-content;
        font-size: .75rem;
        font-weight: 600;
        letter-spacing: .04em;
        text-transform: uppercase;
        background: rgba(255, 255, 255, 0.14);
        border: 1px solid rgba(255, 255, 255, 0.25);
        padding: .35rem .75rem;
        border-radius: 999px;
        margin-bottom: 1.5rem;
    }
    .auth-brand h2 { font-weight: 700; letter-spacing: -.02em; }
    .auth-brand p { opacity: .85; line-height: 1.6; max-width: 320px; }
    .auth-brand .brand-nodes {
        position: absolute;
        inset: 0;
        opacity: .5;
        pointer-events: none;
    }
    .auth-brand::before,
    .auth-brand::after {
        content: "";
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.08);
    }
    .auth-brand::before { width: 260px; height: 260px; top: -80px; right: -80px; }
    .auth-brand::after { width: 180px; height: 180px; bottom: -60px; left: -50px; }

    .auth-form-side {
        padding: 3.25rem 3rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .auth-form-side .eyebrow {
        font-size: .78rem;
        font-weight: 600;
        letter-spacing: .06em;
        text-transform: uppercase;
        color: #7c3aed;
        margin-bottom: .5rem;
    }
    .auth-form-side h4 { font-weight: 700; letter-spacing: -.01em; }

    .input-icon-group { position: relative; }
    .input-icon-group .field-icon {
        position: absolute;
        left: .9rem;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
        pointer-events: none;
        z-index: 5;
        display: flex;
    }
    .input-icon-group .form-control { padding-left: 2.6rem; }
    .input-icon-group .form-floating > label { padding-left: 2.6rem; }
    .input-icon-group .form-control:focus ~ .field-icon { color: #7c3aed; }

    .auth-form-side .form-control {
        border-radius: .7rem;
        padding-top: 1.1rem;
        padding-bottom: .4rem;
        border-color: #e5e7eb;
        transition: border-color .15s ease, box-shadow .15s ease;
    }
    .auth-form-side .form-control:focus {
        border-color: #a78bfa;
        box-shadow: 0 0 0 .2rem rgba(124, 58, 237, .12);
    }
    .auth-form-side .form-floating > label { color: #9ca3af; }

    .auth-form-side .btn-primary {
        background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        border: none;
        padding: .75rem 1.25rem;
        font-weight: 600;
        border-radius: .7rem;
        box-shadow: 0 .5rem 1.25rem rgba(109, 40, 217, .28);
        transition: transform .15s ease, box-shadow .15s ease;
    }
    .auth-form-side .btn-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 .75rem 1.5rem rgba(109, 40, 217, .34);
    }

    .auth-divider {
        display: flex;
        align-items: center;
        gap: .75rem;
        color: #9ca3af;
        font-size: .8rem;
        margin: 1.5rem 0;
    }
    .auth-divider::before,
    .auth-divider::after {
        content: "";
        flex: 1;
        height: 1px;
        background: #e5e7eb;
    }

    @media (max-width: 767.98px) {
        .auth-brand { padding: 2.25rem; text-align: center; align-items: center; }
        .auth-brand p { max-width: none; }
        .auth-form-side { padding: 2.25rem 1.75rem; }
        .auth-card .row { min-height: auto; }
    }
</style>

<div class="auth-shell">
    <div class="auth-card">
        <div class="row g-0">
            <div class="col-md-5 auth-brand">
                <span class="brand-badge">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    {{ __('Alumni Network') }}
                </span>
                <h2 class="mb-3">{{ config('app.name', 'Laravel') }}</h2>
                <p class="mb-0">{{ __('Welcome back! Sign in to stay connected with your alumni network, events, and community updates.') }}</p>
            </div>
            <div class="col-md-7 auth-form-side">
                <div class="eyebrow">{{ __('Welcome back') }}</div>
                <h4 class="mb-1">{{ __('Login to your account') }}</h4>
                <p class="text-muted mb-4">{{ __('Enter your credentials to access your account') }}</p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="input-icon-group form-floating mb-3">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="name@example.com">
                        <label for="email">{{ __('Email Address') }}</label>
                        <span class="field-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16v16H4z" opacity="0"/><path d="M22 6 12 13 2 6"/><path d="M2 6h20v12H2z"/></svg>
                        </span>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="input-icon-group form-floating mb-3">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                        <label for="password">{{ __('Password') }}</label>
                        <span class="field-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        </span>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>

                        @if (Route::has('password.request'))
                            <a class="small text-decoration-none" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        {{ __('Login') }}
                    </button>

                    @if (Route::has('register'))
                        <div class="auth-divider">{{ __('New here') }}</div>
                        <a href="{{ route('register') }}" class="btn btn-outline-secondary w-100">
                            {{ __('Create an account') }}
                        </a>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
