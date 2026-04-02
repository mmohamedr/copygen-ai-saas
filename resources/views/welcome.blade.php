<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CopyGen AI') }} - {{ __('Write Marketing Copy That Converts') }}</title>

    <script defer src="https://unpkg.com/lucide@latest"></script>
    <meta name="turbo-prefetch" content="true">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    
    <style>
        .hero-section {
            background: radial-gradient(circle at center top, #F8FAFC 0%, #E2E8F0 100%);
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }
        .text-gradient {
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-image: linear-gradient(135deg, #6366F1 0%, #8B5CF6 100%); 
        }
        .feature-icon-wrapper {
            width: 56px; height: 56px;
            display: inline-flex; align-items: center; justify-content: center;
            border-radius: 16px;
            background: rgba(99, 102, 241, 0.1);
            border: 1px solid rgba(99, 102, 241, 0.2);
            color: #6366F1;
        }
    </style>
</head>
<body>

    <!-- Landing Navbar -->
    <nav class="navbar navbar-expand-lg bg-white border-bottom py-3 position-sticky top-0 z-3 shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center fw-bolder" href="{{ url('/') }}">
                <div class="bg-primary d-inline-flex justify-content-center align-items-center rounded-3 p-1 me-2" style="width: 32px; height: 32px;">
                    <i data-lucide="sparkles" class="text-white w-5 h-5"></i>
                </div>
                {{ __('CopyGen AI') }}
            </a>
            
            <div class="ms-auto d-flex align-items-center gap-3">
                <a href="{{ route('locale.switch', app()->getLocale() == 'ar' ? 'en' : 'ar') }}" class="text-secondary fw-bold text-decoration-none small" data-turbo="false">
                    <i data-lucide="globe" class="w-4 h-4 d-inline align-middle"></i> {{ app()->getLocale() == 'ar' ? 'English' : 'العربية' }}
                </a>
                
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-outline-primary fw-bold px-4">{{ __('Dashboard') }}</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-light fw-bold text-secondary border px-4 d-none d-md-inline-block">{{ __('Log in') }}</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-primary fw-bold shadow-sm px-4">{{ __('Generate for Free') }}</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-section py-5 position-relative overflow-hidden">
        <div class="container text-center py-5 position-relative z-1 fade-in">
            <div class="d-inline-flex align-items-center bg-white border rounded-pill px-3 py-1 mb-4 shadow-sm">
                <span class="badge bg-primary rounded-pill me-2">New</span>
                <span class="small fw-bold text-dark">{{ __('Powered by proprietary AI Engine v2.0') }}</span>
            </div>
            
            <h1 class="display-3 fw-bolder text-dark mb-3 tracking-tight" style="letter-spacing: -0.03em;">
                {{ __('Write Marketing Copy That') }} <br> 
                <span class="text-gradient">{{ __('Actually Converts.') }}</span>
            </h1>
            
            <p class="lead text-secondary fw-medium mx-auto mb-5" style="max-width: 650px; line-height: 1.6;">
                {{ __('Stop staring at a blank page. CopyGen AI instantly generates high-performing Ads, Product Descriptions, and Social Media Captions customized to your exact audience segment.') }}
            </p>
            
            <div class="d-flex flex-column flex-sm-row justify-content-center gap-3">
                <a href="{{ route('register') }}" class="btn btn-primary btn-lg shadow fw-bold px-4 px-md-5 d-flex align-items-center justify-content-center" style="border-radius: 12px;">
                    {{ __('Generate for Free') }} <i data-lucide="arrow-right" class="ms-2 w-5 h-5"></i>
                </a>
                <a href="#how-it-works" class="btn btn-white btn-lg border bg-white text-dark shadow-sm fw-bold px-4 px-md-5 d-flex align-items-center justify-content-center" style="border-radius: 12px;">
                    <i data-lucide="play-circle" class="me-2 w-5 h-5 opacity-75"></i> {{ __('See How It Works') }}
                </a>
            </div>
            
            <div class="mt-5 pt-4 opacity-75">
                <p class="small text-uppercase fw-bolder text-secondary tracking-widest mb-3">{{ __('Trusted by cutting-edge marketing teams') }}</p>
                <div class="d-flex justify-content-center gap-4 flex-wrap opacity-50">
                    <i data-lucide="twitch" class="w-8 h-8"></i>
                    <i data-lucide="figma" class="w-8 h-8"></i>
                    <i data-lucide="gitlab" class="w-8 h-8"></i>
                    <i data-lucide="slack" class="w-8 h-8"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div id="how-it-works" class="py-5 bg-white">
        <div class="container py-5">
            <div class="text-center mb-5 fade-in">
                <h2 class="fw-bolder text-dark h1">{{ __('Everything you need to scale content.') }}</h2>
                <p class="text-secondary fw-medium mx-auto" style="max-width: 500px;">
                    {{ __('Built purely for marketers, agencies, and startup founders who need premium copy instantly without hiring freelancers.') }}
                </p>
            </div>
            
            <div class="row g-4 mt-2">
                <div class="col-md-4 fade-in" style="animation-delay: 0.1s;">
                    <div class="card h-100 border-0 bg-light p-4 shadow-sm" style="border-radius: 20px;">
                        <div class="feature-icon-wrapper mb-4">
                            <i data-lucide="zap" class="w-6 h-6"></i>
                        </div>
                        <h4 class="fw-bolder text-dark">{{ __('Lightning Fast') }}</h4>
                        <p class="text-secondary fw-medium lh-lg mb-0">
                            {{ __('Generate entire un-plagiarized ad campaigns and marketing variations in under 3 seconds flat. Never waste time brainstorming again.') }}
                        </p>
                    </div>
                </div>
                
                <div class="col-md-4 fade-in" style="animation-delay: 0.2s;">
                    <div class="card h-100 border-0 bg-light p-4 shadow-sm" style="border-radius: 20px;">
                        <div class="feature-icon-wrapper mb-4">
                            <i data-lucide="target" class="w-6 h-6"></i>
                        </div>
                        <h4 class="fw-bolder text-dark">{{ __('Laser Targeted Tone') }}</h4>
                        <p class="text-secondary fw-medium lh-lg mb-0">
                            {{ __('Specify an exact audience and tone—from strictly professional B2B whitepapers to highly casual viral TikTok marketing hooks.') }}
                        </p>
                    </div>
                </div>
                
                <div class="col-md-4 fade-in" style="animation-delay: 0.3s;">
                    <div class="card h-100 border-0 bg-light p-4 shadow-sm" style="border-radius: 20px;">
                        <div class="feature-icon-wrapper mb-4">
                            <i data-lucide="cloud" class="w-6 h-6"></i>
                        </div>
                        <h4 class="fw-bolder text-dark">{{ __('Cloud Library Sync') }}</h4>
                        <p class="text-secondary fw-medium lh-lg mb-0">
                            {{ __('Every snippet generated is instantly saved to your personal vault natively on the cloud. Revisit, copy, and delete old campaigns.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="py-5 bg-dark position-relative overflow-hidden">
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: radial-gradient(circle at top right, rgba(99,102,241,0.2) 0%, transparent 60%);"></div>
        <div class="container text-center py-5 position-relative z-1 fade-in">
            <h2 class="display-5 fw-bolder text-white mb-4">{{ __('Start Generating') }}</h2>
            <a href="{{ route('register') }}" class="btn btn-primary btn-lg shadow-lg fw-bold px-4 px-md-5" style="border-radius: 12px; padding-top: 14px; padding-bottom: 14px;">
                {{ __('Create Free Account') }}
            </a>
        </div>
    </div>

    <footer class="bg-dark text-white text-center py-4 border-top border-secondary border-opacity-25">
        <div class="container">
            <p class="mb-0 text-muted small fw-medium">&copy; {{ date('Y') }} {{ __('CopyGen AI') }}. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
