@extends('layouts.app')

@section('content')
<div class="row fade-in">
    <div class="col-12 mb-4 d-flex align-items-center justify-content-center">
        <div class="d-flex w-100 flex-column align-items-center text-center" style="max-width: 550px;">
            <div class="bg-primary bg-opacity-10 p-3 rounded-4 mb-3 d-none d-md-inline-block">
                <i data-lucide="user-cog" class="text-primary w-6 h-6"></i>
            </div>
            <h3 class="fw-bolder m-0 text-dark">{{ __('Settings & Profile') }}</h3>
            <p class="text-secondary fw-medium mt-2 mb-0">{{ __('Manage your account preferences and personal details.') }}</p>
        </div>
    </div>

    <div class="col-12 d-flex justify-content-center">
        <div class="w-100" style="max-width: 550px;">
        <div class="card border-0 shadow-sm" style="border-radius: 20px;">
            <div class="card-body p-4 p-md-5">
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4 pb-2">
                        <label for="name" class="form-label text-secondary small fw-bold text-uppercase d-flex justify-content-between">
                            <span>{{ __('Full Name') }}</span>
                            <i data-lucide="user" class="w-4 h-4 opacity-50"></i>
                        </label>
                        <input id="name" type="text" class="form-control form-control-lg fs-6 fw-bold text-dark @error('name') is-invalid @enderror" name="name" value="{{ old('name', Auth::user()->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback fw-medium"><i data-lucide="alert-circle" class="w-4 h-4 me-1"></i>{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label for="email" class="form-label text-secondary small fw-bold text-uppercase d-flex justify-content-between">
                            <span>{{ __('Email Address') }}</span>
                            <i data-lucide="mail" class="w-4 h-4 opacity-50"></i>
                        </label>
                        <input id="email" type="email" class="form-control form-control-lg fs-6 bg-light text-muted" name="email" value="{{ Auth::user()->email }}" disabled>
                        <div class="form-text mt-2 fw-medium"><i data-lucide="lock" class="w-3 h-3 me-1 d-inline"></i> {{ __('Email modification is locked for security.') }}</div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-3 shadow-sm rounded-lg fw-bolder fs-6 d-flex align-items-center justify-content-center">
                        <i data-lucide="save" class="me-2 w-5 h-5"></i> {{ __('Save Changes') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
