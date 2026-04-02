<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CopyGen AI') }} - {{ __('Dashboard') }}</title>

    <script defer src="https://unpkg.com/lucide@latest"></script>
    <meta name="turbo-prefetch" content="true">
    
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <style>
        /* ── Custom Mobile Drawer ── zero Bootstrap JS dependency ── */
        #mob-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
            z-index: 1040;
            backdrop-filter: blur(2px);
        }
        #mob-drawer {
            position: fixed;
            top: 0;
            height: 100vh;
            height: 100dvh;
            width: 270px;
            background: #1a1d20;
            z-index: 1050;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            box-shadow: 4px 0 24px rgba(0,0,0,0.35);
            /* LTR: slide from left — set per direction */
        }
        [dir="ltr"] #mob-drawer {
            left: 0; right: auto;
            transform: translateX(-100%);
            transition: transform 0.28s cubic-bezier(0.4,0,0.2,1);
        }
        [dir="rtl"] #mob-drawer {
            right: 0; left: auto;
            transform: translateX(100%);
            transition: transform 0.28s cubic-bezier(0.4,0,0.2,1);
        }
        body.mob-open #mob-overlay { display: block; }
        [dir="ltr"] body.mob-open #mob-drawer,
        [dir="rtl"] body.mob-open #mob-drawer { transform: translateX(0) !important; }
        body.mob-open { overflow: hidden; }

        /* Drawer nav-link styling — mirrors desktop */
        #mob-drawer .mob-nav-link {
            display: flex;
            align-items: center;
            padding: 9px 12px;
            border-radius: 8px;
            color: rgba(255,255,255,0.65);
            font-weight: 600;
            font-size: 0.875rem;
            text-decoration: none;
            transition: background 0.15s, color 0.15s;
            gap: 10px;
        }
        #mob-drawer .mob-nav-link:hover { background: rgba(255,255,255,0.06); color: #fff; }
        #mob-drawer .mob-nav-link.active {
            background: rgba(99,102,241,0.18);
            color: #fff;
        }
        #mob-drawer .mob-nav-link.active svg { color: #818cf8; }
        #mob-drawer .mob-section-label {
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.35);
            padding: 0 4px;
            margin-bottom: 6px;
            margin-top: 4px;
        }
        #mob-drawer .mob-footer-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            background: transparent;
            border: none;
            color: rgba(255,255,255,0.5);
            font-weight: 600;
            font-size: 0.875rem;
            padding: 9px 12px;
            border-radius: 8px;
            width: 100%;
            text-align: start;
            transition: background 0.15s, color 0.15s;
            cursor: pointer;
        }
        #mob-drawer .mob-footer-btn:hover { background: rgba(255,255,255,0.06); color: #fff; }

        /* ── hide custom mobile elements on md+ ── */
        @media (min-width: 768px) {
            #mob-overlay, #mob-drawer, #mob-topbar { display: none !important; }
        }
    </style>

    <!-- Custom Mobile Top-bar (visible only < md) -->
    <div id="mob-topbar" class="d-flex d-md-none justify-content-between align-items-center bg-dark text-white px-3 py-2 shadow-sm" style="position:sticky;top:0;z-index:1030;">
        <a href="{{ route('dashboard') }}" class="text-decoration-none">
            <h6 class="brand-text m-0 text-white d-flex align-items-center">
                <i data-lucide="sparkles" class="text-primary me-2" style="width:18px;height:18px;"></i>
                {{ __('CopyGen AI') }}
            </h6>
        </a>
        <div class="d-flex align-items-center gap-3">
            <!-- Language switcher -->
            <div class="dropdown">
                <a href="#" class="text-white text-decoration-none dropdown-toggle opacity-75 small" data-bs-toggle="dropdown">
                    {{ strtoupper(app()->getLocale()) }}
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                    <li><a class="dropdown-item fw-medium" href="{{ route('locale.switch','en') }}">English</a></li>
                    <li><a class="dropdown-item fw-medium" href="{{ route('locale.switch','ar') }}">العربية</a></li>
                </ul>
            </div>
            <!-- Hamburger — inline onclick bypasses Turbo/DOMContentLoaded timing issues -->
            <button class="btn btn-dark border-0 p-1" type="button" aria-label="Open menu"
                    onclick="document.body.classList.add('mob-open')">
                <i data-lucide="menu" style="width:20px;height:20px;"></i>
            </button>
        </div>
    </div>

    <!-- Dark overlay — click closes drawer -->
    <div id="mob-overlay" onclick="closeMobDrawer()"></div>

    <!-- Custom Mobile Drawer -->
    <div id="mob-drawer" role="dialog" aria-modal="true" aria-label="{{ __('Navigation') }}">

        <!-- Drawer brand header (Sticky) -->
        <div style="padding: 20px 16px 16px; border-bottom: 1px solid rgba(255,255,255,0.07); flex-shrink: 0;">
            <div style="display:flex; align-items:center; justify-content:space-between;">
                <div style="display:flex; align-items:center; gap:10px;">
                    <div style="background:rgba(99,102,241,0.15); border:1px solid rgba(99,102,241,0.25); border-radius:8px; padding:7px; display:flex;">
                        <i data-lucide="sparkles" style="width:16px;height:16px;color:#818cf8;"></i>
                    </div>
                    <span class="brand-text" style="color:#fff; font-size:1rem; font-weight:700;">{{ __('CopyGen AI') }}</span>
                </div>
                <button onclick="document.body.classList.remove('mob-open')"
                        style="background:transparent; border:none; padding:4px; cursor:pointer; color:rgba(255,255,255,0.5); border-radius:6px;"
                        aria-label="{{ __('Close') }}">
                    <i data-lucide="x" style="width:18px;height:18px;"></i>
                </button>
            </div>
        </div>

        <!-- Drawer nav body (Scrollable) -->
        <div style="padding: 16px 12px; flex: 1; min-height: 0; overflow-y: auto; display: flex; flex-direction: column;">
            <p class="mob-section-label">{{ __('Platform') }}</p>
            <ul style="list-style:none; padding:0; margin:0; display:flex; flex-direction:column; gap:2px;">
                <li>
                    <a class="mob-nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                       href="{{ route('dashboard') }}">
                        <i data-lucide="layout-dashboard" style="width:17px;height:17px;"></i>
                        {{ __('Dashboard') }}
                    </a>
                </li>
                <li>
                    <a class="mob-nav-link {{ request()->routeIs('history') ? 'active' : '' }}"
                       href="{{ route('history') }}">
                        <i data-lucide="layers" style="width:17px;height:17px;"></i>
                        {{ __('Library') }}
                    </a>
                </li>
            </ul>

            <p class="mob-section-label" style="margin-top:20px;">{{ __('Settings') }}</p>
            <ul style="list-style:none; padding:0; margin:0; display:flex; flex-direction:column; gap:2px;">
                <li>
                    <a class="mob-nav-link {{ request()->routeIs('profile') ? 'active' : '' }}"
                       href="{{ route('profile') }}">
                        <i data-lucide="user" style="width:17px;height:17px;"></i>
                        {{ __('Profile') }}
                    </a>
                </li>
            </ul>
        </div>

        <!-- Drawer footer (Sticky) -->
        <div style="flex-shrink: 0; padding: 16px 12px 32px 12px; background: rgba(0,0,0,0.15); border-top: 1px solid rgba(255,255,255,0.07); width: 100%; display: block;">
            <!-- User info strip -->
            <div style="padding:10px 12px; border-radius:10px; background:rgba(255,255,255,0.04); margin-bottom:12px; display:flex; align-items:center; gap:10px;">
                <div style="width:32px;height:32px;border-radius:50%;background:rgba(99,102,241,0.2);border:1px solid rgba(99,102,241,0.3);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <i data-lucide="user" style="width:15px;height:15px;color:#818cf8;"></i>
                </div>
                <div style="min-width:0;">
                    <div style="color:#fff;font-weight:700;font-size:0.8rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ Auth::user()->name }}</div>
                    <div style="color:#818cf8;font-size:0.68rem;font-weight:600;">{{ __('Premium Member') }}</div>
                </div>
            </div>

            <!-- Sign Out -->
            <div style="display: block; width: 100%;">
                <form method="POST" action="{{ route('logout') }}" style="margin:0; display: block; width: 100%;">
                    @csrf
                    <button type="submit" class="mob-footer-btn" style="-webkit-appearance: none; appearance: none; width: 100%; display: flex; align-items: center; justify-content: flex-start; height: 44px;">
                        <i data-lucide="log-out" style="width:17px;height:17px;margin-right:10px;"></i>
                        {{ __('Sign Out') }}
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Drawer: ESC key support only — all open/close via inline onclick -->
    <script>
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') document.body.classList.remove('mob-open');
        });
    </script>

    <!-- Outer page flex wrapper -->
    <div class="d-flex flex-md-row min-vh-100" style="flex-direction: column;">

        <!-- Desktop Sidebar (Turbo-enabled, md+ only) -->
        <div class="d-none d-md-flex flex-column bg-dark text-white border-0 sidebar shadow-none" style="width: 250px; min-height: 100vh;">
            <div class="d-flex flex-column p-3 h-100 w-100 px-md-3 pt-md-4">

                <!-- Brand -->
                <div class="d-flex align-items-center mb-4 ps-2">
                    <div class="bg-primary bg-opacity-10 p-2 rounded-3 me-3" style="border: 1px solid rgba(99,102,241,0.2);">
                        <i data-lucide="sparkles" class="text-primary w-5 h-5"></i>
                    </div>
                    <h5 class="brand-text m-0 text-white fs-5 fw-bolder">{{ __('CopyGen AI') }}</h5>
                </div>

                <p class="sidebar-label mb-2 mt-2">{{ __('Platform') }}</p>
                <ul class="nav flex-column w-100 mb-auto gap-1">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                            <i data-lucide="layout-dashboard" class="me-2"></i> <span>{{ __('Dashboard') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('history') ? 'active' : '' }}" href="{{ route('history') }}">
                            <i data-lucide="layers" class="me-2"></i> <span>{{ __('Library') }}</span>
                        </a>
                    </li>
                    <li class="nav-item mt-3">
                        <p class="sidebar-label mb-2">{{ __('Settings') }}</p>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('profile') ? 'active' : '' }}" href="{{ route('profile') }}">
                            <i data-lucide="user" class="me-2"></i> <span>{{ __('Profile') }}</span>
                        </a>
                    </li>
                </ul>

                <!-- Sign Out -->
                <div class="mt-3 pt-3 border-top" style="border-color: rgba(255,255,255,0.06) !important;">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="sidebar-footer-btn w-100 text-start bg-transparent d-flex align-items-center fw-medium pb-2 border-0">
                            <i data-lucide="log-out" class="me-2"></i> {{ __('Sign Out') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="flex-grow-1 d-flex flex-column h-100" style="min-width: 0;">
            <!-- Top Navbar (Desktop only) -->
            <nav class="navbar navbar-expand-lg bg-white border-bottom px-4 py-2 d-none d-md-flex align-items-center" style="height: 60px;">
                <div class="container-fluid px-0 mx-auto" style="max-width: 1400px;">
                    <h6 class="fw-bold mb-0 text-dark opacity-75">
                        @if(request()->routeIs('dashboard')) {{ __('Copy Generator') }} @endif
                        @if(request()->routeIs('history')) {{ __('Saved Library') }} @endif
                        @if(request()->routeIs('profile')) {{ __('Account Settings') }} @endif
                    </h6>
                    
                    <div class="ms-auto d-flex align-items-center gap-3">
                        <div class="dropdown">
                            <a href="#" class="text-secondary text-decoration-none dropdown-toggle fw-bold small flex-shrink-0" data-bs-toggle="dropdown">
                                <i data-lucide="globe" class="w-4 h-4 d-inline align-middle me-1"></i> {{ app()->getLocale() == 'ar' ? 'العربية' : 'EN' }}
                            </a>
                            <ul class="dropdown-menu shadow-sm border-0 mt-2" style="min-width:120px;">
                                <li><a class="dropdown-item fw-medium small" href="{{ route('locale.switch', 'en') }}" data-turbo="false">English</a></li>
                                <li><a class="dropdown-item fw-medium small" href="{{ route('locale.switch', 'ar') }}" data-turbo="false">العربية</a></li>
                            </ul>
                        </div>
                        
                        <div class="d-flex align-items-center gap-2 border-start ps-3 ms-1" style="border-color: rgba(0,0,0,0.06) !important;">
                            <div class="d-flex flex-column text-end">
                                <span class="fw-bold text-dark lh-1 mb-1" style="font-size: 0.85rem;">{{ Auth::user()->name }}</span>
                                <span class="text-muted fw-bold lh-1 text-primary" style="font-size: 0.70rem;">{{ __('Premium Member') }}</span>
                            </div>
                            <div class="bg-primary bg-opacity-10 text-primary d-inline-flex align-items-center justify-content-center rounded-circle border border-primary border-opacity-25 flex-shrink-0" style="width: 32px; height: 32px;">
                                <i data-lucide="user" style="width: 16px; height: 16px;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <main class="p-3 p-md-4 flex-grow-1 overflow-auto bg-light">
                <div class="container-fluid px-0 mx-auto" style="max-width: 1400px;">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm d-flex align-items-center py-2 px-3 mb-3" role="alert" style="border-radius: 8px;">
                            <i data-lucide="check-circle" class="text-success w-4 h-4 me-2"></i>
                            <div class="fw-medium fs-6">{{ session('success') }}</div>
                            <button type="button" class="btn-close py-2" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm d-flex align-items-center py-2 px-3 mb-3" role="alert" style="border-radius: 8px;">
                            <i data-lucide="alert-triangle" class="text-danger w-4 h-4 me-2"></i>
                            <div class="fw-medium fs-6">{{ session('error') }}</div>
                            <button type="button" class="btn-close py-2" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </main>
        </div>
    </div>
</body>
</html>
