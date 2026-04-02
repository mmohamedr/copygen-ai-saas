@extends('layouts.guest')

@section('content')
<div class="card border-0 shadow-lg" style="border-radius: 24px;">
    <div class="card-body p-5">
        <h3 class="fw-bolder mb-1 text-dark text-center">{{ __('Welcome Back') }}</h3>
        <p class="text-secondary text-center fw-medium mb-4 pb-3">{{ __('Please enter your credentials to log in.') }}</p>
        
        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="mb-4">
                <label for="email" class="form-label text-secondary small fw-bold text-uppercase d-flex justify-content-between">
                    <span>{{ __('Email Address') }}</span>
                    <i data-lucide="mail" class="w-4 h-4 opacity-50"></i>
                </label>
                <input id="email" type="email" class="form-control form-control-lg fs-6 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="you@company.com" required autofocus>
                @error('email')
                    <div class="invalid-feedback fw-medium"><i data-lucide="alert-circle" class="w-4 h-4 me-1"></i>{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="form-label text-secondary small fw-bold text-uppercase d-flex justify-content-between">
                    <span>{{ __('Password') }}</span>
                    <i data-lucide="key" class="w-4 h-4 opacity-50"></i>
                </label>
                <input id="password" type="password" class="form-control form-control-lg fs-6 @error('password') is-invalid @enderror" name="password" placeholder="••••••••" required>
                @error('password')
                    <div class="invalid-feedback fw-medium"><i data-lucide="alert-circle" class="w-4 h-4 me-1"></i>{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-5 form-check d-flex align-items-center">
                <input type="checkbox" class="form-check-input mt-0 me-2" id="remember" name="remember" style="width: 1.25em; height: 1.25em;">
                <label class="form-check-label text-secondary fw-medium pt-1" for="remember">{{ __('Keep me logged in') }}</label>
            </div>

            <button type="submit" class="btn btn-primary w-100 py-3 shadow-sm rounded-lg fw-bolder fs-6">
                {{ __('Enter Dashboard') }} <i data-lucide="arrow-right" class="w-5 h-5 ms-2"></i>
            </button>
        </form>

        <div class="mt-5 pt-3 border-top text-center d-flex justify-content-center gap-1">
            <span class="text-secondary fw-medium">{{ __("Don't have an account?") }}</span> 
            <a href="{{ route('register') }}" class="text-decoration-none fw-bold" style="color: #4F46E5;">{{ __('Sign up free') }}</a>
        </div>
    </div>
</div>
@endsection
