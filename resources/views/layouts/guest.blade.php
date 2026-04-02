<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CopyGen AI') }} - Authentication</title>

    <script defer src="https://unpkg.com/lucide@latest"></script>
    <meta name="turbo-prefetch" content="true">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    
    <style>
        body { 
            background: radial-gradient(circle at center, #F8FAFC 0%, #E2E8F0 100%);
            min-height: 100vh;
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center py-5">
    
    <div class="position-absolute top-0 end-0 p-4">
        <a href="{{ route('locale.switch', app()->getLocale() == 'ar' ? 'en' : 'ar') }}" class="btn btn-sm btn-outline-primary fw-bold text-decoration-none" data-turbo="false">
            {{ app()->getLocale() == 'ar' ? 'English' : 'عربي' }}
        </a>
    </div>

    <div class="container">
        <div class="row justify-content-center fade-in">
            <div class="col-12 col-md-8 col-lg-5 col-xl-4">
                
                <div class="text-center mb-4 pb-2">
                    <div class="bg-white d-inline-flex align-items-center justify-content-center p-3 rounded-circle shadow-sm border mb-3" style="border-color: rgba(99,102,241, 0.2) !important;">
                        <i data-lucide="sparkles" class="text-primary w-6 h-6"></i>
                    </div>
                    <h4 class="brand-text fw-bolder text-dark m-0">{{ __('CopyGen AI') }}</h4>
                </div>

                @yield('content')
                
            </div>
        </div>
    </div>
</body>
</html>
