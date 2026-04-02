@extends('layouts.guest')

@section('content')
<div class="card border-0 shadow-lg" style="border-radius: 24px;">
    <div class="card-body p-5">
        <h3 class="fw-bolder mb-1 text-dark text-center">{{ __('Create Account') }}</h3>
        <p class="text-secondary text-center fw-medium mb-4 pb-2">{{ __('Start generating premium copy instantly.') }}</p>
        
        <form method="POST" action="{{ route('register') }}">
            @csrf
            
            <div class="mb-4">
                <label for="name" class="form-label text-secondary small fw-bold text-uppercase">{{ __('Full Name') }}</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0 text-muted"><i data-lucide="user" class="w-4 h-4"></i></span>
                    <input id="name" type="text" class="form-control form-control-lg fs-6 border-start-0 ps-0 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>
                </div>
            </div>

            <div class="mb-4">
                <label for="email" class="form-label text-secondary small fw-bold text-uppercase">{{ __('Work Email') }}</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0 text-muted"><i data-lucide="mail" class="w-4 h-4"></i></span>
                    <input id="email" type="email" class="form-control form-control-lg fs-6 border-start-0 ps-0 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                </div>
            </div>

            <div class="mb-4">
                <label for="password" class="form-label text-secondary small fw-bold text-uppercase">{{ __('Password') }}</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0 text-muted"><i data-lucide="lock" class="w-4 h-4"></i></span>
                    <input id="password" type="password" class="form-control form-control-lg fs-6 border-start-0 ps-0 @error('password') is-invalid @enderror" name="password" required>
                </div>
            </div>

            <div class="mb-5 pb-2">
                <label for="password_confirmation" class="form-label text-secondary small fw-bold text-uppercase">{{ __('Confirm Password') }}</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0 text-muted"><i data-lucide="shield-check" class="w-4 h-4"></i></span>
                    <input id="password_confirmation" type="password" class="form-control form-control-lg fs-6 border-start-0 ps-0" name="password_confirmation" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100 py-3 shadow-sm rounded-lg fw-bolder fs-6">
                {{ __('Create Free Account') }} <i data-lucide="user-plus" class="w-5 h-5 ms-2"></i>
            </button>
        </form>

        <div class="mt-5 pt-3 border-top text-center d-flex justify-content-center gap-1">
            <span class="text-secondary fw-medium">{{ __("Already generating?") }}</span> 
            <a href="{{ route('login') }}" class="text-decoration-none fw-bold" style="color: #4F46E5;">{{ __('Log in') }}</a>
        </div>
    </div>
</div>
@endsection
