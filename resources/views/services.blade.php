<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Services | nexorabyte.in</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon-nb.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">

    <!-- CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Cambria', Georgia, serif;
            background: #f8fafc;
            color: #1e293b;
        }

        .premium-bg {
            position: fixed;
            inset: 0;
            z-index: -1;
            background: linear-gradient(135deg, #ffffff 0%, #ffe4e6 100%);
            overflow: hidden;
        }

        /* Animated Aura Blobs (Intense Pink & Pastel) */
        .aura {
            position: absolute;
            width: 100%;
            height: 100%;
            filter: blur(140px);
            opacity: 0.4;
        }

        .aura-1 {
            top: -20%;
            left: -10%;
            width: 60%;
            height: 60%;
            background: radial-gradient(circle, rgba(251, 113, 133, 0.4) 0%, transparent 70%);
            animation: auraMove 25s infinite alternate;
        }

        .aura-2 {
            bottom: -20%;
            right: -10%;
            width: 80%;
            height: 80%;
            background: radial-gradient(circle, rgba(251, 113, 133, 0.45) 0%, transparent 70%);
            animation: auraMove 30s infinite alternate-reverse;
        }

        .aura-3 {
            top: 30%;
            left: 50%;
            width: 50%;
            height: 50%;
            background: radial-gradient(circle, rgba(244, 114, 182, 0.5) 0%, transparent 70%);
            animation: auraMove 22s infinite alternate;
            filter: blur(120px);
        }

        @keyframes auraMove {
            0% {
                transform: translate(-5%, -5%) scale(1);
            }

            100% {
                transform: translate(15%, 20%) scale(1.15);
            }
        }

        /* Subtle Engineering Grid (Darker lines for light mode) */
        .grid-overlay {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(0, 0, 0, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 0, 0, 0.03) 1px, transparent 1px);
            background-size: 60px 60px;
            mask-image: radial-gradient(circle at center, black, transparent 90%);
        }

        /* Texture Grain */
        .noise {
            position: absolute;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 250 250' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.8' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)'/%3E%3C/svg%3E");
            opacity: 0.04;
            mix-blend-mode: multiply;
            pointer-events: none;
        }

        .glass-nav {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(40px) saturate(180%);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow:
                0 10px 30px -10px rgba(0, 0, 0, 0.05),
                inset 0 0 0 1px rgba(255, 255, 255, 0.4);
        }

        .crystal-card {
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.8);
            box-shadow:
                0 4px 6px -1px rgba(0, 0, 0, 0.02),
                0 10px 15px -3px rgba(0, 0, 0, 0.03),
                inset 0 0 20px rgba(255, 255, 255, 0.5);
            transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
        }

        .crystal-card:hover {
            border-color: rgba(244, 114, 182, 0.5);
            background: rgba(255, 255, 255, 0.9);
            transform: translateY(-12px);
            box-shadow:
                0 20px 40px -10px rgba(0, 0, 0, 0.05),
                0 0 20px rgba(244, 114, 182, 0.15);
        }

        .elite-btn {
            transition: all 0.3s cubic-bezier(0.23, 1, 0.32, 1);
        }

        .elite-btn:active {
            transform: scale(0.95);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.8s cubic-bezier(0.23, 1, 0.32, 1) forwards;
        }

        .delay-100 {
            animation-delay: 0.1s;
        }

        .delay-200 {
            animation-delay: 0.2s;
        }

        .delay-300 {
            animation-delay: 0.3s;
        }

        /* ── Mobile Nav ── */
        .m-nav-links {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .m-hamburger {
            display: none;
            align-items: center;
            justify-content: center;
            width: 2.5rem;
            height: 2.5rem;
            background: rgba(255, 255, 255, 0.85);
            border: 1px solid #e2e8f0;
            border-radius: 0.625rem;
            cursor: pointer;
        }

        @media (min-width: 1280px) {
            .m-hamburger {
                display: none !important;
            }
        }

        .m-mobile-menu {
            display: none;
        }

        @media (max-width: 1279px) {
            .m-nav-links {
                display: none !important;
            }

            .m-hamburger {
                display: flex !important;
            }

            .m-mobile-menu.open {
                display: flex !important;
                flex-direction: column;
                gap: 1rem;
                position: fixed;
                top: 4rem;
                left: 0;
                right: 0;
                background: rgba(255, 255, 255, 0.97);
                backdrop-filter: blur(20px);
                border-bottom: 1px solid #f1f5f9;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
                padding: 1.5rem;
                z-index: 60;
            }

            .m-mobile-menu.open a {
                font-size: 0.875rem;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 0.1em;
                color: #334155;
                text-decoration: none;
                padding: 0.5rem 0;
                border-bottom: 1px solid #f1f5f9;
            }

            .m-mobile-menu.open a:last-child {
                border-bottom: none;
                background: #e11d48;
                color: white;
                padding: 0.75rem 1.5rem;
                border-radius: 0.75rem;
                text-align: center;
            }

            h1 {
                font-size: 2.5rem !important;
                line-height: 1.15 !important;
            }

            section,
            main {
                padding-left: 1rem !important;
                padding-right: 1rem !important;
                padding-top: 5.5rem !important;
            }

            .crystal-card {
                padding: 1.5rem !important;
                border-radius: 2rem !important;
            }
        }

        @media (max-width: 480px) {
            h1 {
                font-size: 2rem !important;
            }
        }
        @media (max-width: 768px) {
            input, select, textarea {
                font-size: 16px !important;
            }
        }
    </style>
</head>

<body class="text-slate-700 antialiased selection:bg-rose-500 selection:text-white min-h-screen flex flex-col">
    <!-- Premium Background Layers -->
    <div class="premium-bg">
        <div class="aura aura-1"></div>
        <div class="aura aura-2"></div>
        <div class="grid-overlay"></div>
        <div class="noise"></div>
    </div>
    <!-- SVG Filter for Logo Transparency -->
    <svg style="position: absolute; width: 0; height: 0;" aria-hidden="true">
        <filter id="chroma-key-black">
            <feColorMatrix type="matrix" values="1 0 0 0 0 
                                                     0 1 0 0 0 
                                                     0 0 1 0 0 
                                                     1 1 1 0 -0.1" />
        </filter>
    </svg>

    <!-- Navigation -->
    <nav class="fixed w-full z-50 glass-nav h-16 flex items-center">
        <div class="max-w-7xl mx-auto w-full px-4 flex justify-between items-center">
            <div class="flex items-center gap-4">
                <a href="/" class="flex items-center gap-3">
                    <img src="{{ asset('images/company_logo.jpg') }}" alt="nexorabyte" class="h-9 w-auto object-contain"
                        style="filter: url(#chroma-key-black) contrast(1.1);">
                    <span class="text-lg font-black text-slate-900 tracking-[0.2em]">nexorabyte</span>
                </a>
                <a href="/"
                    class="hidden xl:flex items-center gap-2 text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 hover:text-rose-600 transition-colors group">
                    <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Back to Home
                </a>
            </div>

            <div class="flex items-center gap-6">
                <div class="m-nav-links hidden xl:flex">
                    <a href="{{ route('services') }}"
                        class="text-[11px] font-semibold uppercase tracking-widest text-slate-600 border-r border-slate-200 pr-6">Services</a>
                    <a href="{{ route('force-login') }}"
                        class="text-[11px] font-semibold uppercase tracking-widest text-slate-600 hover:text-indigo-600 transition-colors">Sign
                        In</a>
                    <a href="{{ route('get-started') }}"
                        class="elite-btn bg-indigo-600 shadow-lg text-white text-[11px] font-bold px-6 py-2.5 rounded-full uppercase tracking-widest hover:bg-indigo-500">Sign
                        Up</a>
                </div>
                <!-- Hamburger -->
                <button id="nav-hamburger" class="m-hamburger" aria-label="Menu">
                    <svg id="ham-icon" style="width:1.25rem;height:1.25rem;color:#374151;" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg id="close-icon" style="display:none;width:1.25rem;height:1.25rem;color:#374151;" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
        <!-- Mobile dropdown -->
        <div id="mobile-menu" class="m-mobile-menu">
            <a href="/">← Back to Home</a>
            <a href="{{ route('services') }}">Services</a>
            <a href="{{ route('force-login') }}">Sign In</a>
            <a href="{{ route('get-started') }}">Sign Up</a>
        </div>
    </nav>

    <script>
        (function() {
            var b = document.getElementById('nav-hamburger'),
                m = document.getElementById('mobile-menu'),
                h = document.getElementById('ham-icon'),
                c = document.getElementById('close-icon');
            if (!b) return;
            b.addEventListener('click', function() {
                var o = m.classList.toggle('open');
                h.style.display = o ? 'none' : 'block';
                c.style.display = o ? 'block' : 'none';
            });
            document.addEventListener('click', function(e) {
                if (!b.contains(e.target) && !m.contains(e.target)) {
                    m.classList.remove('open');
                    h.style.display = 'block';
                    c.style.display = 'none';
                }
            });
        })();
    </script>

<main class="flex-grow pt-32 pb-24 px-4 sm:px-8">
    <div class="max-w-7xl mx-auto">
        <!-- Hero -->
        <div class="text-center mb-24 animate-fade-in-up">
            <h1 class="text-5xl md:text-7xl font-extrabold text-slate-900 mb-8 tracking-tight leading-tight">
                Elite Professional <br /> <span
                    class="text-transparent bg-clip-text bg-gradient-to-r from-rose-600 via-pink-600 to-rose-400">Capabilities.</span>
            </h1>
            <p class="text-lg md:text-xl text-slate-700 font-medium max-w-3xl mx-auto leading-relaxed">
                We combine high-level engineering with strategic digital architecture to deliver
                unrivaled growth and operational excellence for the modern enterprise.
            </p>
        </div>

        <!-- Services Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Customized Websites -->
            <div
                class="crystal-card p-12 rounded-[3.5rem] group animate-fade-in-up delay-100 flex flex-col items-start relative overflow-hidden">
                <div
                    class="absolute -right-20 -top-20 w-64 h-64 bg-rose-500/5 rounded-full blur-[100px] group-hover:bg-rose-500/10 transition-all duration-700">
                </div>
                <div
                    class="w-16 h-16 rounded-2xl bg-rose-50 flex items-center justify-center text-rose-600 mb-8 border border-rose-100 group-hover:scale-110 transition-transform relative z-10">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                    </svg>
                </div>
                <h3 class="text-3xl font-black text-slate-900 mb-4 uppercase tracking-tighter relative z-10">Customized
                    Websites</h3>
                <p class="text-slate-700 leading-relaxed mb-8 font-medium relative z-10">
                    High-performance, bespoke web architectures engineered for speed, security, and extreme scale. We
                    don't use templates—we build custom digital ecosystems.
                </p>
                <ul
                    class="space-y-4 text-[11px] font-black uppercase tracking-[0.2em] text-slate-500 mb-12 relative z-10">
                    <li class="flex items-center gap-4 group/item">
                        <span
                            class="w-6 h-6 rounded-lg bg-rose-50 flex items-center justify-center text-rose-500 italic font-black shadow-sm border border-rose-100 group-hover/item:bg-rose-500 group-hover/item:text-white transition-colors">L</span>
                        <span class="group-hover/item:text-slate-900 transition-colors">Bespoke React & Laravel
                            logic</span>
                    </li>
                    <li class="flex items-center gap-4 group/item">
                        <span
                            class="w-6 h-6 rounded-lg bg-rose-50 flex items-center justify-center text-rose-500 italic font-black shadow-sm border border-rose-100 group-hover/item:bg-rose-500 group-hover/item:text-white transition-colors">S</span>
                        <span class="group-hover/item:text-slate-900 transition-colors">Enterprise-Grade Security</span>
                    </li>
                    <li class="flex items-center gap-4 group/item">
                        <span
                            class="w-6 h-6 rounded-lg bg-rose-50 flex items-center justify-center text-rose-500 italic font-black shadow-sm border border-rose-100 group-hover/item:bg-rose-500 group-hover/item:text-white transition-colors">E</span>
                        <span class="group-hover/item:text-slate-900 transition-colors">Global Asset Optimization</span>
                    </li>
                </ul>
                <a href="{{ route('services.web-development') }}"
                    class="elite-btn inline-flex items-center gap-3 text-white text-[10px] font-black uppercase tracking-widest bg-rose-600 border border-rose-700 px-8 py-4 rounded-full hover:bg-rose-700 group mt-auto relative z-10 shadow-xl shadow-rose-200">
                    View Service Details
                    <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>

            <!-- Insurance ERP -->
            <div
                class="crystal-card p-12 rounded-[3.5rem] bg-rose-500/5 group animate-fade-in-up delay-200 relative overflow-hidden flex flex-col items-start border-rose-200">
                <div class="absolute top-0 right-0 p-8 z-20">
                    <span
                        class="text-[9px] font-black uppercase tracking-widest bg-rose-600 text-white px-4 py-1.5 rounded-full shadow-lg shadow-rose-200">Flagship</span>
                </div>
                <div
                    class="absolute -right-20 -top-20 w-64 h-64 bg-rose-500/10 rounded-full blur-[100px] group-hover:bg-rose-500/20 transition-all duration-700">
                </div>
                <div
                    class="w-16 h-16 rounded-2xl bg-rose-50 flex items-center justify-center text-rose-600 mb-8 border border-rose-100 group-hover:scale-110 transition-transform relative z-10">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                        </path>
                    </svg>
                </div>
                <h3 class="text-3xl font-black text-slate-900 mb-4 tracking-tighter relative z-10">Insurance ERP</h3>
                <p class="text-slate-700 leading-relaxed mb-8 font-medium relative z-10">
                    The definitive engine for insurance agency management. Centralized client tracking, automated
                    renewal pulses, and diagnostic claims intelligence.
                </p>
                <ul
                    class="space-y-4 text-[11px] font-black uppercase tracking-[0.2em] text-slate-500 mb-12 relative z-10">
                    <li class="flex items-center gap-4 group/item">
                        <span
                            class="w-6 h-6 rounded-lg bg-rose-50 flex items-center justify-center text-rose-500 italic font-black shadow-sm border border-rose-100 group-hover/item:bg-rose-500 group-hover/item:text-white transition-colors">L</span>
                        <span class="group-hover/item:text-slate-900 transition-colors">Multi-Tenant Data
                            Isolation</span>
                    </li>
                    <li class="flex items-center gap-4 group/item">
                        <span
                            class="w-6 h-6 rounded-lg bg-rose-50 flex items-center justify-center text-rose-500 italic font-black shadow-sm border border-rose-100 group-hover/item:bg-rose-500 group-hover/item:text-white transition-colors">S</span>
                        <span class="group-hover/item:text-slate-900 transition-colors">Automated Renewal Engine</span>
                    </li>
                    <li class="flex items-center gap-4 group/item">
                        <span
                            class="w-6 h-6 rounded-lg bg-rose-50 flex items-center justify-center text-rose-500 italic font-black shadow-sm border border-rose-100 group-hover/item:bg-rose-500 group-hover/item:text-white transition-colors">E</span>
                        <span class="group-hover/item:text-slate-900 transition-colors">Smart Intelligence Panels</span>
                    </li>
                </ul>
                <a href="{{ route('services.insurance-erp') }}"
                    class="elite-btn inline-flex items-center gap-3 text-white text-[10px] font-black uppercase tracking-widest bg-rose-600 border border-rose-700 px-8 py-4 rounded-full hover:bg-rose-700 group mt-auto relative z-10 shadow-xl shadow-rose-200">
                    View Service Details
                    <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</main>

<footer x-data="{}" class="py-20 border-t border-white/5 bg-[#0f111a] relative overflow-hidden">
    <!-- Footer Aurora Glow -->
    <div class="absolute -bottom-48 left-1/2 -translate-x-1/2 w-full h-96 bg-rose-500/10 blur-[120px] rounded-full">
    </div>

    <div class="max-w-7xl mx-auto px-8 relative z-10">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-12 lg:gap-8 mb-16">
            <div class="col-span-2 lg:col-span-2">
                <div class="flex items-center gap-4 mb-6">
                    <img src="{{ asset('images/company_logo.jpg') }}" alt="nexorabyte"
                        class="h-10 w-auto object-contain"
                        style="filter: url(#chroma-key-black) contrast(1.1) brightness(1.2);">
                    <span
                        class="text-xl font-black text-white tracking-[0.2em]">nexorabyte</span>
                </div>
                <p class="text-slate-400 text-sm leading-relaxed max-w-sm mb-8 font-medium">
                    Architecting the digital backbone of the modern enterprise through bespoke ERP logic, elite
                    engineering, and immutable security.
                </p>
            </div>

            <div>
                <h5 class="text-white font-black tracking-[0.3em] uppercase text-[10px] mb-6">Our Services</h5>
                <ul class="space-y-4">
                    <li><a href="{{ route('services.web-development') }}"
                            class="text-slate-500 text-sm hover:text-rose-500 transition-all hover:pl-2">Customized
                            Websites</a></li>
                    <li><a href="{{ route('services.insurance-erp') }}"
                            class="text-slate-500 text-sm hover:text-rose-500 transition-all hover:pl-2">Insurance ERP
                            Systems</a></li>
                </ul>
            </div>

            <div>
                <h5 class="text-white font-black tracking-[0.3em] uppercase text-[10px] mb-6">Studio</h5>
                <ul class="space-y-4">
                    <li><a href="{{ route('about') }}"
                            class="text-slate-500 text-sm hover:text-rose-500 transition-all hover:pl-2">About Us</a>
                    </li>
                    <li><a href="{{ route('lifecycle') }}"
                            class="text-slate-500 text-sm hover:text-rose-500 transition-all hover:pl-2">Our
                            Lifecycle</a></li>
                    <li><a href="javascript:void(0)" @click="$dispatch('open-contact')"
                            class="text-slate-500 text-sm hover:text-rose-500 transition-all hover:pl-2">Contact Us</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="pt-8 border-t border-white/5 flex flex-col lg:flex-row items-center justify-between gap-6">
            <p class="text-[9px] font-black tracking-[0.3em] text-slate-600 uppercase">&copy; {{ date('Y') }}
                nexorabyte. ARCHITECTING EXCELLENCE.</p>
            <div class="flex gap-8">
                <a href="#"
                    class="text-[9px] font-black uppercase tracking-[0.3em] text-slate-600 hover:text-white transition-colors">Privacy</a>
                <a href="#"
                    class="text-[9px] font-black uppercase tracking-[0.3em] text-slate-600 hover:text-white transition-colors">Terms</a>
            </div>
        </div>
    </div>
</footer>
    <x-contact-modal />
</body>

</html>