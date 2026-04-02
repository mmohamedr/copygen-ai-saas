# CopyGen AI SaaS Platform

CopyGen is an enterprise-grade AI copywriting SaaS. It generates tailored marketing copy, value propositions, and audience targeting materials with deep RTL and localization support (English & Arabic).

## Overview
Built to handle real-world content generation, this platform leverages a robust Laravel 11 backend, integrated directly with modern AI endpoints. It features an ultra-fast Turbo-enabled SPA architecture, premium enterprise UI styling, and a mathematically bulletproof mobile user experience.

### Key Features
- **Intelligent Localization:** Auto-switching between tailored English prompt architectures and entirely native Arabic NLP logic depending on the app's chosen locale.
- **Flawless Mobile Experience:** Cross-browser structural layout mechanics built to bypass common iOS Safari rendering bugs (e.g., hidden footers, viewport overflow).
- **High-Velocity SPA Navigation:** Powered by `@hotwired/turbo` for instantaneous, invisible dashboard transitions without full page loads.
- **Typography Parity:** A master CSS Font Stack (`'Plus Jakarta Sans', 'Cairo'`) that guarantees mixed-language character boundaries without Javascript intervention.

## Screenshots

| Landing Page (English) | Landing Page (عربي) |
| :---: | :---: |
| ![Landing Page English](screenshots/landing-page-english.png) | ![Landing Page Arabic](screenshots/landing-page-arabic.png) |

| Dashboard & Generator (English) | Dashboard & Generator (عربي) |
| :---: | :---: |
| ![Dashboard English](screenshots/dashboard-generator-english.png) | ![Dashboard Arabic](screenshots/dashboard-generator-arabic.png) |

| Library (English) | Library (عربي) |
| :---: | :---: |
| ![Library English](screenshots/library-page-english.png) | ![Library Arabic](screenshots/library-page-arabic.png) |

| Profile (English) | Profile (عربي) |
| :---: | :---: |
| ![Profile English](screenshots/profile-page-english.png) | ![Profile Arabic](screenshots/profile-page-arabic.png) |

## Tech Stack
- **Framework:** Laravel 11 (PHP 8.2+)
- **Frontend Engine:** Hotwire Turbo Drive
- **Styling Architecture:** PostCSS RTLCSS for dynamic Left-to-Right / Right-to-Left compilation, SCSS, and atomic design primitives.
- **Icons:** Lucide Icons (lightweight JS injection)
- **Asset Pipeline:** Vite

## Installation & Setup

1. **Clone the repository:**
   ```bash
   git clone https://github.com/yourusername/copygen-ai.git
   cd copygen-ai
   ```

2. **Install PHP and Node dependencies:**
   ```bash
   composer install
   npm install && npm run build
   ```

3. **Environment Setup:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   *Configure your DB credentials and AI API paths inside `.env`.*

4. **Migrate the Database:**
   ```bash
   php artisan migrate
   ```

5. **Start the Application:**
   ```bash
   php artisan serve
   ```

## Production Engineering Highlights
- **Mobile Safari Avoidance:** The mobile drawer chassis uses explicit `100dvh` declarations coupled with `calc()` margin offsets anchored to `env(safe-area-inset-bottom)`. This mathematically seals out layout overflow bugs on iOS/Android browsers.
- **Zero-Dependency Navigation Drawer:** To preserve compatibility with Turbo, the entire mobile navigation experience was decoupled from Bootstrap's brittle DOM handlers and rewritten entirely in native JS and CSS grid logic.
