# Built for Enterprise: CopyGen AI SaaS Case Study

## Project Overview
**CopyGen AI** is a premium, bilingual (English/Arabic) Artificial Intelligence SaaS application designed to help marketers and businesses instantly generate high-conversion marketing copy. Built from the ground up to support absolute localization parity and enterprise-tier mobile mechanics.

**Role:** Lead Developer / Engineer
**Tech Stack:** Laravel 11, PHP 8.2, Hotwire Turbo Drive, Vite, SCSS, PostCSS (RTL).

---

## 1. The Challenge
The client required a SaaS application that exuded the minimal, highly-polished aesthetic of industry-leading enterprise SaaS companies (such as Stripe or Linear). However, the major constraint was strict **perfect Arabic localization**. 
The app needed to handle complex Right-To-Left (RTL) alignments, mix English and Arabic typography dynamically, and remain performant across mobile platforms where Safari UI toolbars often break layout boundaries.

## 2. Structural Architecture & SPA Speed
Standard single-page applications (SPAs) built with React or Vue require heavy initial Javascript bundle payloads. To maximize speed and SEO indexability, I engineered the application using **Laravel 11 combined with `@hotwired/turbo`.**

Turbo intercepts native HTML link clicks, executes the fetch command in the background, and dynamically swaps the `<body>` of the current page. This results in standard blade templates behaving identically to a React application, yielding near-instantaneous navigation between the Dashboard, Library, and Profile pages.

## 3. Advanced Localization & Typography Mechanisms
Translating text is easy, but structural localization requires intense precision.

- **PostCSS RTL Compilation:** Instead of authoring thousands of lines of override CSS classes, I implemented a Node-based PostCSS pipeline that flips margins, paddings, and flex-directions in the final CSS bundled asset based exclusively on the `<html dir="rtl">` root trigger.
- **Mixed-Language Typography Stack:** A common flaw in localized apps is generating Arabic sentences on an English page and watching the browser force a Latin font to render Arabic glyphs. I engineered a cascading font stack (`'Plus Jakarta Sans', 'Cairo'`). Because the Jakarta font contains zero Arabic glyphs, the browser's hardware text renderer automatically intercepts any Arabic character instantly and "falls-through" to the beautifully optimized *Cairo* font.

## 4. Mobile Layout Resiliency (The WebKit Safari Fix)
A critical issue surfaced during mobile QA: older and newer iterations of iOS Safari manipulate viewport limits to accommodate hardware notches and dynamic URL bars.

- The mobile navigation drawer suffered from standard flex-boundary overflow.
- **The Solution:** I ripped out the bloated frontend library dependencies and hand-coded a zero-dependency CSS layout. I mathematically locked the drawer bounds using Direct Viewport Height (`100dvh`), isolating the navigational links inside an independent scrolling container while pinning the logout functionality beneath it.
- **Safe Area Immunity:** I applied specific `env(safe-area-inset-bottom)` logic wrapped in standard CSS `calc()` fallback structures to physically force the buttons above the Apple screen gesture bar.

## 5. Result
The final delivery is a masterclass in modern SaaS build mechanics. The mobile drawer is physically impossible to crash, the navigation speeds hover under 50ms per page, and the Arabic NLP localization offers dynamic template swapping logic behind the scenes.
