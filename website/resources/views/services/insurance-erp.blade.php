<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Insurance Management Engine | nexorabyte</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon-nb.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">

    <!-- CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- scripts -->
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
            height: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #e2e8f0;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #cbd5e1;
        }

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

        @keyframes flagshipGlow {
            0% { box-shadow: 0 0 0px rgba(79, 70, 229, 0); border-color: rgba(226, 232, 240, 1); }
            50% { box-shadow: 0 0 30px rgba(79, 70, 229, 0.25); border-color: rgba(79, 70, 229, 0.4); }
            100% { box-shadow: 0 0 0px rgba(79, 70, 229, 0); border-color: rgba(226, 232, 240, 1); }
        }
        .flagship-card {
            animation: flagshipGlow 4s infinite ease-in-out;
        }

        @keyframes auraMove {
            0% { transform: translate(-5%, -5%) scale(1); }
            100% { transform: translate(15%, 20%) scale(1.15); }
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
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.9);
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
                0 25px 50px -12px rgba(244, 114, 182, 0.1),
                0 0 20px rgba(244, 114, 182, 0.1);
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

        .showcase-glow {
            box-shadow:
                0 0 80px -10px rgba(251, 113, 133, 0.2),
                0 40px 80px -20px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.8);
        }

        @keyframes autoScroll {
            0% {
                transform: translateY(0);
            }

            90% {
                transform: translateY(calc(-100% + 540px));
            }

            100% {
                transform: translateY(calc(-100% + 540px));
            }
        }

        .scroll-animate {
            animation: autoScroll 14s ease-in-out infinite alternate;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .float-anim {
            animation: float 4s ease-in-out infinite;
        }

        /* ── NAV MOBILE ─────────────────────────────────── */
        .nav-desktop-links  { display: flex; align-items: center; gap: 1.5rem; }
        .nav-back-link      { display: flex; }
        .nav-hamburger      { display: none; }
        .nav-mobile-menu    { display: none; }

        @media (max-width: 767px) {
            .nav-desktop-links { display: none !important; }
            .nav-back-link     { display: none !important; }
            .nav-hamburger     { display: flex !important; align-items: center; justify-content: center;
                                 width: 2.5rem; height: 2.5rem;
                                 background: rgba(255,255,255,0.85);
                                 border: 1px solid #e2e8f0; border-radius: 0.75rem;
                                 cursor: pointer; }
            .nav-mobile-menu.open {
                display: flex !important;
                flex-direction: column;
                gap: 1.25rem;
                position: fixed;
                top: 4rem; left: 0; right: 0;
                background: rgba(255,255,255,0.97);
                backdrop-filter: blur(20px);
                border-bottom: 1px solid #f1f5f9;
                box-shadow: 0 10px 30px -5px rgba(0,0,0,0.1);
                padding: 1.5rem;
                z-index: 60;
            }
            .nav-mobile-menu a {
                font-size: 0.875rem;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 0.1em;
                color: #334155;
                text-decoration: none;
                padding: 0.5rem 0;
                border-bottom: 1px solid #f1f5f9;
            }
            .nav-mobile-menu a:last-child {
                border-bottom: none;
                background: #e11d48;
                color: white;
                padding: 0.75rem 1.5rem;
                border-radius: 0.75rem;
                text-align: center;
                margin-top: 0.25rem;
            }
        }

        /* ── HERO MOBILE ─────────────────────────────────── */
        @media (max-width: 767px) {
            .erp-hero-h1 { font-size: 2.25rem !important; line-height: 1.15 !important; }
            .erp-hero-p  { font-size: 1rem !important; }
            .erp-section-px { padding-left: 1rem !important; padding-right: 1rem !important; }
            .erp-section-pt { padding-top: 6rem !important; }
        }
        @media (max-width: 480px) {
            .erp-hero-h1 { font-size: 1.75rem !important; }
        }
        @media (max-width: 768px) {
            input, select, textarea {
                font-size: 16px !important;
            }
        }
    </style>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>

<body class="text-slate-700 antialiased selection:bg-indigo-500 selection:text-white min-h-screen flex flex-col">
    <!-- Premium Background Layers -->
    <div class="premium-bg">
        <div class="aura aura-1"></div>
        <div class="aura aura-2"></div>
        <div class="aura aura-3"></div>
        <div class="grid-overlay"></div>
        <div class="noise"></div>
    </div>
    <!-- SVG Filter for Logo Transparency -->
    <svg style="position: absolute; width: 0; height: 0;" aria-hidden="true">
        <filter id="chroma-key-black">
            <feColorMatrix type="matrix" values="1 0 0 0 0 0 1 0 0 0 0 0 1 0 0 1 1 1 0 -0.1" />
        </filter>
    </svg>

    <!-- Navigation -->
    <nav style="position:fixed; width:100%; top:0; left:0; z-index:50; height:4rem; display:flex; align-items:center; background:rgba(255,255,255,0.85); backdrop-filter:blur(40px); border-bottom:1px solid rgba(255,255,255,0.3); box-shadow:0 10px 30px -10px rgba(0,0,0,0.05);">
        <div style="max-width:80rem; margin:0 auto; width:100%; padding:0 1rem; display:flex; justify-content:space-between; align-items:center; height:4rem; position:relative;">

            <!-- Logo + back link -->
            <div style="display:flex; align-items:center; gap:1rem;">
                <a href="/" style="display:flex; align-items:center; gap:0.75rem; text-decoration:none;">
                    <img src="{{ asset('images/company_logo.jpg') }}" alt="nexorabyte"
                        style="height:2.25rem; width:auto; object-fit:contain; filter: url(#chroma-key-black) contrast(1.1);">
                    <span style="font-size:1rem; font-weight:900; color:#0f172a; letter-spacing:0.15em;">nexorabyte</span>
                </a>
                <a href="{{ route('services') }}" class="nav-back-link"
                    style="align-items:center; gap:0.5rem; font-size:0.625rem; font-weight:900; text-transform:uppercase; letter-spacing:0.2em; color:#64748b; text-decoration:none;">
                    <svg style="width:1rem;height:1rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Back to Services
                </a>
            </div>

            <!-- Desktop nav links -->
            <div class="nav-desktop-links">
                @auth
                    <a href="https://erp.nexorabyte.in/dashboard"
                        style="font-size:0.6875rem; font-weight:600; text-transform:uppercase; letter-spacing:0.1em; color:#374151; text-decoration:none;">Dashboard</a>
                @else
                    <a href="{{ route('force-login') }}"
                        style="font-size:0.6875rem; font-weight:600; text-transform:uppercase; letter-spacing:0.1em; color:#374151; text-decoration:none;">Sign In</a>
                @endauth
                <a href="#pricing"
                    style="background:#e11d48; color:white; font-size:0.6875rem; font-weight:700; padding:0.625rem 1.5rem; border-radius:9999px; text-transform:uppercase; letter-spacing:0.1em; text-decoration:none;">Subscription Models</a>
            </div>

            <!-- Hamburger (mobile only) -->
            <button id="erp-nav-hamburger" class="nav-hamburger" aria-label="Open menu">
                <svg id="erp-ham-icon" style="width:1.25rem;height:1.25rem;color:#374151;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg id="erp-close-icon" style="display:none;width:1.25rem;height:1.25rem;color:#374151;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Mobile dropdown menu -->
        <div id="erp-mobile-menu" class="nav-mobile-menu">
            <a href="{{ route('services') }}">← Back to Services</a>
            @auth
                <a href="https://erp.nexorabyte.in/dashboard">Dashboard</a>
            @else
                <a href="{{ route('force-login') }}">Sign In</a>
            @endauth
            <a href="#pricing">Subscription Models</a>
        </div>
    </nav>

    <script>
        (function() {
            var btn  = document.getElementById('erp-nav-hamburger');
            var menu = document.getElementById('erp-mobile-menu');
            var ham  = document.getElementById('erp-ham-icon');
            var cls  = document.getElementById('erp-close-icon');
            if (!btn || !menu) return;
            btn.addEventListener('click', function() {
                var isOpen = menu.classList.toggle('open');
                ham.style.display  = isOpen ? 'none'  : 'block';
                cls.style.display  = isOpen ? 'block' : 'none';
            });
            // Close on outside click
            document.addEventListener('click', function(e) {
                if (!btn.contains(e.target) && !menu.contains(e.target)) {
                    menu.classList.remove('open');
                    ham.style.display = 'block';
                    cls.style.display = 'none';
                }
            });
        })();
    </script>

    <main class="flex-grow">
    <!-- Hero Specific to ERP -->
    <section class="erp-section-pt erp-section-px" style="padding-top:11rem; padding-bottom:6rem; padding-left:2rem; padding-right:2rem; text-align:center; position:relative; overflow:hidden;">
        <div style="max-width:64rem; margin:0 auto; position:relative; z-index:10;">
            <div style="display:inline-flex; align-items:center; gap:0.5rem; padding:0.5rem 1rem; border-radius:9999px; background:rgba(244,63,94,0.1); border:1px solid rgba(244,63,94,0.2); color:#e11d48; font-size:0.625rem; font-weight:900; text-transform:uppercase; letter-spacing:0.3em; margin-bottom:1.5rem;" class="animate-fade-in-up">
                Architectural Command &bull; Operational Velocity
            </div>
            <h1 class="erp-hero-h1 animate-fade-in-up delay-100" style="font-size:4.5rem; font-weight:800; color:#0f172a; margin-bottom:1.5rem; letter-spacing:-0.03em; line-height:1.1;">
                Insurance Agency<br />
                <span style="background:linear-gradient(to right, #e11d48, #ec4899); -webkit-background-clip:text; -webkit-text-fill-color:transparent;">Performance Engineering.</span>
            </h1>
            <p class="erp-hero-p animate-fade-in-up delay-200" style="font-size:1.25rem; color:#334155; font-weight:500; max-width:48rem; margin:0 auto 2.5rem;">
                A high-precision ERP infrastructure designed to eliminate administrative friction and scale your agency
                through automated intelligence and unified command.
            </p>
            <div style="display:flex; align-items:center; justify-content:center;" class="animate-fade-in-up delay-300">
                <a href="#demo" class="elite-btn" style="background:#e11d48; color:white; padding:1rem 2.5rem; border-radius:1rem; font-size:0.75rem; font-weight:900; text-transform:uppercase; letter-spacing:0.1em; box-shadow:0 25px 50px -12px rgba(0,0,0,0.25); text-decoration:none;">Live Demo</a>
            </div>
        </div>
    </section>

    <!-- Core Capabilities (The 6 Pillars) -->
    <section id="capabilities" class="py-16 sm:py-32 px-4 sm:px-8 bg-white/30 backdrop-blur-sm relative">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12 sm:mb-20 animate-fade-in-up">
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-black text-slate-900 mb-6 tracking-tight">The Pillars of Command</h2>
                <p class="text-slate-600 font-medium max-w-2xl mx-auto">Every module is engineered to provide absolute
                    clarity and control over your business ecosystem.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                <!-- Client Intelligence -->
                <div
                    class="crystal-card p-6 sm:p-12 rounded-[2rem] sm:rounded-[3.5rem] relative overflow-hidden group animate-fade-in-up delay-100">
                    <div
                        class="absolute -right-16 -top-16 w-48 h-48 bg-rose-500/5 rounded-full blur-[60px] group-hover:bg-rose-500/10 transition-all duration-700">
                    </div>
                    <div
                        class="w-16 h-16 rounded-2xl bg-rose-50 flex items-center justify-center text-rose-600 mb-10 border border-rose-100 group-hover:scale-110 transition-transform relative z-10">
                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                    </div>
                    <h4 class="text-2xl font-black text-slate-900 mb-4 tracking-tight">360° Client Command</h4>
                    <p class="text-slate-600 leading-relaxed text-sm mb-6 font-medium">Capture every detail from policy
                        history to family milestones. Our CRM isn't just a database; it’s an active engagement hub that
                        alerts you on birthdays and anniversaries.</p>
                    <ul class="text-xs font-bold text-slate-500 space-y-2 uppercase tracking-widest">
                        <li>• Unified Portfolio View</li>
                        <li>• Automated CRM Triggers</li>
                    </ul>
                </div>
                <!-- Renewal Pulse -->
                <div
                    class="crystal-card p-12 rounded-[3.5rem] relative overflow-hidden group animate-fade-in-up delay-200">
                    <div
                        class="absolute -right-16 -top-16 w-48 h-48 bg-emerald-500/5 rounded-full blur-[60px] group-hover:bg-emerald-500/10 transition-all duration-700">
                    </div>
                    <div
                        class="w-16 h-16 rounded-2xl bg-emerald-50 flex items-center justify-center text-emerald-600 mb-10 border border-emerald-100 group-hover:scale-110 transition-transform relative z-10">
                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h4 class="text-2xl font-black text-slate-900 mb-4 tracking-tight">Active Renewal Engine</h4>
                    <p class="text-slate-600 leading-relaxed text-sm mb-6 font-medium">Stop losing business to missed
                        deadlines. Our engine tracks upcoming expiries 90 days out and auto-calculates expected
                        commissions for your revenue forecast.</p>
                    <ul class="text-xs font-bold text-slate-500 space-y-2 uppercase tracking-widest">
                        <li>• Predictive Expiry Alerts</li>
                        <li>• Revenue Forecasting</li>
                    </ul>
                </div>
                <!-- Claim Lifecycle -->
                <div
                    class="crystal-card p-12 rounded-[3.5rem] relative overflow-hidden group animate-fade-in-up delay-300">
                    <div
                        class="absolute -right-16 -top-16 w-48 h-48 bg-cyan-500/5 rounded-full blur-[60px] group-hover:bg-cyan-500/10 transition-all duration-700">
                    </div>
                    <div
                        class="w-16 h-16 rounded-2xl bg-cyan-50 flex items-center justify-center text-cyan-600 mb-10 border border-cyan-100 group-hover:scale-110 transition-transform relative z-10">
                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                            </path>
                        </svg>
                    </div>
                    <h4 class="text-2xl font-black text-slate-900 mb-4 tracking-tight">Claims Command Center</h4>
                    <p class="text-slate-600 leading-relaxed text-sm mb-6 font-medium">Turn the most stressful part of
                        insurance into Your best service. Track claims through every stage from filing to final
                        settlement with transparency.</p>
                    <ul class="text-xs font-bold text-slate-500 space-y-2 uppercase tracking-widest">
                        <li>• End-to-End Tracking</li>
                        <li>• Document Integrity</li>
                    </ul>
                </div>
                <!-- Financial Intelligence -->
                <div
                    class="crystal-card p-12 rounded-[3.5rem] relative overflow-hidden group animate-fade-in-up delay-100">
                    <div
                        class="absolute -right-16 -top-16 w-48 h-48 bg-amber-500/5 rounded-full blur-[60px] group-hover:bg-amber-500/10 transition-all duration-700">
                    </div>
                    <div
                        class="w-16 h-16 rounded-2xl bg-amber-50 flex items-center justify-center text-amber-600 mb-10 border border-amber-100 group-hover:scale-110 transition-transform relative z-10">
                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                            </path>
                        </svg>
                    </div>
                    <h4 class="text-2xl font-black text-slate-900 mb-4 tracking-tight">Intelligence Hub</h4>
                    <p class="text-slate-600 leading-relaxed text-sm mb-6 font-medium">Real-time analytics dashboards
                        that show you the pulse of your agency. Monitor sales trends, query volumes, and claim ratios at
                        a single glance.</p>
                    <ul class="text-xs font-bold text-slate-500 space-y-2 uppercase tracking-widest">
                        <li>• Real-Time Stats</li>
                        <li>• 12-Month Forecasts</li>
                    </ul>
                </div>
                <!-- Agency Architecture -->
                <div
                    class="crystal-card p-12 rounded-[3.5rem] relative overflow-hidden group animate-fade-in-up delay-200">
                    <div
                        class="absolute -right-16 -top-16 w-48 h-48 bg-indigo-500/5 rounded-full blur-[60px] group-hover:bg-indigo-500/10 transition-all duration-700">
                    </div>
                    <div
                        class="w-16 h-16 rounded-2xl bg-indigo-50 flex items-center justify-center text-indigo-600 mb-10 border border-indigo-100 group-hover:scale-110 transition-transform relative z-10">
                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                            </path>
                        </svg>
                    </div>
                    <h4 class="text-2xl font-black text-slate-900 mb-4 tracking-tight">Enterprise Scaling</h4>
                    <p class="text-slate-600 leading-relaxed text-sm mb-6 font-medium">Designed for both solo agents and
                        large agencies. Whitelabel the entire portal with your branding and manage staff with granular
                        permission controls.</p>
                    <ul class="text-xs font-bold text-slate-500 space-y-2 uppercase tracking-widest">
                        <li>• Multi-Tenant Infrastructure</li>
                        <li>• RBAC Permission Control</li>
                    </ul>
                </div>
                <!-- Operational Security -->
                <div
                    class="crystal-card p-12 rounded-[3.5rem] relative overflow-hidden group animate-fade-in-up delay-300">
                    <div
                        class="absolute -right-16 -top-16 w-48 h-48 bg-slate-500/5 rounded-full blur-[60px] group-hover:bg-slate-500/10 transition-all duration-700">
                    </div>
                    <div
                        class="w-16 h-16 rounded-2xl bg-slate-100 flex items-center justify-center text-slate-600 mb-10 border border-slate-200 group-hover:scale-110 transition-transform relative z-10">
                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                            </path>
                        </svg>
                    </div>
                    <h4 class="text-2xl font-black text-slate-900 mb-4 tracking-tight">Data Integrity</h4>
                    <p class="text-slate-600 leading-relaxed text-sm mb-6 font-medium">Military-grade protection for
                        your client data. Featuring a Trash Bin for easy restoration of accidental deletions and
                        encrypted document storage.</p>
                    <ul class="text-xs font-bold text-slate-500 space-y-2 uppercase tracking-widest">
                        <li>• Instant Data Recovery</li>
                        <li>• Asset Isolation</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Live Interactive Experience (Pixel-Perfect Replica) -->
    <section id="demo" class="py-16 sm:py-32 px-4 sm:px-8 bg-[#0f111a] relative overflow-hidden" x-data="simulationDashboard()">

        <!-- App-Style Background System -->
        <div class="absolute inset-0 bg-[#fdfdff] opacity-10"></div>
        <div class="absolute top-[-10%] left-[-10%] w-[60%] h-[60%] bg-indigo-500/20 rounded-full blur-[140px] animate-pulse"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[50%] h-[50%] bg-indigo-500/20 rounded-full blur-[120px] animate-pulse"></div>

        <div class="max-w-[1440px] mx-auto relative z-10">
            <div class="text-center mb-10 sm:mb-16">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-indigo-500/20 border border-indigo-500/30 text-indigo-400 text-[10px] font-black uppercase tracking-[0.3em] mb-6">
                    Production Simulation
                </div>
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-black text-white mb-6">The Elite Command Center.</h2>
                <p class="text-slate-400 font-medium max-w-2xl mx-auto px-4">This is a pixel-perfect, read-only simulation of
                    the actual NexoraByte ERP environment. Every pixel and data point mirrors our production
                    engineering.</p>
            </div>

            <!-- Interface Container -->
            <div class="bg-[#fdfdff] rounded-[2rem] sm:rounded-[3rem] shadow-[0_50px_100px_-20px_rgba(0,0,0,0.8)] border border-white/10 overflow-hidden flex flex-col md:flex-row md:h-[880px] h-auto scale-95 opacity-0 transition-all duration-1000"
                :class="isLoaded ? 'scale-100 opacity-100' : ''">

                <!-- Sidebar Replica (hidden on mobile, shown on md+) -->
                <aside
                    class="hidden md:flex w-full md:w-[280px] bg-white flex-col pt-8 pb-4 shrink-0 border-r border-slate-100 selection:bg-indigo-500">
                    <div class="px-6 mb-10">
                        <div class="flex items-center gap-4">
                            <div class="h-10 w-10 rounded-xl bg-indigo-600 text-white flex items-center justify-center font-black text-xl shadow-lg shadow-indigo-200"
                                x-text="workspace.name.charAt(0)"></div>
                            <div>
                                <h2 class="text-sm font-black text-slate-900 uppercase tracking-tight"
                                    x-text="workspace.name"></h2>
                                <div class="flex items-center gap-1.5 mt-0.5">
                                    <div class="h-1 w-1 rounded-full bg-emerald-500 animate-pulse"></div>
                                    <p class="text-[8px] font-bold text-slate-400 uppercase tracking-widest">Enterprise Business Suite</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <nav class="flex-1 px-4 space-y-1.5 overflow-y-auto custom-scrollbar">
                        <template x-for="item in [
                            { id: 'dashboard', label: 'Dashboard', icon: 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6' },
                            { id: 'clients', label: 'Clients', icon: 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z' },
                            { id: 'queries', label: 'Queries', icon: 'M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z' },
                            { id: 'claims', label: 'Claims', icon: 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z' },
                            { id: 'renewals', label: 'Renewals', icon: 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z' },
                            { id: 'commissions', label: 'Commissions', icon: 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z' },
                            { id: 'staff', label: 'Staff Management', icon: 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z' },
                            { id: 'trash', label: 'Trash Bin', icon: 'M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16' }
                        ]">
                            <button @click="activeTab = item.id"
                                class="w-full flex items-center gap-4 px-5 py-3 rounded-xl transition-all duration-300 font-bold text-sm border border-transparent"
                                :class="activeTab === item.id ? 'bg-indigo-50/50 text-indigo-600 border-indigo-100 shadow-sm' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900'">
                                <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        :d="item.icon" />
                                </svg>
                                <span x-text="item.label"></span>
                            </button>
                        </template>
                    </nav>

                    <div class="px-4 mt-auto pt-6 border-t border-slate-100 space-y-1">
                        <button @click="activeTab = 'settings'"
                            class="w-full flex items-center gap-4 px-5 py-3 rounded-xl transition-all duration-300 font-bold text-sm border border-transparent"
                            :class="activeTab === 'settings' ? 'bg-indigo-50/50 text-indigo-600 border-indigo-100 shadow-sm' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900'">
                            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>Settings</span>
                        </button>
                        <a href="/"
                            class="w-full flex items-center gap-4 px-5 py-3 rounded-xl text-indigo-600 hover:bg-indigo-50 transition-all duration-300 font-bold text-sm">
                            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            <span>Logout</span>
                        </a>
                    </div>
                </aside>

                <!-- Content Area -->
                <main
                    class="flex-1 bg-[#fdfdff] overflow-y-auto p-4 sm:p-10 relative selection:bg-indigo-500 custom-scrollbar">

                    <!-- Top Bar Header (Perfect Production Replica) -->
                    <div class="flex items-center justify-between mb-10 px-2">
                        <div class="flex items-center gap-8">
                            <h2 class="font-black text-3xl text-slate-900 uppercase tracking-tight"
                                x-text="activeTab.split('-').map(w => w.charAt(0).toUpperCase() + w.slice(1)).join(' ')">
                            </h2>


                            <!-- NexoraByte Intelligence Hub Pill (Production Replica) -->
                            <div
                                class="hidden lg:flex items-center gap-2.5 px-4 h-11 rounded-[1.25rem] bg-white border border-slate-100 shadow-sm hover:shadow-md hover:scale-[1.02] transition-all group relative overflow-hidden cursor-pointer">
                                <div
                                    class="absolute inset-0 bg-indigo-500/5 group-hover:bg-indigo-500/10 transition-colors">
                                </div>
                                <span class="relative flex h-2 w-2">
                                    <span
                                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-500 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-500"></span>
                                </span>
                                <span
                                    class="relative text-[10px] font-black text-slate-900 uppercase tracking-[0.15em]">Intelligence</span>
                                <span
                                    class="relative flex items-center justify-center h-5 w-5 rounded-lg bg-indigo-600 text-[9px] font-black text-white ml-1">3</span>
                            </div>
                        </div>

                        <div class="flex items-center gap-6">
                            <!-- User Profile Dropdown Clone -->
                            <div class="flex items-center gap-4 pl-6 border-l border-slate-100">
                                <div class="text-right hidden sm:block">
                                    <div class="text-[11px] font-black text-slate-900 uppercase tracking-tight"
                                        x-text="user.name"></div>
                                    <div class="text-[9px] font-bold text-indigo-600 uppercase tracking-[0.15em]"
                                        x-text="user.role"></div>
                                </div>
                                <div class="h-11 w-11 rounded-2xl bg-slate-900 border-4 border-white shadow-xl flex items-center justify-center text-white font-black text-xs hover:scale-110 transition-transform cursor-pointer"
                                    x-text="user.name.charAt(0)"></div>
                            </div>
                        </div>
                    </div>

                    <!-- DASHBOARD CONTENT (Production Replica) -->
                    <div x-show="activeTab === 'dashboard'" x-transition:enter="transition-opacity duration-300"
                        class="space-y-8">

                        <!-- 1. Stats Grid (Compact & Premium) -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6">
                            <!-- Total Clients Card -->
                            <div
                                class="group block rounded-[2rem] overflow-hidden border-none shadow-xl transition-all duration-500 relative bg-gradient-to-br from-indigo-600 via-indigo-700 to-indigo-900 h-[140px]">
                                <div
                                    class="absolute -right-4 -top-4 w-20 h-20 bg-white/10 rounded-full blur-2xl group-hover:bg-white/20 transition-all">
                                </div>
                                <div class="p-6 relative z-10 flex flex-col h-full justify-between text-white">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="h-10 w-10 shrink-0 flex items-center justify-center bg-white/20 rounded-xl backdrop-blur-md">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                        </div>
                                        <span
                                            class="text-[10px] font-black uppercase tracking-[0.2em] opacity-80">Clients</span>
                                    </div>
                                    <div>
                                        <div class="text-3xl font-black mb-1 leading-none">1,248</div>
                                        <div class="text-[9px] font-bold uppercase tracking-widest opacity-60">Total
                                            Base</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Open Queries Card -->
                            <div
                                class="group block rounded-[2rem] overflow-hidden border-none shadow-xl transition-all duration-500 relative bg-gradient-to-br from-indigo-500 via-indigo-600 to-indigo-800 h-[140px]">
                                <div
                                    class="absolute -right-4 -top-4 w-20 h-20 bg-white/10 rounded-full blur-2xl group-hover:bg-white/20 transition-all">
                                </div>
                                <div class="p-6 relative z-10 flex flex-col h-full justify-between text-white">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="h-10 w-10 shrink-0 flex items-center justify-center bg-white/20 rounded-xl backdrop-blur-md">
                                            <svg class="h-5 w-5 transform translate-y-[2px]" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                            </svg>
                                        </div>
                                        <span
                                            class="text-[10px] font-black uppercase tracking-[0.2em] opacity-80">Queries</span>
                                    </div>
                                    <div>
                                        <div class="text-3xl font-black mb-1 leading-none">12</div>
                                        <div class="text-[9px] font-bold uppercase tracking-widest opacity-60">Active
                                            Pending</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Pending Claims Card -->
                            <div
                                class="group block rounded-[2rem] overflow-hidden border-none shadow-xl transition-all duration-500 relative bg-gradient-to-br from-amber-500 via-orange-500 to-orange-700 h-[140px]">
                                <div
                                    class="absolute -right-4 -top-4 w-20 h-20 bg-white/10 rounded-full blur-2xl group-hover:bg-white/20 transition-all">
                                </div>
                                <div class="p-6 relative z-10 flex flex-col h-full justify-between text-white">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="h-10 w-10 shrink-0 flex items-center justify-center bg-white/20 rounded-xl backdrop-blur-md">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                            </svg>
                                        </div>
                                        <span
                                            class="text-[10px] font-black uppercase tracking-[0.2em] opacity-80">Claims</span>
                                    </div>
                                    <div>
                                        <div class="text-3xl font-black mb-1 leading-none">08</div>
                                        <div class="text-[9px] font-bold uppercase tracking-widest opacity-60">
                                            Processing</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Upcoming Renewals Card -->
                            <div
                                class="group block rounded-[2rem] overflow-hidden border-none shadow-xl transition-all duration-500 relative bg-gradient-to-br from-emerald-600 via-teal-600 to-teal-800 h-[140px]">
                                <div
                                    class="absolute -right-4 -top-4 w-20 h-20 bg-white/10 rounded-full blur-2xl group-hover:bg-white/20 transition-all">
                                </div>
                                <div class="p-6 relative z-10 flex flex-col h-full justify-between text-white">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="h-10 w-10 shrink-0 flex items-center justify-center bg-white/20 rounded-xl backdrop-blur-md">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <span
                                            class="text-[10px] font-black uppercase tracking-[0.2em] opacity-80">Renewals</span>
                                    </div>
                                    <div>
                                        <div class="text-3xl font-black mb-1 leading-none">158</div>
                                        <div class="text-[9px] font-bold uppercase tracking-widest opacity-60">Upcoming
                                            30D</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Expected Commission Card (Revenue) -->
                            <div
                                class="group block rounded-[2rem] overflow-hidden border-none shadow-xl transition-all duration-500 relative bg-gradient-to-br from-fuchsia-500 via-fuchsia-600 to-pink-700 h-[140px]">
                                <div
                                    class="absolute -right-4 -top-4 w-20 h-20 bg-white/10 rounded-full blur-2xl group-hover:bg-white/20 transition-all">
                                </div>
                                <div class="p-6 relative z-10 flex flex-col h-full justify-between text-white">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="h-10 w-10 shrink-0 flex items-center justify-center bg-white/20 rounded-xl backdrop-blur-md">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <span
                                            class="text-[10px] font-black uppercase tracking-[0.2em] opacity-80">Revenue</span>
                                    </div>
                                    <div>
                                        <div class="text-3xl font-black mb-1 leading-none">₹1.2Cr+</div>
                                        <div class="text-[9px] font-bold uppercase tracking-widest opacity-60">Est.
                                            Yield</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 2. Main Dashboard Content Grid -->
                        <div class="grid lg:grid-cols-12 gap-8 items-start">

                            <!-- Primary Operations Column (Left) -->
                            <div class="lg:col-span-8 space-y-8">

                                <!-- Priority Diagnostic Hub -->
                                <div
                                    class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl p-8 relative overflow-hidden group">
                                    <div
                                        class="absolute top-0 right-0 w-32 h-32 bg-indigo-50/50 rounded-full blur-3xl -mr-16 -mt-16">
                                    </div>
                                    <div class="relative z-10 flex items-center justify-between mb-8">
                                        <div class="flex items-center gap-4">
                                            <div
                                                class="h-12 w-12 rounded-2xl bg-slate-900 flex items-center justify-center shadow-lg">
                                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M3 12h3L9 3l6 18 3-9h3" />
                                                </svg>
                                            </div>
                                            <div>
                                                <h3
                                                    class="text-lg font-black text-slate-900 uppercase tracking-tight flex items-center gap-3">
                                                    Priority Diagnostic
                                                    <div
                                                        class="flex items-center gap-1.5 px-2 py-0.5 rounded-full bg-indigo-50 border border-indigo-100">
                                                        <div
                                                            class="h-1.5 w-1.5 rounded-full bg-indigo-500 animate-pulse">
                                                        </div>
                                                        <span
                                                            class="text-[9px] font-black text-indigo-600 uppercase tracking-widest">Live
                                                            Pulse</span>
                                                    </div>
                                                </h3>
                                                <p
                                                    class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-0.5">
                                                    High-Authority Operational Alerts</p>
                                            </div>
                                        </div>
                                        <span
                                            class="text-[11px] font-black text-slate-900 px-4 py-1.5 rounded-xl bg-slate-50 border border-slate-100 shadow-sm font-bold tracking-widest">3
                                            ALERTS</span>
                                    </div>

                                    <div class="space-y-4 max-h-[400px] overflow-y-auto pr-2 custom-scrollbar">
                                        <div
                                            class="flex items-center justify-between p-4 rounded-[1.5rem] bg-slate-50/50 border border-slate-50 hover:bg-white hover:shadow-lg transition-all duration-300 group/item">
                                            <div class="flex items-center gap-5">
                                                <div
                                                    class="h-12 w-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-xl shadow-inner">
                                                    💬</div>
                                                <div>
                                                    <div class="flex items-center gap-2 mb-0.5">
                                                        <span
                                                            class="text-[9px] font-black uppercase tracking-widest px-2 py-0.5 bg-indigo-100 text-indigo-700 rounded-md">Query</span>
                                                        <span
                                                            class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Pending
                                                            12m ago</span>
                                                    </div>
                                                    <h4
                                                        class="text-sm font-black text-slate-900 uppercase tracking-tight">
                                                        Rajesh Kumar</h4>
                                                </div>
                                            </div>
                                        </div>

                                        <div
                                            class="flex items-center justify-between p-4 rounded-[1.5rem] bg-slate-50/50 border border-slate-50 hover:bg-white hover:shadow-lg transition-all duration-300 group/item">
                                            <div class="flex items-center gap-5">
                                                <div
                                                    class="h-12 w-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl shadow-inner">
                                                    🛡️</div>
                                                <div>
                                                    <div class="flex items-center gap-2 mb-0.5">
                                                        <span
                                                            class="text-[9px] font-black uppercase tracking-widest px-2 py-0.5 bg-amber-100 text-amber-700 rounded-md">Claim</span>
                                                        <span
                                                            class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Active
                                                            2h ago</span>
                                                    </div>
                                                    <h4
                                                        class="text-sm font-black text-slate-900 uppercase tracking-tight">
                                                        Anita Sharma</h4>
                                                </div>
                                            </div>
                                        </div>

                                        <div
                                            class="flex items-center justify-between p-4 rounded-[1.5rem] bg-slate-50/50 border border-slate-50 hover:bg-white hover:shadow-lg transition-all duration-300 group/item">
                                            <div class="flex items-center gap-5">
                                                <div
                                                    class="h-12 w-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl shadow-inner">
                                                    ⏳</div>
                                                <div>
                                                    <div class="flex items-center gap-2 mb-0.5">
                                                        <span
                                                            class="text-[9px] font-black uppercase tracking-widest px-2 py-0.5 bg-emerald-100 text-emerald-700 rounded-md">Renewal</span>
                                                        <span
                                                            class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Due
                                                            5h ago</span>
                                                    </div>
                                                    <h4
                                                        class="text-sm font-black text-slate-900 uppercase tracking-tight">
                                                        Vikram Singh</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Performance Analytics Grid -->
                                <div class="grid md:grid-cols-2 gap-6">
                                    <div
                                        class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl p-8 hover:shadow-2xl transition-all group">
                                        <div class="flex items-center justify-between mb-8">
                                            <div class="flex gap-4">
                                                <div
                                                    class="h-10 w-10 rounded-xl bg-indigo-50 text-indigo-500 flex items-center justify-center border border-indigo-100/50 shadow-sm">
                                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                                    </svg>
                                                </div>
                                                <div>
                                                    <h3
                                                        class="text-sm font-black text-slate-900 uppercase tracking-tight flex items-center gap-2">
                                                        Query Intelligence
                                                        <div
                                                            class="flex items-center gap-1 px-1.5 py-0.5 rounded-full bg-indigo-50 border border-indigo-100">
                                                            <div
                                                                class="h-1 w-1 rounded-full bg-indigo-500 animate-pulse">
                                                            </div>
                                                            <span
                                                                class="text-[7px] font-black text-indigo-600 uppercase tracking-widest">Active</span>
                                                        </div>
                                                    </h3>
                                                    <p
                                                        class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-0.5">
                                                        Volume Analysis</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="h-48"><canvas id="demoQueryPulseChart"></canvas></div>
                                    </div>
                                    <div
                                        class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl p-8 hover:shadow-2xl transition-all group">
                                        <div class="flex items-center justify-between mb-8">
                                            <div class="flex gap-4">
                                                <div
                                                    class="h-10 w-10 rounded-xl bg-amber-50 text-amber-500 flex items-center justify-center border border-amber-100/50 shadow-sm">
                                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                                    </svg>
                                                </div>
                                                <div>
                                                    <h3
                                                        class="text-sm font-black text-slate-900 uppercase tracking-tight flex items-center gap-2">
                                                        Claim Analytics
                                                        <div
                                                            class="flex items-center gap-1 px-1.5 py-0.5 rounded-full bg-amber-50 border border-amber-100">
                                                            <div
                                                                class="h-1 w-1 rounded-full bg-amber-500 animate-pulse">
                                                            </div>
                                                            <span
                                                                class="text-[7px] font-black text-amber-600 uppercase tracking-widest">Live</span>
                                                        </div>
                                                    </h3>
                                                    <p
                                                        class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-0.5">
                                                        Case Metrics</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="h-48"><canvas id="demoClaimPulseChart"></canvas></div>
                                    </div>
                                    <div
                                        class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl p-8 md:col-span-2 relative overflow-hidden group">
                                        <div
                                            class="absolute top-0 right-0 w-64 h-64 bg-emerald-500/5 rounded-full blur-3xl -mr-32 -mt-32">
                                        </div>
                                        <div class="relative z-10 flex items-center justify-between mb-8">
                                            <div class="flex items-center gap-4">
                                                <div
                                                    class="h-12 w-12 rounded-2xl bg-emerald-600 flex items-center justify-center shadow-lg">
                                                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                </div>
                                                <div>
                                                    <h3
                                                        class="text-lg font-black text-slate-900 uppercase tracking-tight">
                                                        Revenue Forecast</h3>
                                                    <p
                                                        class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-0.5">
                                                        12-Month Net Commission Projection</p>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <div class="text-xl font-black text-emerald-600">₹1.2Cr+</div>
                                                <div
                                                    class="text-[9px] font-bold text-slate-400 uppercase tracking-[0.15em]">
                                                    Total Potential</div>
                                            </div>
                                        </div>
                                        <div class="h-64"><canvas id="demoRevenueForecastChart"></canvas></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Intelligence Sidebar (Right Column) -->
                            <div class="lg:col-span-4 space-y-8">
                                <div
                                    class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl p-8 relative overflow-hidden min-h-[400px]">
                                    <div
                                        class="absolute top-0 right-0 w-32 h-32 bg-indigo-500/10 rounded-full blur-2xl -mr-16 -mt-16">
                                    </div>
                                    <div class="relative z-10 flex items-center justify-between mb-8">
                                        <h4
                                            class="text-[10px] font-black text-slate-900 uppercase tracking-[0.25em] flex items-center gap-3">
                                            <div class="h-2 w-2 rounded-full bg-indigo-500 animate-pulse"></div>
                                            Relationship Intel
                                        </h4>
                                        <span
                                            class="text-[9px] font-black text-indigo-600 uppercase tracking-widest bg-indigo-50 px-3 py-1 rounded-full border border-indigo-100">20
                                            APRIL</span>
                                    </div>
                                    <div class="space-y-4">
                                        <div
                                            class="p-5 rounded-[1.5rem] bg-amber-50 text-amber-900 border border-amber-100 flex items-center gap-5 group hover:bg-white hover:shadow-lg transition-all duration-300 cursor-pointer">
                                            <div
                                                class="h-11 w-11 rounded-2xl bg-white flex items-center justify-center text-xl shadow-sm transition-transform group-hover:scale-110">
                                                🎂</div>
                                            <div>
                                                <h5 class="text-[13px] font-black uppercase tracking-tight">Sameer
                                                    Abbasi</h5>
                                                <p
                                                    class="text-[9px] font-bold uppercase tracking-widest text-amber-600 opacity-80">
                                                    Birthday Today</p>
                                            </div>
                                        </div>
                                        <div
                                            class="p-5 rounded-[1.5rem] bg-indigo-50 text-indigo-900 border border-indigo-100 flex items-center gap-5 group hover:bg-white hover:shadow-lg transition-all duration-300 cursor-pointer">
                                            <div
                                                class="h-11 w-11 rounded-2xl bg-white flex items-center justify-center text-xl shadow-sm transition-transform group-hover:scale-110">
                                                💍</div>
                                            <div>
                                                <h5 class="text-[13px] font-black uppercase tracking-tight">Kavita
                                                    Mishra</h5>
                                                <p
                                                    class="text-[9px] font-bold uppercase tracking-widest text-indigo-600 opacity-80">
                                                    Anniversary Today</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Sidebar Interactive Calendar -->
                                <div
                                    class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl p-8 flex flex-col items-center">
                                    <div class="w-full flex items-center justify-between mb-8">
                                        <h3 class="text-xs font-black text-slate-900 uppercase tracking-tight">April
                                            2026</h3>
                                        <div class="flex gap-2">
                                            <button
                                                class="h-8 w-8 rounded-lg bg-slate-50 text-slate-400 hover:text-indigo-600 transition-colors flex items-center justify-center border border-slate-100">
                                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M15 19l-7-7 7-7" />
                                                </svg>
                                            </button>
                                            <button
                                                class="h-8 w-8 rounded-lg bg-slate-50 text-slate-400 hover:text-indigo-600 transition-colors flex items-center justify-center border border-slate-100">
                                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M9 5l7 7-7 7" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="w-full grid grid-cols-7 gap-1">
                                        <template x-for="dayName in ['S', 'M', 'T', 'W', 'T', 'F', 'S']">
                                            <div class="text-center text-[9px] font-black text-slate-300 py-2"
                                                x-text="dayName"></div>
                                        </template>
                                        @foreach(range(1, 30) as $day)
                                            <div
                                                class="aspect-square rounded-xl flex items-center justify-center text-[10px] font-bold transition-all cursor-pointer hover:bg-indigo-50
                                                    {{ $day == 20 ? 'bg-indigo-600 text-white shadow-lg' : 'text-slate-500' }}">
                                                {{ $day }}
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- CLIENTS CONTENT (Production Hub Replica) -->
                    <div x-show="activeTab === 'clients'" x-transition:enter="transition-opacity duration-300"
                        class="space-y-8">
                        <div class="flex items-center justify-between">
                            <div>
                                <h2 class="text-3xl font-black text-slate-900 uppercase tracking-tight">Client Directory
                                </h2>
                                <p class="text-slate-400 text-[10px] font-bold uppercase tracking-widest mt-1">Manage
                                    your policyholders and their comprehensive insurance portfolios.</p>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-4 w-4 text-slate-400 group-focus-within:text-indigo-500 transition-colors"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                    </div>
                                    <input type="text" placeholder="Search clients..."
                                        class="!pl-16 pr-4 py-2.5 text-xs rounded-xl border-slate-100 focus:border-indigo-500 focus:ring-indigo-500 bg-white shadow-sm w-64 transition-all uppercase font-bold text-slate-900 tracking-tight">
                                </div>
                                <button
                                    class="elite-btn bg-indigo-600 text-white px-6 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-lg shadow-indigo-200">+
                                    Add New Client</button>
                            </div>
                        </div>

                        <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl overflow-hidden">
                            <div class="overflow-x-auto">
                                <table class="w-full text-left border-collapse">
                                    <thead class="bg-slate-50/50 border-b border-slate-100">
                                        <tr>
                                            <th
                                                class="px-8 py-5 text-[10px] font-black text-slate-900 uppercase tracking-[0.2em]">
                                                Client Name</th>
                                            <th
                                                class="px-8 py-5 text-[10px] font-black text-slate-900 uppercase tracking-[0.2em]">
                                                Contact Details</th>
                                            <th
                                                class="px-8 py-5 text-[10px] font-black text-slate-900 uppercase tracking-[0.2em]">
                                                DOB / Gender</th>
                                            <th
                                                class="px-8 py-5 text-[10px] font-black text-slate-900 uppercase tracking-[0.2em]">
                                                Anniversary</th>
                                            <th
                                                class="px-8 py-5 text-[10px] font-black text-slate-900 uppercase tracking-[0.2em] text-right">
                                                Action Hub</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-50">
                                        <template x-for="c in clients" :key="c.id">
                                            <tr class="hover:bg-slate-50/80 transition-all duration-300 group">
                                                <td class="px-8 py-5">
                                                    <div class="flex items-center gap-4">
                                                        <div
                                                            class="h-10 w-10 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 p-0.5 shadow-sm border border-white/50 flex-shrink-0 group-hover:scale-110 transition-transform">
                                                            <div
                                                                class="h-full w-full rounded-[9px] bg-white flex items-center justify-center overflow-hidden">
                                                                <span
                                                                    class="text-indigo-600 font-black text-xs uppercase"
                                                                    x-text="c.name.charAt(0)"></span>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="text-[13px] font-black text-slate-900 uppercase"
                                                                x-text="c.name"></div>
                                                            <div class="text-[9px] font-bold text-slate-400 group-hover:text-indigo-500 transition-colors uppercase tracking-widest mt-0.5"
                                                                x-text="'REG-ID: NX-100' + c.id"></div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-8 py-5">
                                                    <div class="text-[12px] font-bold text-slate-700" x-text="c.email">
                                                    </div>
                                                    <div class="text-[10px] font-medium text-slate-400 mt-0.5 tracking-tight"
                                                        x-text="c.phone"></div>
                                                </td>
                                                <td class="px-8 py-5">
                                                    <div class="text-xs font-bold text-slate-900"
                                                        x-text="new Date(c.dob).toLocaleDateString(undefined, {month:'short', day:'numeric', year:'numeric'})">
                                                    </div>
                                                    <span
                                                        class="inline-flex items-center px-2 py-0.5 rounded-full text-[9px] font-black tracking-widest mt-1.5 uppercase"
                                                        :class="c.gender === 'Male' ? 'bg-indigo-50 text-indigo-600' : 'bg-indigo-50 text-indigo-600'"
                                                        x-text="c.gender"></span>
                                                </td>
                                                <td class="px-8 py-5">
                                                    <div class="text-xs font-bold text-slate-600"
                                                        x-text="c.marriage_anniversary ? new Date(c.marriage_anniversary).toLocaleDateString(undefined, {month:'short', day:'numeric', year:'numeric'}) : '—'">
                                                    </div>
                                                </td>
                                                <td class="px-8 py-5 text-right">
                                                    <div
                                                        class="flex items-center justify-end gap-4 opacity-40 group-hover:opacity-100 transition-opacity">
                                                        <button
                                                            class="p-2 hover:bg-indigo-50 hover:text-indigo-600 rounded-xl transition-all"
                                                            title="View"><svg class="h-4 w-4" fill="none"
                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                            </svg></button>
                                                        <button
                                                            class="p-2 hover:bg-amber-50 hover:text-amber-600 rounded-xl transition-all"
                                                            title="Edit"><svg class="h-4 w-4" fill="none"
                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                            </svg></button>
                                                        <button
                                                            class="p-2 hover:bg-indigo-50 hover:text-indigo-600 rounded-xl transition-all"
                                                            title="Delete"><svg class="h-4 w-4" fill="none"
                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg></button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- QUERIES CONTENT (Production Hub Replica) -->
                    <div x-show="activeTab === 'queries'" x-transition:enter="transition-opacity duration-300"
                        class="space-y-8">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <h2 class="text-3xl font-black text-slate-900 uppercase tracking-tight">Service Queries
                                </h2>
                                <p class="text-slate-400 text-[10px] font-bold uppercase tracking-widest mt-1">Track and
                                    respond to client inquiries and support requests.</p>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-4 w-4 text-slate-400 group-focus-within:text-indigo-500 transition-colors"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                    </div>
                                    <input type="text" placeholder="Search queries..."
                                        class="!pl-16 pr-4 py-2.5 text-xs rounded-xl border-slate-100 focus:border-indigo-500 focus:ring-indigo-500 bg-white shadow-sm w-64 transition-all uppercase font-bold text-slate-900 tracking-tight">
                                </div>
                                <button
                                    class="elite-btn bg-indigo-600 text-white px-6 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-lg shadow-indigo-200 flex items-center gap-2">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4" />
                                    </svg>
                                    New Inquiry
                                </button>
                            </div>
                        </div>

                        <!-- Query Analytics Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                            <template x-for="s in [
                                { t: 'TOTAL', l: 'Total Queries', v: queryStats.total, c: 'indigo', i: 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2' },
                                { t: 'SAFE', l: 'Approved', v: queryStats.approved, c: 'emerald', i: 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z' },
                                { t: 'WAITING', l: 'Pending', v: queryStats.pending, c: 'amber', i: 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z' },
                                { t: 'DENIED', l: 'Rejected', v: queryStats.rejected, c: 'rose', i: 'M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z' }
                            ]">
                                <div
                                    class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 relative overflow-hidden group hover:shadow-md transition-all duration-300">
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="p-2 rounded-lg" :class="'bg-'+s.c+'-50 text-'+s.c+'-600'">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    :d="s.i" />
                                            </svg>
                                        </div>
                                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest"
                                            x-text="s.t"></span>
                                    </div>
                                    <div class="text-2xl font-black text-slate-900" x-text="s.v"></div>
                                    <div class="text-[10px] font-bold text-slate-500 mt-1 uppercase tracking-tight"
                                        x-text="s.l"></div>
                                </div>
                            </template>
                        </div>

                        <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl overflow-hidden">
                            <div class="overflow-x-auto">
                                <table class="w-full text-left">
                                    <thead class="bg-slate-50/50 border-b border-slate-100">
                                        <tr>
                                            <th
                                                class="px-8 py-5 text-[10px] font-black text-slate-900 uppercase tracking-[0.2em]">
                                                Client / Subject</th>
                                            <th
                                                class="px-8 py-5 text-[10px] font-black text-slate-900 uppercase tracking-[0.2em]">
                                                Priority</th>
                                            <th
                                                class="px-8 py-5 text-[10px] font-black text-slate-900 uppercase tracking-[0.2em]">
                                                Status</th>
                                            <th
                                                class="px-8 py-5 text-[10px] font-black text-slate-900 uppercase tracking-[0.2em]">
                                                Received</th>
                                            <th
                                                class="px-8 py-5 text-[10px] font-black text-slate-900 uppercase tracking-[0.2em] text-right">
                                                Action Hub</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-50">
                                        <template x-for="q in queries" :key="q.id">
                                            <tr class="hover:bg-slate-50 transition-colors group">
                                                <td class="px-8 py-6">
                                                    <div class="font-black text-slate-900 uppercase text-[13px]"
                                                        x-text="q.subject"></div>
                                                    <div class="text-[10px] font-bold text-indigo-600 uppercase tracking-widest mt-0.5"
                                                        x-text="q.client_name"></div>
                                                    <template x-if="q.document">
                                                        <div
                                                            class="inline-flex items-center gap-1.5 text-[9px] bg-slate-100 text-slate-600 px-2.5 py-1 rounded-md mt-2 font-bold uppercase transition-colors hover:bg-indigo-50 hover:text-indigo-600 cursor-pointer">
                                                            <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24"
                                                                stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                                            </svg>
                                                            Supporting Doc
                                                        </div>
                                                    </template>
                                                </td>
                                                <td class="px-8 py-6">
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[9px] font-black uppercase tracking-widest"
                                                        :class="q.priority === 'high' ? 'bg-indigo-100 text-indigo-700' : (q.priority === 'medium' ? 'bg-amber-100 text-amber-700' : 'bg-slate-100 text-slate-700')"
                                                        x-text="q.priority"></span>
                                                </td>
                                                <td class="px-8 py-6">
                                                    <div class="flex items-center gap-2">
                                                        <div class="h-2 w-2 rounded-full"
                                                            :class="q.status === 'approved' ? 'bg-emerald-500' : (q.status === 'rejected' ? 'bg-indigo-500' : 'bg-amber-500')">
                                                        </div>
                                                        <span class="text-[10px] font-black uppercase tracking-widest"
                                                            :class="q.status === 'approved' ? 'text-emerald-700' : (q.status === 'rejected' ? 'text-indigo-700' : 'text-amber-700')"
                                                            x-text="q.status"></span>
                                                    </div>
                                                </td>
                                                <td class="px-8 py-6">
                                                    <div class="text-[11px] font-black text-slate-900"
                                                        x-text="new Date(q.created_at).toLocaleDateString(undefined, {month:'short', day:'numeric', year:'numeric'})">
                                                    </div>
                                                    <div class="text-[9px] font-bold text-slate-400 mt-0.5 uppercase">
                                                        Just now</div>
                                                </td>
                                                <td class="px-8 py-6 text-right">
                                                    <div
                                                        class="flex items-center justify-end gap-3 text-[10px] font-black uppercase tracking-widest">
                                                        <button
                                                            class="text-indigo-600 hover:text-indigo-900 flex items-center gap-1.5 transition-transform hover:scale-105">View</button>
                                                        <span class="text-slate-200">|</span>
                                                        <button
                                                            class="text-amber-600 hover:text-amber-900 flex items-center gap-1.5 transition-transform hover:scale-105">Edit</button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- CLAIMS CONTENT (Restored to Production Parity) -->
                    <div x-show="activeTab === 'claims'" x-transition:enter="transition-opacity duration-300"
                        class="space-y-10">
                        <div class="flex items-center justify-between mb-8">
                            <div>
                                <h2 class="text-2xl font-black text-slate-900 uppercase tracking-tight">Insurance Claims
                                </h2>
                                <p class="text-slate-400 text-[10px] font-bold uppercase tracking-widest mt-1">Monitor
                                    and process client insurance claims and settlements.</p>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-4 w-4 text-slate-400 group-focus-within:text-indigo-500 transition-colors"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                    </div>
                                    <input type="text" placeholder="Search policy # or client..."
                                        class="!pl-16 pr-4 py-2.5 text-xs rounded-xl border-slate-100 focus:border-indigo-500 focus:ring-indigo-500 bg-white shadow-sm w-64 transition-all uppercase font-bold text-slate-900 tracking-tight">
                                </div>
                                <button
                                    class="elite-btn bg-indigo-600 text-white px-6 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-lg shadow-indigo-200 flex items-center gap-2">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4" />
                                    </svg>
                                    New Claim Entry
                                </button>
                            </div>
                        </div>

                        <!-- Claims Analytics Grid (Synched exactly with Production) -->
                        <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                            <template x-for="s in [
                                { t: 'TOTAL', l: 'Total Claims', v: claimStats.total, c: 'slate', i: 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z' },
                                { t: 'IN-LOG', l: 'Submitted', v: claimStats.submitted, c: 'indigo', i: 'M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15' },
                                { t: 'WAITING', l: 'Pending', v: claimStats.pending, c: 'amber', i: 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z' },
                                { t: 'SETTLED', l: 'Approved', v: claimStats.approved, c: 'emerald', i: 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z' },
                                { t: 'VOID', l: 'Rejected', v: claimStats.rejected, c: 'rose', i: 'M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z' }
                            ]">
                                <div
                                    class="bg-white rounded-2xl border border-slate-100 shadow-sm p-4 relative overflow-hidden group hover:shadow-md transition-all duration-300">
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="p-2 rounded-lg transition-colors group-hover:scale-110"
                                            :class="'bg-'+s.c+'-50 text-'+s.c+'-600'">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    :d="s.i" />
                                            </svg>
                                        </div>
                                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest"
                                            x-text="s.t"></span>
                                    </div>
                                    <div class="text-2xl font-black text-slate-900" x-text="s.v"></div>
                                    <div class="text-xs font-bold text-slate-500 mt-1 uppercase" x-text="s.l"></div>
                                </div>
                            </template>
                        </div>

                        <!-- Claims Table (Elite Interface) -->
                        <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl overflow-hidden">
                            <div class="overflow-x-auto">
                                <table class="w-full text-left">
                                    <thead class="bg-slate-50 border-b border-slate-100">
                                        <tr>
                                            <th
                                                class="px-8 py-5 text-[10px] font-black text-slate-900 uppercase tracking-[0.15em]">
                                                Claim Details</th>
                                            <th
                                                class="px-8 py-5 text-[10px] font-black text-slate-900 uppercase tracking-[0.15em]">
                                                Policy #</th>
                                            <th
                                                class="px-8 py-5 text-[10px] font-black text-slate-900 uppercase tracking-[0.15em]">
                                                Amount</th>
                                            <th
                                                class="px-8 py-5 text-[10px] font-black text-slate-900 uppercase tracking-[0.15em]">
                                                Status</th>
                                            <th
                                                class="px-8 py-5 text-[10px] font-black text-slate-900 uppercase tracking-[0.15em] text-right">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-50">
                                        <template x-for="c in claims" :key="c.id">
                                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-colors">
                                                <td class="px-6 py-4">
                                                    <div class="font-bold text-gray-900 capitalize"
                                                        x-text="c.client_name"></div>
                                                    <div class="text-[11px] text-gray-400 mt-0.5 uppercase tracking-tighter"
                                                        x-text="c.policy_type + ' • ' + new Date(c.incident_date).toLocaleDateString(undefined, {month:'short', day:'numeric', year:'numeric'})">
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 font-mono text-sm text-indigo-600">
                                                    <span x-text="c.policy_number"></span>
                                                </td>
                                                <td class="px-6 py-4 font-bold text-gray-900">
                                                    ₹<span
                                                        x-text="Number(c.claim_amount).toLocaleString(undefined, {minimumFractionDigits: 2})"></span>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <span
                                                        class="px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest"
                                                        :class="{
                                                            'bg-emerald-50 text-emerald-600': c.status === 'approved',
                                                            'bg-amber-50 text-amber-600': c.status === 'pending',
                                                            'bg-indigo-50 text-indigo-600': c.status === 'rejected',
                                                            'bg-indigo-50 text-indigo-600': c.status === 'submitted'
                                                        }" x-text="c.status"></span>
                                                </td>
                                                <td class="px-6 py-4 text-right">
                                                    <div
                                                        class="flex items-center justify-end gap-3 text-[10px] font-bold uppercase tracking-wider">
                                                        <button
                                                            class="text-indigo-600 hover:text-indigo-900 flex items-center gap-1 transition-transform hover:scale-105">
                                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                                                stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2.5"
                                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2.5"
                                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                            </svg>
                                                            View
                                                        </button>
                                                        <button
                                                            class="text-amber-600 hover:text-amber-900 flex items-center gap-1 transition-transform hover:scale-105">
                                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                                                stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2.5"
                                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                            </svg>
                                                            Edit
                                                        </button>
                                                        <button
                                                            class="text-indigo-600 hover:text-indigo-900 flex items-center gap-1 transition-transform hover:scale-105">
                                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                                                stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2.5"
                                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                            Delete
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- RENEWALS CONTENT (Production Hub Replica) -->
                    <div x-show="activeTab === 'renewals'" x-transition:enter="transition-opacity duration-300"
                        class="space-y-8">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <h2 class="text-3xl font-black text-slate-900 uppercase tracking-tight">Policy Renewals
                                </h2>
                                <p class="text-slate-400 text-[10px] font-bold uppercase tracking-widest mt-1">Manage
                                    upcoming expirations and renewal processes.</p>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-4 w-4 text-slate-400 group-focus-within:text-emerald-500 transition-colors"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                    </div>
                                    <input type="text" placeholder="Search policy #..."
                                        class="!pl-16 pr-4 py-2.5 text-xs rounded-xl border-slate-100 focus:border-emerald-500 focus:ring-emerald-500 bg-white shadow-sm w-64 transition-all uppercase font-bold text-slate-900 tracking-tight">
                                </div>
                                <button
                                    class="elite-btn bg-emerald-600 text-white px-6 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-lg shadow-emerald-200 flex items-center gap-2">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4" />
                                    </svg>
                                    Add Renewal
                                </button>
                            </div>
                        </div>

                        <!-- Renewals Analytics Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                            <template x-for="s in [
                                { t: 'AGREE', l: 'Total Policies', v: renewalStats.total, c: 'slate', i: 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2' },
                                { t: 'WAITING', l: 'Pending', v: renewalStats.pending, c: 'amber', i: 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z' },
                                { t: 'SECURE', l: 'Renewed', v: renewalStats.renewed, c: 'emerald', i: 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z' },
                                { t: 'CRITICAL', l: 'Lapsed', v: renewalStats.lapsed, c: 'rose', i: 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z' },
                                { t: 'ALERT', l: '30-Day Alert', v: renewalStats.upcoming, c: 'indigo', i: 'M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9' }
                            ]">
                                <div
                                    class="bg-white rounded-2xl border border-slate-100 shadow-sm p-4 relative overflow-hidden group hover:shadow-md transition-all duration-300">
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="p-2 rounded-lg" :class="'bg-'+s.c+'-50 text-'+s.c+'-600'">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    :d="s.i" />
                                            </svg>
                                        </div>
                                        <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest"
                                            x-text="s.t"></span>
                                    </div>
                                    <div class="text-2xl font-black text-slate-900" x-text="s.v"></div>
                                    <div class="text-[10px] font-bold text-slate-500 mt-1 uppercase tracking-tight"
                                        x-text="s.l"></div>
                                </div>
                            </template>
                        </div>

                        <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl overflow-hidden">
                            <div class="overflow-x-auto">
                                <table class="w-full text-left">
                                    <thead class="bg-slate-50/50 border-b border-slate-100">
                                        <tr>
                                            <th
                                                class="px-8 py-5 text-[10px] font-black text-slate-900 uppercase tracking-[0.2em]">
                                                Policy Details</th>
                                            <th
                                                class="px-8 py-5 text-[10px] font-black text-slate-900 uppercase tracking-[0.2em]">
                                                Policy #</th>
                                            <th
                                                class="px-8 py-5 text-[10px] font-black text-slate-900 uppercase tracking-[0.2em]">
                                                Premium</th>
                                            <th
                                                class="px-8 py-5 text-[10px] font-black text-slate-900 uppercase tracking-[0.2em]">
                                                Expiry / Status</th>
                                            <th
                                                class="px-8 py-5 text-[10px] font-black text-slate-900 uppercase tracking-[0.2em] text-right">
                                                Action Hub</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-50">
                                        <template x-for="r in renewals" :key="r.id">
                                            <tr class="hover:bg-slate-50 transition-colors group">
                                                <td class="px-8 py-6">
                                                    <div class="font-black text-slate-900 uppercase text-[13px]"
                                                        x-text="r.client_name"></div>
                                                    <div class="text-[10px] font-bold text-emerald-600 uppercase tracking-widest mt-0.5"
                                                        x-text="r.policy_type"></div>
                                                </td>
                                                <td class="px-8 py-6 font-mono text-sm text-slate-600"
                                                    x-text="r.policy_number"></td>
                                                <td class="px-8 py-6 font-black text-slate-900">₹<span
                                                        x-text="Number(r.premium_amount).toLocaleString(undefined, {minimumFractionDigits: 2})"></span>
                                                </td>
                                                <td class="px-8 py-6">
                                                    <div class="text-[11px] font-black text-slate-900"
                                                        x-text="new Date(r.expiry_date).toLocaleDateString(undefined, {month:'short', day:'numeric', year:'numeric'})">
                                                    </div>
                                                    <span
                                                        class="inline-flex items-center px-2 py-0.5 rounded-full text-[9px] font-black tracking-widest mt-1.5 uppercase"
                                                        :class="r.status === 'renewed' ? 'bg-emerald-50 text-emerald-600' : (r.status === 'lapsed' ? 'bg-indigo-50 text-indigo-600' : 'bg-amber-50 text-amber-600')"
                                                        x-text="r.status"></span>
                                                </td>
                                                <td class="px-8 py-6 text-right">
                                                    <div
                                                        class="flex items-center justify-end gap-3 text-[10px] font-black uppercase tracking-widest">
                                                        <button
                                                            class="text-emerald-600 hover:text-emerald-900 flex items-center gap-1.5 transition-transform hover:scale-105">View</button>
                                                        <span class="text-slate-200">|</span>
                                                        <button
                                                            class="text-amber-600 hover:text-amber-900 flex items-center gap-1.5 transition-transform hover:scale-105">Edit</button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- COMMISSIONS CONTENT (Production Hub Replica) -->
                    <div x-show="activeTab === 'commissions'" x-transition:enter="transition-opacity duration-300"
                        class="space-y-8">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <h2 class="text-3xl font-black text-slate-900 uppercase tracking-tight">Financial Hub
                                </h2>
                                <p class="text-slate-400 text-[10px] font-bold uppercase tracking-widest mt-1">Track
                                    commissions, revenue yields, and payment settlements.</p>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-4 w-4 text-slate-400 group-focus-within:text-fuchsia-500 transition-colors"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                    </div>
                                    <input type="text" placeholder="Search ledger..."
                                        class="!pl-16 pr-4 py-2.5 text-xs rounded-xl border-slate-100 focus:border-fuchsia-500 focus:ring-fuchsia-500 bg-white shadow-sm w-64 transition-all uppercase font-bold text-slate-900 tracking-tight">
                                </div>
                                <button
                                    class="elite-btn bg-fuchsia-600 text-white px-6 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-lg shadow-fuchsia-200 flex items-center gap-2">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Export Ledger
                                </button>
                            </div>
                        </div>

                        <!-- Financial Stats Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <template x-for="s in [
                                { t: 'INCOMING', l: 'Total Pending', v: '₹' + Number(commStats.total_pending).toLocaleString(), c: 'amber', i: 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z' },
                                { t: 'REVENUE', l: 'Received (Month)', v: '₹' + Number(commStats.total_received_month).toLocaleString(), c: 'emerald', i: 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z' },
                                { t: 'VOLUME', l: 'Unpaid Count', v: commStats.pending_count, c: 'indigo', i: 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2' }
                            ]">
                                <div
                                    class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 relative overflow-hidden group hover:shadow-md transition-all duration-300">
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="p-2.5 rounded-xl transition-colors"
                                            :class="'bg-'+s.c+'-50 text-'+s.c+'-600'">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    :d="s.i" />
                                            </svg>
                                        </div>
                                        <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest"
                                            x-text="s.t"></span>
                                    </div>
                                    <div class="text-3xl font-black text-slate-900" x-text="s.v"></div>
                                    <div class="text-[11px] font-bold text-slate-500 mt-1 uppercase tracking-tight"
                                        x-text="s.l"></div>
                                </div>
                            </template>
                        </div>

                        <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl overflow-hidden">
                            <div class="overflow-x-auto">
                                <table class="w-full text-left">
                                    <thead class="bg-slate-50/50 border-b border-slate-100">
                                        <tr>
                                            <th
                                                class="px-8 py-5 text-[10px] font-black text-slate-900 uppercase tracking-[0.2em]">
                                                Source (Client)</th>
                                            <th
                                                class="px-8 py-5 text-[10px] font-black text-slate-900 uppercase tracking-[0.2em]">
                                                Policy / Provider</th>
                                            <th
                                                class="px-8 py-5 text-[10px] font-black text-slate-900 uppercase tracking-[0.2em]">
                                                Expected</th>
                                            <th
                                                class="px-8 py-5 text-[10px] font-black text-slate-900 uppercase tracking-[0.2em]">
                                                Received</th>
                                            <th
                                                class="px-8 py-5 text-[10px] font-black text-slate-900 uppercase tracking-[0.2em]">
                                                Status</th>
                                            <th
                                                class="px-8 py-5 text-[10px] font-black text-slate-900 uppercase tracking-[0.2em] text-right">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-50">
                                        <template x-for="c in commissionLedger" :key="c.id">
                                            <tr class="hover:bg-slate-50 transition-colors group">
                                                <td class="px-8 py-6">
                                                    <div class="font-black text-slate-900 uppercase text-[13px]"
                                                        x-text="c.client_name"></div>
                                                </td>
                                                <td class="px-8 py-6">
                                                    <div class="text-[11px] font-black text-slate-900 uppercase"
                                                        x-text="c.policy_number"></div>
                                                    <div class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-0.5"
                                                        x-text="c.provider"></div>
                                                </td>
                                                <td class="px-8 py-6 font-black text-slate-900">₹<span
                                                        x-text="Number(c.expected_amount).toLocaleString()"></span></td>
                                                <td class="px-8 py-6 font-black text-emerald-600">
                                                    <span x-show="c.received_amount > 0">₹<span
                                                            x-text="Number(c.received_amount).toLocaleString()"></span></span>
                                                    <span x-show="c.received_amount == 0"
                                                        class="text-slate-300">—</span>
                                                </td>
                                                <td class="px-8 py-6">
                                                    <span
                                                        class="inline-flex items-center px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest border"
                                                        :class="c.status === 'received' ? 'bg-emerald-50 text-emerald-700 border-emerald-100' : 'bg-amber-50 text-amber-700 border-amber-100'"
                                                        x-text="c.status"></span>
                                                    <div x-show="c.received_at"
                                                        class="text-[8px] font-bold text-slate-400 mt-1 uppercase"
                                                        x-text="new Date(c.received_at).toLocaleDateString(undefined, {month:'short', day:'numeric', year:'numeric'})">
                                                    </div>
                                                </td>
                                                <td class="px-8 py-6 text-right">
                                                    <button
                                                        class="text-fuchsia-600 hover:text-fuchsia-900 text-[10px] font-black uppercase tracking-widest">Mark
                                                        Paid</button>
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- STAFF CONTENT (Production Hub Replica) -->
                    <div x-show="activeTab === 'staff'" x-transition:enter="transition-opacity duration-300"
                        class="space-y-8">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <h2 class="text-3xl font-black text-slate-900 uppercase tracking-tight">Team Members
                                </h2>
                                <p class="text-slate-400 text-[10px] font-bold uppercase tracking-widest mt-1">Manage
                                    personnel, roles, and administrative access.</p>
                            </div>
                            <button
                                class="elite-btn bg-slate-900 text-white px-6 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-lg flex items-center gap-2">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                </svg>
                                Add Member
                            </button>
                        </div>

                        <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl overflow-hidden">
                            <div class="overflow-x-auto">
                                <table class="w-full text-left">
                                    <thead class="bg-slate-50/50 border-b border-slate-100">
                                        <tr>
                                            <th
                                                class="px-8 py-5 text-[10px] font-black text-slate-900 uppercase tracking-[0.2em]">
                                                Member Details</th>
                                            <th
                                                class="px-8 py-5 text-[10px] font-black text-slate-900 uppercase tracking-[0.2em]">
                                                Contact Information</th>
                                            <th
                                                class="px-8 py-5 text-[10px] font-black text-slate-900 uppercase tracking-[0.2em]">
                                                Designation</th>
                                            <th
                                                class="px-8 py-5 text-[10px] font-black text-slate-900 uppercase tracking-[0.2em]">
                                                Status</th>
                                            <th
                                                class="px-8 py-5 text-[10px] font-black text-slate-900 uppercase tracking-[0.2em] text-right">
                                                Action Hub</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-50">
                                        <template x-for="s in staffMembers" :key="s.id">
                                            <tr class="hover:bg-slate-50 transition-colors group">
                                                <td class="px-8 py-6">
                                                    <div class="flex items-center gap-4">
                                                        <div class="h-10 w-10 rounded-xl bg-slate-100 flex items-center justify-center font-black text-sm text-slate-600 transition-transform group-hover:scale-110"
                                                            x-text="s.name.charAt(0)"></div>
                                                        <div>
                                                            <div class="text-[13px] font-black text-slate-900 uppercase"
                                                                x-text="s.name"></div>
                                                            <div class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-0.5"
                                                                x-text="'EMP-ID: NB-' + (100+s.id)"></div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-8 py-6">
                                                    <div class="text-[11px] font-bold text-slate-700" x-text="s.email">
                                                    </div>
                                                    <div class="text-[9px] font-medium text-slate-400 mt-0.5 tracking-tight"
                                                        x-text="s.phone"></div>
                                                </td>
                                                <td class="px-8 py-6">
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-1 rounded-lg text-[9px] font-black uppercase tracking-widest bg-slate-100 text-slate-600"
                                                        x-text="s.designation"></span>
                                                </td>
                                                <td class="px-8 py-6">
                                                    <span
                                                        class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest bg-emerald-50 text-emerald-700 border border-emerald-100">
                                                        <div
                                                            class="h-1.5 w-1.5 rounded-full bg-emerald-500 animate-pulse">
                                                        </div>
                                                        ACTIVE
                                                    </span>
                                                </td>
                                                <td class="px-8 py-6 text-right">
                                                    <div
                                                        class="flex items-center justify-end gap-3 text-[10px] font-black uppercase tracking-widest">
                                                        <button
                                                            class="text-slate-600 hover:text-slate-900 font-black">EDIT</button>
                                                        <span class="text-slate-200">|</span>
                                                        <button
                                                            class="text-indigo-600 hover:text-indigo-900 font-black">REMOVE</button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- TRASH CONTENT (Production Hub Replica) -->
                    <div x-show="activeTab === 'trash'" x-transition:enter="transition-opacity duration-300"
                        class="space-y-8">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <h2 class="text-3xl font-black text-slate-900 uppercase tracking-tight">Data Recovery
                                    Hub</h2>
                                <p class="text-slate-400 text-[10px] font-bold uppercase tracking-widest mt-1">Review
                                    and restore recently deleted records from the system.</p>
                            </div>
                            <button
                                class="elite-btn bg-indigo-600 text-white px-6 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-lg shadow-indigo-200 flex items-center gap-2">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Empty Bin
                            </button>
                        </div>

                        <!-- Trash Navigation -->
                        <div class="flex items-center gap-1 p-1 bg-slate-100 rounded-2xl w-fit">
                            <template x-for="t in ['clients', 'queries', 'claims', 'renewals', 'staff']">
                                <button @click="trashTab = t"
                                    class="px-5 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all"
                                    :class="trashTab === t ? 'bg-white text-indigo-600 shadow-sm' : 'text-slate-500 hover:text-slate-900'"
                                    x-text="t"></button>
                            </template>
                        </div>

                        <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl overflow-hidden">
                            <div class="overflow-x-auto">
                                <table class="w-full text-left">
                                    <thead class="bg-slate-50/50 border-b border-slate-100">
                                        <tr>
                                            <th
                                                class="px-8 py-5 text-[10px] font-black text-slate-900 uppercase tracking-[0.2em]">
                                                Record Details</th>
                                            <th
                                                class="px-8 py-5 text-[10px] font-black text-slate-900 uppercase tracking-[0.2em]">
                                                Deleted On</th>
                                            <th
                                                class="px-8 py-5 text-[10px] font-black text-slate-900 uppercase tracking-[0.2em] text-right">
                                                Action Hub</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-50">
                                        <template x-for="item in deletedItems[trashTab]" :key="item.id">
                                            <tr class="hover:bg-indigo-50/30 transition-colors group">
                                                <td class="px-8 py-6">
                                                    <div class="font-black text-slate-900 uppercase text-[13px]"
                                                        x-text="item.name || item.subject || item.policy_number"></div>
                                                    <div class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-0.5"
                                                        x-text="item.email || item.client_name"></div>
                                                </td>
                                                <td class="px-8 py-6">
                                                    <div class="text-[11px] font-black text-indigo-600 uppercase"
                                                        x-text="item.deleted_at"></div>
                                                </td>
                                                <td class="px-8 py-6 text-right">
                                                    <div
                                                        class="flex items-center justify-end gap-3 text-[10px] font-black uppercase tracking-widest">
                                                        <button
                                                            class="text-emerald-600 hover:text-emerald-900 flex items-center gap-1.5 transition-transform hover:scale-105">Restore</button>
                                                        <span class="text-slate-200">|</span>
                                                        <button
                                                            class="text-indigo-600 hover:text-indigo-900 flex items-center gap-1.5 transition-transform hover:scale-105">Purge</button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </template>
                                        <template x-if="deletedItems[trashTab].length === 0">
                                            <tr>
                                                <td colspan="3" class="px-8 py-20 text-center">
                                                    <div class="flex flex-col items-center opacity-20">
                                                        <svg class="h-12 w-12 text-slate-400 mb-4" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                        <span
                                                            class="text-[10px] font-black uppercase tracking-[0.3em]">No
                                                            Deleted Records Found</span>
                                                    </div>
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- SETTINGS CONTENT (Production Hub Replica) -->
                    <div x-show="activeTab === 'settings'" x-transition:enter="transition-opacity duration-300"
                        class="space-y-8" x-data="{ activeSettings: 'general' }">
                        <div class="flex flex-col lg:flex-row gap-8 items-start">

                            <!-- Advanced Navigation Sidebar (Simulated) -->
                            <div class="w-full lg:w-80 shrink-0 sticky top-0">
                                <div class="mb-6">
                                    <h1 class="text-3xl font-black text-slate-900 tracking-tight">Console</h1>
                                    <p class="text-slate-500 text-xs font-bold uppercase tracking-widest mt-1">Workspace
                                        Control</p>
                                </div>

                                <div
                                    class="space-y-1.5 p-1.5 bg-slate-100/50 rounded-[2rem] border border-slate-200/50 backdrop-blur-sm">
                                    <button @click="activeSettings = 'general'"
                                        class="w-full flex items-center gap-4 px-6 py-4 rounded-[1.5rem] transition-all duration-300 group"
                                        :class="activeSettings === 'general' ? 'bg-white shadow-xl text-indigo-600 font-black border border-indigo-50' : 'text-slate-500 font-bold hover:bg-white hover:text-slate-900 hover:shadow-lg'">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 00-1.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        General Workspace
                                    </button>

                                    <button @click="activeSettings = 'staff-logs'"
                                        class="w-full flex items-center gap-4 px-6 py-4 rounded-[1.5rem] transition-all duration-300 group"
                                        :class="activeSettings === 'staff-logs' ? 'bg-white shadow-xl text-indigo-600 font-black border border-indigo-50' : 'text-slate-500 font-bold hover:bg-white hover:text-slate-900 hover:shadow-lg'">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                        Staff Intel logs
                                    </button>

                                    <button @click="activeSettings = 'admin-logs'"
                                        class="w-full flex items-center gap-4 px-6 py-4 rounded-[1.5rem] transition-all duration-300 group"
                                        :class="activeSettings === 'admin-logs' ? 'bg-white shadow-xl text-indigo-600 font-black border border-indigo-50' : 'text-slate-500 font-bold hover:bg-white hover:text-slate-900 hover:shadow-lg'">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                        </svg>
                                        Admin Authority Logs
                                    </button>

                                    <div class="mt-4 pt-4 border-t border-slate-200 mx-2">
                                        <button @click="activeSettings = 'profile'"
                                            class="w-full flex items-center gap-3 px-4 py-3 rounded-2xl text-xs font-black uppercase tracking-widest transition-all"
                                            :class="activeSettings === 'profile' ? 'bg-white text-indigo-600 shadow-sm' : 'text-slate-500 hover:bg-white hover:text-indigo-600'">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                            My User Profile
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Settings Content Hub -->
                            <div class="flex-1 min-w-0 space-y-8">
                                <div x-show="activeSettings === 'general'"
                                    x-transition:enter="transition-opacity duration-300">
                                    <!-- Branding & Identity Card -->
                                    <div
                                        class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl p-10 relative overflow-hidden group">
                                        <div
                                            class="absolute top-0 right-0 w-64 h-64 bg-indigo-500/5 rounded-full blur-3xl -mr-32 -mt-32 transition-transform duration-1000 group-hover:scale-150">
                                        </div>

                                        <div class="relative">
                                            <div class="flex items-center justify-between mb-10">
                                                <div>
                                                    <h3 class="text-2xl font-black text-slate-900 tracking-tight">
                                                        Branding & Identity</h3>
                                                    <p
                                                        class="text-slate-400 text-[10px] font-black uppercase tracking-[0.2em] mt-1">
                                                        Primary Workspace Details</p>
                                                </div>
                                                <div
                                                    class="h-12 w-12 rounded-2xl bg-indigo-50 flex items-center justify-center text-indigo-600 shadow-sm border border-indigo-100">
                                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                                    </svg>
                                                </div>
                                            </div>

                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-start">
                                                <div class="space-y-6">
                                                    <div>
                                                        <label
                                                            class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1 mb-2 block">Company
                                                            Entity</label>
                                                        <input type="text" x-model="workspace.name"
                                                            class="w-full px-6 py-4 bg-slate-50 rounded-[1.5rem] border border-slate-100 text-slate-900 font-black text-lg focus:bg-white focus:ring-4 focus:ring-indigo-500/10 transition-all placeholder:text-slate-300">
                                                    </div>
                                                    <div>
                                                        <label
                                                            class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1 mb-2">Workspace
                                                            Logo</label>
                                                        <div class="flex items-center gap-6">
                                                            <div
                                                                class="h-24 w-24 rounded-3xl bg-slate-50 border-2 border-dashed border-slate-200 flex items-center justify-center overflow-hidden shrink-0 shadow-inner hover:bg-white transition-colors relative">
                                                                <span
                                                                    class="text-slate-300 text-[10px] font-black uppercase">Logo</span>
                                                            </div>
                                                            <div class="flex-1">
                                                                <button
                                                                    class="inline-flex items-center gap-2 px-5 py-2.5 rounded-2xl bg-white border-2 border-slate-100 text-xs font-black text-slate-600 hover:border-indigo-600 hover:text-indigo-600 cursor-pointer transition-all shadow-sm">
                                                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                                                        stroke="currentColor">
                                                                        <path stroke-linecap="round"
                                                                            stroke-linejoin="round" stroke-width="2"
                                                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                                                    </svg>
                                                                    Upload Emblem
                                                                </button>
                                                                <p
                                                                    class="text-[9px] font-bold text-slate-400 mt-2 uppercase tracking-widest">
                                                                    Recommended: Square PNG/JPG (Max 2MB)</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="space-y-6">
                                                    <div>
                                                        <label
                                                            class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1 mb-2 block">Global
                                                            Workspace ID</label>
                                                        <div
                                                            class="w-full px-6 py-4 bg-slate-50/50 rounded-[1.5rem] border border-slate-100 font-mono text-slate-400 font-black text-lg uppercase tracking-widest cursor-not-allowed select-all flex items-center justify-between">
                                                            NXB-2024-SIM
                                                            <svg class="h-5 w-5 opacity-50" fill="none"
                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                                            </svg>
                                                        </div>
                                                        <p
                                                            class="text-[9px] text-slate-400 mt-2 font-bold ml-1 flex items-center gap-1">
                                                            Workspace ID is locked for security simulation.
                                                        </p>
                                                    </div>
                                                    <div class="pt-4 flex justify-end">
                                                        <button
                                                            class="inline-flex items-center gap-2 px-8 py-4 rounded-2xl bg-indigo-600 text-xs font-black text-white hover:bg-indigo-700 hover:shadow-lg transition-all uppercase tracking-widest w-full justify-center md:w-auto">
                                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                                                stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="M5 13l4 4L19 7" />
                                                            </svg>
                                                            Save Branding Identity
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                            <div
                                                class="mt-12 pt-12 border-t border-slate-100 grid grid-cols-1 sm:grid-cols-3 gap-6">
                                                <div
                                                    class="p-6 rounded-3xl bg-indigo-50/30 border border-indigo-100/50 hover:shadow-lg transition-all duration-300">
                                                    <div
                                                        class="text-[9px] font-black text-indigo-400 uppercase tracking-[0.2em] mb-2">
                                                        Workspace status</div>
                                                    <div class="flex items-center gap-2">
                                                        <div class="h-2 w-2 rounded-full bg-indigo-600 animate-pulse">
                                                        </div>
                                                        <div
                                                            class="text-[11px] font-black text-slate-700 uppercase tracking-widest">
                                                            Active Simulation</div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="p-6 rounded-3xl bg-emerald-50/30 border border-emerald-100/50 hover:shadow-lg transition-all duration-300">
                                                    <div
                                                        class="text-[9px] font-black text-emerald-400 uppercase tracking-[0.2em] mb-2">
                                                        Authority Level</div>
                                                    <div
                                                        class="text-[11px] font-black text-slate-700 uppercase tracking-widest">
                                                        Enterprise Elite</div>
                                                </div>
                                                <div
                                                    class="p-6 rounded-3xl bg-slate-50 border border-slate-100 hover:shadow-lg transition-all duration-300">
                                                    <div
                                                        class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2">
                                                        Next Audit Cycle</div>
                                                    <div
                                                        class="text-[11px] font-black text-slate-700 uppercase tracking-widest">
                                                        May 20, 2026</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Portal Snapshots -->
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">
                                        <div
                                            class="bg-slate-900 rounded-[2.5rem] border-none shadow-2xl p-10 text-white relative overflow-hidden group">
                                            <div
                                                class="absolute top-0 right-0 w-48 h-48 bg-indigo-500/20 rounded-full blur-3xl -mr-24 -mt-24 group-hover:scale-150 transition-transform duration-1000">
                                            </div>
                                            <div class="relative">
                                                <h4
                                                    class="text-[10px] font-black text-indigo-300 uppercase tracking-[0.25em] mb-8">
                                                    Staff Performance Log</h4>
                                                <div class="flex items-end gap-3 mb-2">
                                                    <div class="text-6xl font-black tracking-tight leading-none">1,248
                                                    </div>
                                                    <div
                                                        class="text-indigo-400 font-bold text-xs mb-1 uppercase tracking-widest">
                                                        Pulses</div>
                                                </div>
                                                <p class="text-xs font-bold text-slate-500 uppercase tracking-widest">
                                                    Total Staff Operations Tracked</p>
                                                <button
                                                    class="mt-10 inline-flex items-center gap-3 px-6 py-3 rounded-2xl bg-indigo-600 text-[10px] font-black text-white hover:bg-white hover:text-slate-900 transition-all uppercase tracking-widest shadow-xl">
                                                    Open Intelligence Portal
                                                    <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                        <div
                                            class="bg-white rounded-[2.5rem] border border-slate-100 shadow-2xl p-10 relative overflow-hidden group">
                                            <div
                                                class="absolute top-0 right-0 w-48 h-48 bg-amber-500/10 rounded-full blur-3xl -mr-24 -mt-24 group-hover:scale-150 transition-transform duration-1000">
                                            </div>
                                            <div class="relative">
                                                <h4
                                                    class="text-[10px] font-black text-slate-400 uppercase tracking-[0.25em] mb-8">
                                                    Admin Sovereignty Log</h4>
                                                <div class="flex items-end gap-3 mb-2">
                                                    <div
                                                        class="text-6xl font-black text-slate-900 tracking-tight leading-none">
                                                        842</div>
                                                    <div
                                                        class="text-slate-400 font-bold text-xs mb-1 uppercase tracking-widest">
                                                        Audits</div>
                                                </div>
                                                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">
                                                    Sensitive Authority Actions</p>
                                                <button
                                                    class="mt-10 inline-flex items-center gap-3 px-6 py-3 rounded-2xl bg-amber-500 text-[10px] font-black text-white hover:bg-slate-900 transition-all uppercase tracking-widest shadow-xl">
                                                    Audit Secure Feeds
                                                    <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div x-show="activeSettings === 'staff-logs'"
                                    x-transition:enter="transition-opacity duration-300">
                                    <div class="mb-8">
                                        <h3 class="text-2xl font-black text-slate-900 tracking-tight uppercase">Staff
                                            Intelligence Stream</h3>
                                        <p class="text-slate-500 text-[10px] font-bold uppercase tracking-widest mt-1">
                                            Real-time pulses from the operational frontline</p>
                                    </div>

                                    <div
                                        class="relative space-y-8 before:absolute before:inset-0 before:ml-5 before:-translate-x-px md:before:mx-auto md:before:translate-x-0 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-indigo-500 before:via-slate-200 before:to-transparent">
                                        <template x-for="(log, index) in [
                                            { action: 'created', time: '2m ago', user: 'Sameer Abbasi', desc: 'Added new client: Rahul Khanna', ip: '102.16.8.1' },
                                            { action: 'updated', time: '15m ago', user: 'Kavita Mishra', desc: 'Refined policy NX-9012 premium terms', ip: '102.16.8.12' },
                                            { action: 'login', time: '45m ago', user: 'Sameer Abbasi', desc: 'System authentication established', ip: '102.16.8.1' },
                                            { action: 'deleted', time: '2h ago', user: 'System', desc: 'Purged temporary cache logs', ip: '127.0.0.1' }
                                        ]">
                                            <div
                                                class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group">
                                                <div class="flex items-center justify-center w-10 h-10 rounded-full border-4 border-white bg-slate-100 text-slate-900 shadow-xl shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 transition-all duration-500 group-hover:scale-125 z-10"
                                                    :class="log.action === 'created' ? 'bg-indigo-600 text-white' : (log.action === 'updated' ? 'bg-amber-500 text-white' : (log.action === 'deleted' ? 'bg-slate-900 text-white' : 'bg-slate-200 text-slate-600'))">
                                                    <svg x-show="log.action === 'created'" class="h-4 w-4" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M12 4v16m8-8H4" />
                                                    </svg>
                                                    <svg x-show="log.action === 'updated'" class="h-4 w-4" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                    <svg x-show="log.action === 'deleted'" class="h-4 w-4" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                    <svg x-show="log.action === 'login'" class="h-4 w-4" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                                    </svg>
                                                </div>

                                                <div
                                                    class="w-[calc(100%-4rem)] md:w-[calc(50%-2.5rem)] p-6 rounded-[2.5rem] bg-white border border-slate-100 shadow-xl hover:shadow-2xl hover:-translate-y-1 transition-all duration-500 overflow-hidden relative group/card">
                                                    <div
                                                        class="absolute top-0 right-0 w-24 h-24 bg-slate-50 rounded-full blur-2xl -mr-12 -mt-12 transition-colors group-hover/card:bg-indigo-50">
                                                    </div>
                                                    <div class="relative">
                                                        <div class="flex items-center justify-between mb-4">
                                                            <time
                                                                class="font-black text-[9px] text-indigo-500 uppercase tracking-[0.2em]"
                                                                x-text="log.time"></time>
                                                            <span
                                                                class="text-[8px] font-black uppercase tracking-[0.2em] px-2.5 py-1 rounded-full bg-slate-100 text-slate-600"
                                                                x-text="log.action"></span>
                                                        </div>
                                                        <div class="flex items-start gap-4">
                                                            <div class="h-9 w-9 rounded-xl bg-slate-900 text-white flex items-center justify-center font-black text-[10px] uppercase shadow-lg group-hover/card:scale-110 transition-transform"
                                                                x-text="log.user.charAt(0)"></div>
                                                            <div class="flex-1 min-w-0">
                                                                <div class="text-xs font-black text-slate-900 tracking-tight"
                                                                    x-text="log.user"></div>
                                                                <div class="text-[10px] font-bold text-slate-400 uppercase mt-0.5"
                                                                    x-text="log.desc"></div>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="mt-4 pt-4 border-t border-slate-50 flex items-center justify-between">
                                                            <div class="text-[9px] font-bold text-slate-300 font-mono"
                                                                x-text="log.ip"></div>
                                                            <div
                                                                class="text-[8px] font-black text-slate-200 uppercase tracking-widest">
                                                                SECURE STREAM</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </div>

                                <div x-show="activeSettings === 'admin-logs'"
                                    x-transition:enter="transition-opacity duration-300">
                                    <div class="mb-8">
                                        <h3 class="text-2xl font-black text-slate-900 tracking-tight uppercase">Admin
                                            Sovereignty Stream</h3>
                                        <p class="text-slate-500 text-[10px] font-bold uppercase tracking-widest mt-1">
                                            Audit logs for high-authority system overrides</p>
                                    </div>

                                    <div
                                        class="relative space-y-8 before:absolute before:inset-0 before:ml-5 before:-translate-x-px md:before:mx-auto md:before:translate-x-0 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-amber-500 before:via-slate-200 before:to-transparent">
                                        <template x-for="(log, index) in [
                                            { action: 'override', time: '15m ago', user: 'Admin Shivam', desc: 'Permission override for Policy Claims module', ip: '192.168.1.1' },
                                            { action: 'audit', time: '1h ago', user: 'Admin Shivam', desc: 'Full system audit cycle initiated', ip: '192.168.1.1' }
                                        ]">
                                            <div
                                                class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group">
                                                <div
                                                    class="flex items-center justify-center w-10 h-10 rounded-full border-4 border-white bg-amber-500 text-white shadow-xl shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 transition-all duration-500 group-hover:scale-125 z-10">
                                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                                    </svg>
                                                </div>

                                                <div
                                                    class="w-[calc(100%-4rem)] md:w-[calc(50%-2.5rem)] p-6 rounded-[2.5rem] bg-white border border-slate-100 shadow-xl hover:shadow-2xl hover:-translate-y-1 transition-all duration-500 overflow-hidden relative group/card">
                                                    <div
                                                        class="absolute top-0 right-0 w-24 h-24 bg-amber-50 rounded-full blur-2xl -mr-12 -mt-12 transition-colors group-hover/card:bg-amber-100/50">
                                                    </div>
                                                    <div class="relative">
                                                        <div class="flex items-center justify-between mb-4">
                                                            <time
                                                                class="font-black text-[9px] text-amber-600 uppercase tracking-[0.2em]"
                                                                x-text="log.time"></time>
                                                            <span
                                                                class="text-[8px] font-black uppercase tracking-[0.2em] px-2.5 py-1 rounded-full bg-amber-50 text-amber-700"
                                                                x-text="log.action"></span>
                                                        </div>
                                                        <div class="flex items-start gap-4">
                                                            <div class="h-9 w-9 rounded-xl bg-slate-900 text-white flex items-center justify-center font-black text-[10px] uppercase shadow-lg group-hover/card:scale-110 transition-transform"
                                                                x-text="log.user.charAt(0)"></div>
                                                            <div class="flex-1 min-w-0">
                                                                <div class="text-xs font-black text-slate-900 tracking-tight"
                                                                    x-text="log.user"></div>
                                                                <div class="text-[10px] font-bold text-slate-400 uppercase mt-0.5"
                                                                    x-text="log.desc"></div>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="mt-4 pt-4 border-t border-slate-50 flex items-center justify-between">
                                                            <div class="text-[9px] font-bold text-slate-300 font-mono"
                                                                x-text="log.ip"></div>
                                                            <div
                                                                class="text-[8px] font-black text-slate-200 uppercase tracking-widest">
                                                                ADMIN SECURE</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </div>

                                <div x-show="activeSettings === 'profile'"
                                    x-transition:enter="transition-opacity duration-300" class="space-y-8">
                                    <!-- Profile Identity Card (Production Replica) -->
                                    <div
                                        class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl p-10 relative overflow-hidden group">
                                        <section>
                                            <header class="flex items-center gap-4 mb-10">
                                                <div
                                                    class="h-12 w-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center shadow-sm">
                                                    <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                    </svg>
                                                </div>
                                                <div>
                                                    <h2
                                                        class="text-2xl font-black text-slate-900 uppercase tracking-tight">
                                                        Profile Identity</h2>
                                                    <p
                                                        class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mt-0.5">
                                                        Manage your personal presence and contact info</p>
                                                </div>
                                            </header>

                                            <div class="space-y-8">
                                                <!-- Profile Photo (Production Replica) -->
                                                <div
                                                    class="flex items-center gap-8 p-6 rounded-2xl bg-slate-50/50 border border-slate-100">
                                                    <div class="relative group cursor-pointer">
                                                        <div
                                                            class="h-24 w-24 rounded-3xl p-1 bg-gradient-to-br from-indigo-500 to-purple-600 shadow-xl overflow-hidden relative">
                                                            <div
                                                                class="h-full w-full rounded-[20px] bg-white flex items-center justify-center overflow-hidden">
                                                                <span
                                                                    class="text-3xl font-black text-indigo-600 uppercase"
                                                                    x-text="user.name.charAt(0)"></span>
                                                            </div>
                                                            <div
                                                                class="absolute inset-0 bg-indigo-600/60 rounded-3xl flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                                                <svg class="h-8 w-8 text-white" fill="none"
                                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                                                </svg>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <h3
                                                            class="text-sm font-black text-slate-800 uppercase tracking-wider mb-1">
                                                            Profile Picture</h3>
                                                        <p
                                                            class="text-xs font-bold text-slate-400 mb-4 leading-relaxed max-w-[200px]">
                                                            Update your photo to make your account more recognizable.
                                                        </p>
                                                        <button
                                                            class="text-xs font-black uppercase text-indigo-600 hover:text-indigo-800 transition-colors">Click
                                                            to Upload</button>
                                                    </div>
                                                </div>

                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-10 pt-4 items-start">
                                                    <div>
                                                        <label
                                                            class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1 mb-2 block">Full
                                                            Legal Name</label>
                                                        <input type="text" x-model="user.name"
                                                            class="w-full px-6 py-4 bg-slate-50 rounded-[1.5rem] border border-slate-100 text-slate-900 font-black text-lg focus:bg-white focus:ring-4 focus:ring-indigo-500/10 transition-all placeholder:text-slate-300">
                                                    </div>
                                                    <div>
                                                        <label
                                                            class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1 mb-2 block">Verified
                                                            Email</label>
                                                        <input type="email" value="shivam.systems@nexorabyte.com"
                                                            class="w-full px-6 py-4 bg-slate-50 rounded-[1.5rem] border border-slate-100 text-slate-900 font-black text-lg focus:bg-white focus:ring-4 focus:ring-indigo-500/10 transition-all placeholder:text-slate-300">
                                                    </div>
                                                </div>

                                                <div
                                                    class="flex items-center gap-4 pt-8 border-t border-slate-50 justify-start">
                                                    <button
                                                        class="inline-flex items-center gap-2 px-8 py-4 rounded-2xl bg-indigo-600 text-xs font-black text-white hover:bg-indigo-700 hover:shadow-lg transition-all uppercase tracking-widest w-full justify-center md:w-auto">
                                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                                            stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M5 13l4 4L19 7" />
                                                        </svg>
                                                        Update Profile Identity
                                                    </button>
                                                </div>
                                            </div>
                                        </section>
                                    </div>

                                    <!-- Security & Password Card (Production Replica) -->
                                    <div
                                        class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl p-10 relative overflow-hidden group">
                                        <section>
                                            <header class="flex items-center gap-4 mb-10">
                                                <div
                                                    class="h-12 w-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center shadow-sm">
                                                    <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 00-2 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                                    </svg>
                                                </div>
                                                <div>
                                                    <h2
                                                        class="text-2xl font-black text-slate-900 uppercase tracking-tight">
                                                        Security & Password</h2>
                                                    <p
                                                        class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mt-0.5">
                                                        Ensure your account is using a long, random password.</p>
                                                </div>
                                            </header>

                                            <div class="grid grid-cols-1 gap-6">
                                                <div>
                                                    <label
                                                        class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1 mb-2 block">Current
                                                        Password</label>
                                                    <input type="password" value="••••••••"
                                                        class="w-full px-6 py-4 bg-slate-50 rounded-[1.5rem] border border-slate-100 text-slate-900 font-black text-lg focus:bg-white focus:ring-4 focus:ring-indigo-500/10 transition-all">
                                                </div>
                                                <div>
                                                    <label
                                                        class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1 mb-2 block">New
                                                        Password</label>
                                                    <input type="password"
                                                        class="w-full px-6 py-4 bg-slate-50 rounded-[1.5rem] border border-slate-100 text-slate-900 font-black text-lg focus:bg-white focus:ring-4 focus:ring-indigo-500/10 transition-all">
                                                </div>
                                                <div>
                                                    <label
                                                        class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1 mb-2 block">Confirm
                                                        Password</label>
                                                    <input type="password"
                                                        class="w-full px-6 py-4 bg-slate-50 rounded-[1.5rem] border border-slate-100 text-slate-900 font-black text-lg focus:bg-white focus:ring-4 focus:ring-indigo-500/10 transition-all">
                                                </div>
                                            </div>

                                            <div
                                                class="flex items-center gap-4 pt-8 border-t border-slate-50 justify-start mt-8">
                                                <button
                                                    class="inline-flex items-center gap-2 px-8 py-4 rounded-2xl bg-indigo-600 text-xs font-black text-white hover:bg-indigo-700 hover:shadow-lg transition-all uppercase tracking-widest w-full justify-center md:w-auto">
                                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 00-2 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                                    </svg>
                                                    Update Security
                                                </button>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                </main>
            </div>
        </div>
    </section>

    <!-- Operational Workflow -->
    <section class="py-32 px-8 bg-slate-50">
        <div class="max-w-5xl mx-auto">
            <div class="text-center mb-20 animate-fade-in-up">
                <h2 class="text-4xl font-black text-slate-900 mb-6">Built for Success.</h2>
                <p class="text-slate-600 font-medium">How the engine transforms your daily operations.</p>
            </div>
            <div class="relative space-y-12">
                <div class="absolute left-8 top-0 bottom-0 w-px bg-slate-200 hidden md:block"></div>

                <!-- Step 1 -->
                <div class="relative flex flex-col md:flex-row gap-10 items-start group">
                    <div
                        class="w-16 h-16 rounded-full bg-white border border-slate-200 flex items-center justify-center text-xl font-black text-indigo-600 z-10 group-hover:scale-110 group-hover:border-indigo-300 group-hover:bg-indigo-50 transition-all duration-500 float-anim">
                        01</div>
                    <div class="flex-1 pt-3">
                        <h5 class="text-xl font-black text-slate-900 mb-3 uppercase tracking-tight">Onboard &
                            Intelligence Injection</h5>
                        <p class="text-slate-600 text-sm leading-relaxed font-medium">Import your existing client base
                            instantly. The engine immediately analyzes your portfolio, identifying high-priority
                            renewals and upcoming milestones within minutes.</p>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="relative flex flex-col md:flex-row gap-10 items-start group">
                    <div
                        class="w-16 h-16 rounded-full bg-white border border-slate-200 flex items-center justify-center text-xl font-black text-indigo-600 z-10 group-hover:scale-110 group-hover:border-indigo-300 group-hover:bg-indigo-50 transition-all duration-500 float-anim [animation-delay:1s]">
                        02</div>
                    <div class="flex-1 pt-3">
                        <h5 class="text-xl font-black text-slate-900 mb-3 uppercase tracking-tight">Automated Engagement
                            Pipeline</h5>
                        <p class="text-slate-600 text-sm leading-relaxed font-medium">The CRM starts working for you.
                            Automated birthday wishes and anniversary greetings are staged, and renewal reminders are
                            sent to ensure 100% retention rate.</p>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="relative flex flex-col md:flex-row gap-10 items-start group">
                    <div
                        class="w-16 h-16 rounded-full bg-white border border-slate-200 flex items-center justify-center text-xl font-black text-indigo-600 z-10 group-hover:scale-110 group-hover:border-indigo-300 group-hover:bg-indigo-50 transition-all duration-500 float-anim [animation-delay:2s]">
                        03</div>
                    <div class="flex-1 pt-3">
                        <h5 class="text-xl font-black text-slate-900 mb-3 uppercase tracking-tight">Revenue & Growth
                            Analytics</h5>
                        <p class="text-slate-600 text-sm leading-relaxed font-medium">Visualize your upcoming year. Use
                            our forecasting tools to see expected commissions and set growth targets based on actual
                            policy data, not guesses.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section (Transplanted) -->
    <section id="pricing" class="py-32 px-8 border-y border-slate-100">
        <div class="max-w-7xl mx-auto text-center" x-data="erpCheckout">
            <h2 class="text-4xl font-extrabold text-slate-900 mb-12 uppercase tracking-tight">Subscription Models</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                <!-- Trial -->
                <div
                    class="crystal-card p-10 rounded-[3.5rem] relative flex flex-col justify-between overflow-hidden shadow-xl hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
                    <div>
                        <h3
                            class="text-xl font-black text-slate-900 uppercase tracking-widest mb-6 border-b border-slate-100 pb-4">
                            30-Day Trial</h3>
                        <div class="text-4xl font-black text-indigo-600 mb-8">₹1 <span
                                class="text-xs text-slate-500 font-medium text-slate-400">one-time</span></div>
                        <ul class="text-left space-y-4 mb-8 text-sm font-medium text-slate-700">
                            <li class="flex items-center gap-3">✓ Full Module Access</li>
                            <li class="flex items-center gap-3">✓ Multi-User Sync</li>
                            <li class="flex items-center gap-3 text-slate-400">✕ No Renewal</li>
                        </ul>
                    </div>
                    <button @click="pay('trial')" :disabled="loadingPlan !== null"
                        class="elite-btn bg-indigo-600 text-white py-4 rounded-2xl font-black uppercase tracking-widest text-[10px] shadow-lg shadow-indigo-200">
                        <span x-show="loadingPlan !== 'trial'">Try For ₹1</span>
                        <span x-show="loadingPlan === 'trial'" class="animate-pulse">Activating...</span>
                    </button>
                </div>
                <!-- Starter -->
                <div
                    class="crystal-card p-10 rounded-[3.5rem] relative flex flex-col justify-between overflow-hidden shadow-xl hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
                    <div class="absolute -right-20 -top-20 w-64 h-64 bg-indigo-500/5 rounded-full blur-[100px]"></div>
                    <div>
                        <h3
                            class="text-xl font-black text-slate-900 uppercase tracking-widest mb-6 border-b border-slate-100 pb-4">
                            Monthly Pro Plan</h3>
                        <div class="text-4xl font-black text-indigo-600 mb-8">₹1,999 <span
                                class="text-xs text-slate-500 font-medium">/mo</span></div>
                        <ul class="text-left space-y-4 mb-8 text-sm font-medium text-slate-700">
                            <li class="flex items-center gap-3">✓ Unlimited Clients</li>
                            <li class="flex items-center gap-3">✓ Priority Support</li>
                            <li class="flex items-center gap-3">✓ Renewable Monthly</li>
                        </ul>
                    </div>
                    <button @click="pay('monthly')" :disabled="loadingPlan !== null"
                        class="elite-btn bg-indigo-600 text-white py-4 rounded-2xl font-black uppercase tracking-widest text-[10px] shadow-lg shadow-indigo-200">
                        <span x-show="loadingPlan !== 'monthly'">Pay ₹1,999/mo</span>
                        <span x-show="loadingPlan === 'monthly'" class="animate-pulse">Processing...</span>
                    </button>
                </div>
                <!-- Yearly Elite -->
                <div
                    class="crystal-card p-10 rounded-[3.5rem] relative flex flex-col justify-between overflow-hidden shadow-xl hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 flagship-card border-2 border-indigo-200">
                    <div class="absolute top-0 right-0">
                        <div class="bg-gradient-to-l from-rose-600 to-pink-500 text-white text-[9px] font-black uppercase tracking-[0.2em] px-6 py-2 rounded-bl-3xl shadow-lg animate-pulse">
                            Founder's Sale
                        </div>
                    </div>
                    <div class="absolute -right-20 -top-20 w-64 h-64 bg-amber-500/5 rounded-full blur-[100px]"></div>
                    <div>
                        <div class="flex items-center justify-between mb-6 border-b border-slate-100 pb-4">
                            <h3 class="text-xl font-black text-slate-900 uppercase tracking-widest">Founder's Elite</h3>
                            <span class="bg-indigo-50 text-indigo-600 text-[8px] font-black px-3 py-1 rounded-full uppercase tracking-widest">Flagship Choice</span>
                        </div>
                        <div class="flex items-baseline gap-3 mb-2">
                            <div class="text-4xl font-black text-indigo-600">₹14,999 <span class="text-xs text-slate-500 font-medium">/yr</span></div>
                            <div class="text-sm text-slate-400 line-through font-bold">₹17,999</div>
                        </div>
                        <div class="text-[10px] font-black text-rose-600 uppercase tracking-widest mb-8 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-rose-500 animate-ping"></span>
                            Founder's Discount — First 50 Users Only
                        </div>
                        <ul class="text-left space-y-4 mb-8 text-sm font-medium text-slate-700">
                            <li class="flex items-center gap-3">✓ Everything in Pro</li>
                            <li class="flex items-center gap-3">✓ Dedicated Manager</li>
                            <li class="flex items-center gap-3 text-indigo-600">✓ VIP Priority Access</li>
                            <li class="flex items-center gap-3">✓ Best Value Savings</li>
                        </ul>
                    </div>
                    <button @click="pay('yearly')" :disabled="loadingPlan !== null"
                        class="elite-btn bg-indigo-600 text-white py-4 rounded-2xl font-black uppercase tracking-widest text-[10px] shadow-lg shadow-indigo-200">
                        <span x-show="loadingPlan !== 'yearly'">Claim ₹14,999/yr Offer</span>
                        <span x-show="loadingPlan === 'yearly'" class="animate-pulse">Processing...</span>
                    </button>
                </div>
            </div>
        </div>
    </section>
    </main>

    <footer x-data="{}" class="py-20 border-t border-white/5 bg-[#0f111a] relative overflow-hidden">
        <!-- Footer Aurora Glow -->
        <div
            class="absolute -bottom-48 left-1/2 -translate-x-1/2 w-full h-96 bg-indigo-500/10 blur-[120px] rounded-full">
        </div>

        <div class="max-w-7xl mx-auto px-8 relative z-10">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-12 lg:gap-8 mb-16">
                <div class="col-span-2 md:col-span-2">
                    <div class="flex items-center gap-4 mb-6">
                        <img src="{{ asset('images/company_logo.jpg') }}" alt="nexorabyte"
                            class="h-10 w-auto object-contain"
                            style="filter: url(#chroma-key-black) contrast(1.1) brightness(1.2);">
                        <span
                            class="text-xl font-black text-white tracking-[0.2em]">nexorabyte</span>
                    </div>
                    <p class="text-slate-400 text-sm leading-relaxed max-sm mb-8 font-medium">
                        Architecting the digital backbone of the modern enterprise through bespoke ERP logic, elite
                        engineering, and immutable security.
                    </p>
                </div>

                <div>
                    <h5 class="text-white font-black tracking-[0.3em] uppercase text-[10px] mb-6">Our Services</h5>
                    <ul class="space-y-4">
                        <li><a href="{{ route('services.web-development') }}"
                                class="text-slate-500 text-sm hover:text-indigo-500 transition-all hover:pl-2">Customized
                                Websites</a></li>
                        <li><a href="{{ route('services.insurance-erp') }}"
                                class="text-slate-500 text-sm hover:text-indigo-500 transition-all hover:pl-2">Insurance
                                ERP Systems</a></li>
                    </ul>
                </div>

                <div>
                    <h5 class="text-white font-black tracking-[0.3em] uppercase text-[10px] mb-6">Studio</h5>
                    <ul class="space-y-4">
                        <li><a href="{{ route('about') }}"
                                class="text-slate-500 text-sm hover:text-indigo-500 transition-all hover:pl-2">About
                                Us</a></li>
                        <li><a href="{{ route('lifecycle') }}"
                                class="text-slate-500 text-sm hover:text-indigo-500 transition-all hover:pl-2">Our
                                Lifecycle</a></li>
                        <li><a href="{{ route('contact') }}"
                                class="text-slate-500 text-sm hover:text-indigo-500 transition-all hover:pl-2">Contact Us</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="pt-8 border-t border-white/5 flex flex-col md:flex-row items-center justify-between gap-6">
                <p class="text-[9px] font-black tracking-[0.3em] text-slate-600 uppercase">&copy; {{ date('Y') }}
                    nexorabyte. ARCHITECTING EXCELLENCE.</p>
                <div class="flex gap-8">
                    <a href="{{ route('terms') }}"
                        class="text-[9px] font-black uppercase tracking-[0.3em] text-slate-600 hover:text-white transition-colors">Terms & conditions</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('simulationDashboard', () => ({
                isLoaded: false,
                activeTab: 'dashboard',
                user: {
                    name: 'Shivam Sharma',
                    role: 'Systems Admin',
                    avatar: null
                },
                workspace: {
                    name: 'NexoraByte Insurance Solution',
                    logo: null
                },
                claims: [
                    { id: 1, client_name: 'Sameer Sen', policy_number: 'POL-HB-9912', policy_type: 'health', claim_amount: 125000, incident_date: '2024-04-10', status: 'approved' },
                    { id: 2, client_name: 'Mona Rae', policy_number: 'POL-MT-4421', policy_type: 'motor', claim_amount: 42000, incident_date: '2024-04-12', status: 'pending' },
                    { id: 3, client_name: 'Anita Sharma', policy_number: 'POL-LF-8821', policy_type: 'life', claim_amount: 500000, incident_date: '2024-03-25', status: 'submitted' },
                    { id: 4, client_name: 'Rajesh Kumar', policy_number: 'POL-HB-1122', policy_type: 'health', claim_amount: 15000, incident_date: '2024-04-15', status: 'rejected' }
                ],
                claimStats: { total: 42, submitted: 12, pending: 8, approved: 18, rejected: 4 },
                clients: [
                    { id: 1, name: 'Amitabh Patel', email: 'amitabh.p@gmail.com', phone: '+91 98765 43210', dob: '1985-05-15', gender: 'Male', marriage_anniversary: '2010-11-20', address: 'J-204, Skyline Towers, Sector 45, Gurgaon', photo: null },
                    { id: 2, name: 'Sanjana Roy', email: 'sanjana.roy@outlook.com', phone: '+91 98221 00982', dob: '1992-08-22', gender: 'Female', marriage_anniversary: '2018-02-14', address: 'Flat 42, Green Meadows Apartment, Vasant Kunj, Delhi', photo: null },
                    { id: 3, name: 'Rohan Sharma', email: 'rohan.s@example.com', phone: '+91 70021 99812', dob: '1988-12-05', gender: 'Male', marriage_anniversary: null, address: 'House No. 12, Sector 15-A, Chandigarh', photo: null }
                ],
                queries: [
                    { id: 1, subject: 'Claim Status Inquiry', description: 'Regarding medical claim #CL-9912 settlement status.', priority: 'high', status: 'pending', client_name: 'Sameer Sen', created_at: '2024-04-20', document: true },
                    { id: 2, subject: 'Policy Addition Request', description: 'Interested in adding Motor insurance to current Health plan.', priority: 'medium', status: 'approved', client_name: 'Mona Rae', created_at: '2024-04-18', document: false }
                ],
                queryStats: { total: 156, approved: 112, pending: 32, rejected: 12 },
                renewals: [
                    { id: 1, client_name: 'Amitabh Patel', policy_number: 'NX-9012', policy_type: 'life', premium_amount: 12400.50, expiry_date: '2024-10-12', status: 'pending' },
                    { id: 2, client_name: 'Sanjana Roy', policy_number: 'NX-9013', policy_type: 'health', premium_amount: 8500.00, expiry_date: '2024-11-05', status: 'renewed' }
                ],
                renewalStats: { total: 842, pending: 156, renewed: 642, lapsed: 44, upcoming: 12 },
                staffMembers: [
                    { id: 1, name: 'Sameer Abbasi', email: 'sameer.a@nexorabyte.com', phone: '+91 91123 44556', designation: 'Lead Architect', status: 'active' },
                    { id: 2, name: 'Kavita Mishra', email: 'kavita.m@nexorabyte.com', phone: '+91 90088 77665', designation: 'Strategic Lead', status: 'active' }
                ],
                commissionLedger: [
                    { id: 1, client_name: 'Amitabh Patel', policy_number: 'NX-9012', provider: 'LIC INDIA', expected_amount: 1240.00, received_amount: 1240.00, status: 'received', received_at: '2024-04-10' },
                    { id: 2, client_name: 'Sanjana Roy', policy_number: 'NX-9013', provider: 'HDFC ERGO', expected_amount: 850.00, received_amount: 0, status: 'pending', received_at: null }
                ],
                commStats: { total_pending: 124500.00, total_received_month: 98000.00, pending_count: 85 },
                trashTab: 'clients',
                deletedItems: {
                    clients: [{ id: 101, name: 'Rahul Khanna', email: 'rahul.k@example.com', deleted_at: '2024-04-15 11:20 AM' }],
                    queries: [{ id: 201, subject: 'Payment Glitch Report', client_name: 'Amit Vyas', deleted_at: '2024-04-14 02:45 PM' }],
                    claims: [{ id: 301, policy_number: 'POL-HB-4412', client_name: 'Suresh Raina', deleted_at: '2024-04-12 09:15 AM' }],
                    renewals: [{ id: 401, policy_number: 'NX-7712', client_name: 'Priya Joshi', deleted_at: '2024-04-10 04:30 PM' }],
                    staff: [{ id: 501, name: 'Vikram Singh', designation: 'Junior Agent', deleted_at: '2024-04-05 10:00 AM' }]
                },
                init() {
                    setTimeout(() => {
                        this.isLoaded = true;
                    }, 500);
                    this.$nextTick(() => {
                        this.initCharts();
                    });
                    this.$watch('activeTab', () => {
                        this.$nextTick(() => this.initCharts());
                    });
                },
                initCharts() {
                    const charts = ['demoQueryPulseChart', 'demoClaimPulseChart', 'demoRevenueForecastChart'];
                    charts.forEach(id => {
                        const ctx = document.getElementById(id);
                        if (!ctx) return;

                        // Check if chart already exists and destroy it
                        const existingChart = Chart.getChart(id);
                        if (existingChart) existingChart.destroy();

                        if (id === 'demoQueryPulseChart') {
                            const gradient = ctx.getContext('2d').createLinearGradient(0, 0, 0, 200);
                            gradient.addColorStop(0, 'rgba(244, 63, 94, 0.2)');
                            gradient.addColorStop(1, 'rgba(244, 63, 94, 0)');

                            new Chart(ctx, {
                                type: 'line',
                                data: {
                                    labels: ['Apr 14', 'Apr 15', 'Apr 16', 'Apr 17', 'Apr 18', 'Apr 19', 'Apr 20'],
                                    datasets: [{
                                        label: 'Queries',
                                        data: [5, 8, 4, 10, 12, 7, 12],
                                        borderColor: '#f43f5e',
                                        backgroundColor: gradient,
                                        borderWidth: 4,
                                        pointBackgroundColor: '#f43f5e',
                                        pointBorderColor: '#fff',
                                        pointHoverRadius: 8,
                                        tension: 0.4,
                                        fill: true
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    maintainAspectRatio: false,
                                    plugins: {
                                        legend: { display: false },
                                        tooltip: {
                                            backgroundColor: '#0f172a',
                                            titleFont: { size: 14, weight: '900' },
                                            bodyFont: { size: 13, weight: '700' },
                                            padding: 16,
                                            cornerRadius: 16
                                        }
                                    },
                                    scales: {
                                        y: { beginAtZero: true, suggestedMax: 15, grid: { color: 'rgba(148, 163, 184, 0.1)', drawBorder: false }, ticks: { color: '#94a3b8', font: { size: 10, weight: '700' } } },
                                        x: { grid: { display: false }, ticks: { color: '#94a3b8', font: { size: 10, weight: '700' } } }
                                    }
                                }
                            });
                        }

                        if (id === 'demoClaimPulseChart') {
                            const gradient = ctx.getContext('2d').createLinearGradient(0, 0, 0, 200);
                            gradient.addColorStop(0, 'rgba(245, 158, 11, 0.2)');
                            gradient.addColorStop(1, 'rgba(245, 158, 11, 0)');

                            new Chart(ctx, {
                                type: 'line',
                                data: {
                                    labels: ['Apr 14', 'Apr 15', 'Apr 16', 'Apr 17', 'Apr 18', 'Apr 19', 'Apr 20'],
                                    datasets: [{
                                        label: 'Claims',
                                        data: [2, 5, 3, 8, 4, 6, 8],
                                        borderColor: '#f59e0b',
                                        backgroundColor: gradient,
                                        borderWidth: 4,
                                        pointBackgroundColor: '#f59e0b',
                                        pointBorderColor: '#fff',
                                        pointHoverRadius: 8,
                                        tension: 0.4,
                                        fill: true
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    maintainAspectRatio: false,
                                    plugins: {
                                        legend: { display: false },
                                        tooltip: {
                                            backgroundColor: '#0f172a',
                                            titleFont: { size: 14, weight: '900' },
                                            bodyFont: { size: 13, weight: '700' },
                                            padding: 16,
                                            cornerRadius: 16
                                        }
                                    },
                                    scales: {
                                        y: { beginAtZero: true, suggestedMax: 10, grid: { color: 'rgba(148, 163, 184, 0.1)', drawBorder: false }, ticks: { color: '#94a3b8', font: { size: 10, weight: '700' } } },
                                        x: { grid: { display: false }, ticks: { color: '#94a3b8', font: { size: 10, weight: '700' } } }
                                    }
                                }
                            });
                        }

                        if (id === 'demoRevenueForecastChart') {
                            const gradient = ctx.getContext('2d').createLinearGradient(0, 0, 0, 400);
                            gradient.addColorStop(0, 'rgba(16, 185, 129, 0.2)');
                            gradient.addColorStop(1, 'rgba(16, 185, 129, 0)');

                            new Chart(ctx, {
                                type: 'line',
                                data: {
                                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                                    datasets: [{
                                        label: 'Expected Commission',
                                        data: [850000, 920000, 880000, 1050000, 1120000, 980000, 1150000, 1240000, 1180000, 1320000, 1450000, 1580000],
                                        borderColor: '#10b981',
                                        backgroundColor: gradient,
                                        borderWidth: 4,
                                        pointBackgroundColor: '#10b981',
                                        pointBorderColor: '#fff',
                                        pointHoverRadius: 6,
                                        pointRadius: 4,
                                        tension: 0.35,
                                        fill: true
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    maintainAspectRatio: false,
                                    plugins: {
                                        legend: { display: false },
                                        tooltip: {
                                            backgroundColor: '#0f172a',
                                            titleFont: { size: 12, weight: '900' },
                                            bodyFont: { size: 11, weight: '700' },
                                            padding: 12,
                                            cornerRadius: 12,
                                            displayColors: false,
                                            callbacks: {
                                                label: function (context) { return '₹' + context.parsed.y.toLocaleString(); }
                                            }
                                        }
                                    },
                                    scales: {
                                        y: {
                                            beginAtZero: true,
                                            grid: { color: 'rgba(0,0,0,0.03)', drawBorder: false },
                                            ticks: {
                                                color: '#94a3b8',
                                                font: { size: 10, weight: '700' },
                                                callback: function (value) { return '₹' + (value / 100000) + 'L'; }
                                            }
                                        },
                                        x: { grid: { display: false }, ticks: { color: '#94a3b8', font: { size: 10, weight: '700' } } }
                                    }
                                }
                            });
                        }
                    });
                }
            }));

            Alpine.data('erpCheckout', () => ({
                loadingPlan: null,
                async pay(plan) {
                    this.loadingPlan = plan;
                    const isAuthenticated = @json(auth()->check());
                    try {
                        const endpoint = isAuthenticated ? '/billing/checkout' : '/get-started/checkout';
                        const verifyEndpoint = isAuthenticated ? '/billing/verify' : '/get-started/verify';
                        const redirectUrl = isAuthenticated ? 'https://erp.nexorabyte.in/dashboard' : "{{ route('register') }}";

                        const response = await fetch(endpoint, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({ 
                                plan: plan,
                                _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            })
                        });

                        const data = await response.json();
                        if (!data.success) {
                            console.error('Payment Initialization Failed:', data.message);
                            alert(data.message || 'Error initializing payment.');
                            this.loadingPlan = null;
                            return;
                        }

                        // Handle Free Trial (No Razorpay needed)
                        if (data.is_free) {
                            window.location.href = redirectUrl + "?plan=" + plan + "&status=free_trial";
                            return;
                        }

                        const options = {
                            "key": data.key,
                            "amount": data.amount,
                            "currency": "INR",
                            "name": "nexorabyte",
                            "description": "Insurance ERP: " + plan,
                            "image": "{{ asset('images/company_logo.jpg') }}",
                            "order_id": data.order_id,
                            "handler": async (res) => {
                                try {
                                    const verifyRes = await fetch(verifyEndpoint, {
                                        method: 'POST',
                                        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') },
                                        body: JSON.stringify({
                                            razorpay_payment_id: res.razorpay_payment_id,
                                            razorpay_order_id: res.razorpay_order_id,
                                            razorpay_signature: res.razorpay_signature,
                                            plan: plan
                                        })
                                    });
                                    const verifyData = await verifyRes.json();
                                    if (verifyData.success) {
                                        window.location.href = redirectUrl;
                                    } else {
                                        alert('Verification failed.');
                                        this.loadingPlan = null;
                                    }
                                } catch (err) {
                                    console.error('Verification Request Error:', err);
                                    alert('Error verifying payment.');
                                    this.loadingPlan = null;
                                }
                            },
                            "theme": { "color": "#e11d48" },
                            "modal": { "ondismiss": () => { this.loadingPlan = null; } }
                        };
                        const rzp = new Razorpay(options);
                        rzp.open();
                    } catch (error) {
                        console.error('Razorpay Flow Error:', error);
                        alert('Something went wrong. Please try again.');
                        this.loadingPlan = null;
                    }
                }
            }))
        })
    </script>
</body>

</html>