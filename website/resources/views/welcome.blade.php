<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>nexorabyte.in | Elite Command Center</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon-nb.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description"
        content="nexorabyte is a premier digital studio specializing in custom web engineering and bespoke ERP ecosystems tailored to your unique operational pulse.">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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

        .delay-400 {
            animation-delay: 0.4s;
        }

        .browser-shadow {
            box-shadow: 0 50px 100px -20px rgba(0, 0, 0, 0.5), 0 30px 60px -30px rgba(0, 0, 0, 0.5), inset 0 0 0 1px rgba(255, 255, 255, 0.05);
        }

        /* Screenshot crop: hides browser chrome (tabs + URL bar ~85px) */
        .ss-crop-wrap {
            overflow: hidden;
            position: relative;
            background: #f8fafc;
        }

        .ss-crop-wrap img {
            display: block;
            width: 100%;
            margin-top: -85px;
        }

        /* Fade-out bottom so it blends into the frame */
        .ss-crop-wrap::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 60px;
            background: linear-gradient(to bottom, transparent, #f8fafc);
            pointer-events: none;
        }

        /* Glow ring around showcase frame */
        .showcase-glow {
            box-shadow:
                0 0 0 1px rgba(99, 102, 241, 0.15),
                0 0 80px -10px rgba(99, 102, 241, 0.35),
                0 40px 80px -20px rgba(0, 0, 0, 0.6);
        }

        /* Auto-scroll animation for stacked images */
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

        /* Advanced Modal Animations */
        @keyframes modalEntrance {
            0% { opacity: 0; transform: translateY(30px) scale(0.95); }
            100% { opacity: 1; transform: translateY(0) scale(1); }
        }

        @keyframes premiumFloat {
            0% { transform: translateY(0) translateX(0); }
            50% { transform: translateY(-20px) translateX(10px); }
            100% { transform: translateY(0) translateX(0); }
        }

        @keyframes pulseGlow {
            0% { box-shadow: 0 0 0 0 rgba(139, 92, 246, 0.4); }
            70% { box-shadow: 0 0 0 20px rgba(139, 92, 246, 0); }
            100% { box-shadow: 0 0 0 0 rgba(139, 92, 246, 0); }
        }

        @keyframes drifting {
            0% { transform: translate(0, 0); opacity: 0; }
            20% { opacity: 0.4; }
            80% { opacity: 0.4; }
            100% { transform: translate(30px, -40px); opacity: 0; }
        }

        .modal-card {
            animation: modalEntrance 0.7s cubic-bezier(0.23, 1, 0.32, 1) forwards;
        }

        .floating-blob {
            position: absolute;
            filter: blur(40px);
            opacity: 0.3;
            animation: premiumFloat 10s ease-in-out infinite;
        }

        .drifting-particle {
            position: absolute;
            background: white;
            border-radius: 50%;
            opacity: 0.2;
            animation: drifting 12s linear infinite;
        }

        .glass-badge {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px border rgba(255, 255, 255, 0.2);
        }

        .cta-gradient-btn {
            background: linear-gradient(135deg, #7c3aed 0%, #db2777 100%);
            animation: pulseGlow 2.5s infinite;
        }

        .text-gradient-gold {
            background: linear-gradient(135deg, #f59e0b 0%, #ef4444 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Hide scrollbar for Chrome, Safari and Opera */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        /* Hide scrollbar for IE, Edge and Firefox */
        .no-scrollbar {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }
    </style>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>

<body class="text-slate-700 antialiased selection:bg-indigo-500 selection:text-white overflow-x-hidden">
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
            <feColorMatrix type="matrix" values="1 0 0 0 0 
                                                 0 1 0 0 0 
                                                 0 0 1 0 0 
                                                 1 1 1 0 -0.1" />
        </filter>
    </svg>

    <!-- Navigation -->
    <nav class="fixed w-full z-50 glass-nav h-16 flex items-center" x-data="{ mobileOpen: false }">
        <div class="max-w-7xl mx-auto w-full px-4 sm:px-6 flex justify-between items-center">
            <a href="/" class="flex items-center gap-3">
                <img src="{{ asset('images/company_logo.jpg') }}" alt="nexorabyte" class="h-9 w-auto object-contain"
                    style="filter: url(#chroma-key-black) contrast(1.1);">
                <span class="text-lg font-black text-slate-900 tracking-[0.2em]">nexorabyte</span>
            </a>

            <!-- Desktop Nav -->
            <div class="hidden md:flex items-center gap-6">
                <a href="{{ route('services') }}"
                    class="text-[11px] font-semibold uppercase tracking-widest hover:text-rose-600 transition-colors border-r border-slate-200 pr-6 text-slate-700">Services</a>
                @auth
                    <a href="{{ route('force-login') }}"
                        class="text-[11px] font-semibold uppercase tracking-widest hover:text-rose-600 transition-colors text-slate-700">Sign
                        In</a>
                    <a href="https://erp.nexorabyte.in/dashboard"
                        class="elite-btn bg-rose-600 shadow-lg text-white text-[11px] font-bold px-6 py-2.5 rounded-full uppercase tracking-widest hover:bg-rose-500">Dashboard</a>
                @else
                    <a href="{{ route('force-login') }}"
                        class="text-[11px] font-semibold uppercase tracking-widest hover:text-rose-600 transition-colors text-slate-700">Sign
                        In</a>
                    <a href="{{ route('get-started') }}"
                        class="elite-btn bg-rose-600 shadow-lg text-white text-[11px] font-bold px-6 py-2.5 rounded-full uppercase tracking-widest hover:bg-rose-500">Sign
                        Up</a>
                @endauth
            </div>

            <!-- Mobile Hamburger -->
            <button @click="mobileOpen = !mobileOpen"
                class="md:hidden flex items-center justify-center w-10 h-10 rounded-xl bg-white/80 border border-slate-200 shadow-sm">
                <svg x-show="!mobileOpen" class="w-5 h-5 text-slate-700" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg x-show="mobileOpen" style="display:none" class="w-5 h-5 text-slate-700" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Mobile Menu Dropdown -->
        <div x-show="mobileOpen" @click.away="mobileOpen = false" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2" style="display:none"
            class="absolute top-16 left-0 right-0 bg-white/95 backdrop-blur-xl border-b border-slate-100 shadow-xl px-6 py-6 flex flex-col gap-5 md:hidden z-50">
            <a href="{{ route('services') }}"
                class="text-sm font-bold uppercase tracking-widest text-slate-700 hover:text-rose-600">Services</a>
            @auth
                <a href="{{ route('force-login') }}"
                    class="text-sm font-bold uppercase tracking-widest text-slate-700 hover:text-rose-600">Sign In</a>
                <a href="https://erp.nexorabyte.in/dashboard"
                    class="bg-rose-600 text-white text-sm font-bold px-6 py-3 rounded-xl uppercase tracking-widest text-center hover:bg-rose-500">Dashboard</a>
            @else
                <a href="{{ route('force-login') }}"
                    class="text-sm font-bold uppercase tracking-widest text-slate-700 hover:text-rose-600">Sign In</a>
                <a href="{{ route('get-started') }}"
                    class="bg-rose-600 text-white text-sm font-bold px-6 py-3 rounded-xl uppercase tracking-widest text-center hover:bg-rose-500">Sign
                    Up</a>
            @endauth
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-36 pb-16 px-4 sm:px-8 text-center relative overflow-hidden">
        <div class="max-w-7xl mx-auto relative z-10 pt-6">
            <div
                class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-rose-50 border border-rose-100 text-rose-600 text-[10px] font-bold uppercase tracking-[0.3em] mb-8 animate-fade-in-up">
                <span class="w-2 h-2 rounded-full bg-rose-500 animate-pulse"></span>
                Studio for High-Performance Digital Architecture
            </div>
            <h1
                class="hero-h1 text-5xl md:text-7xl lg:text-8xl font-extrabold text-slate-900 mb-8 leading-[0.95] tracking-tight animate-fade-in-up delay-100">
                Architecting the <br class="hidden sm:block" /> <span
                    class="text-transparent bg-clip-text bg-gradient-to-r from-rose-600 via-pink-600 to-rose-400">Digital
                    Backbone.</span>
            </h1>
            <p
                class="text-base sm:text-lg md:text-2xl text-slate-700 font-bold tracking-tight leading-relaxed max-w-4xl mx-auto mb-12 animate-fade-in-up delay-200">
                We engineer high-velocity ERP ecosystems and bespoke web architectures that unify fragmented operations
                into a single, high-performance pulse.
            </p>
            <!-- Capability Matrix Bar -->
            <div
                class="mt-24 flex flex-wrap justify-center items-center gap-x-16 gap-y-8 opacity-70 animate-fade-in-up delay-400 px-6">
                <div class="flex items-center gap-4 group">
                    <div class="w-2.5 h-2.5 rounded-full bg-rose-500 shadow-sm shadow-rose-200"></div>
                    <span class="text-[11px] font-black uppercase tracking-[0.3em] text-slate-900 leading-none">Bespoke
                        ERP Logic</span>
                </div>
                <div class="flex items-center gap-4 group border-l border-slate-200 pl-16 hidden md:flex">
                    <div class="w-2.5 h-2.5 rounded-full bg-indigo-500 shadow-sm shadow-indigo-200"></div>
                    <span class="text-[11px] font-black uppercase tracking-[0.3em] text-slate-900 leading-none">Global
                        Edge Cloud</span>
                </div>
                <div class="flex items-center gap-4 group border-l border-slate-200 pl-16 hidden lg:flex">
                    <div class="w-2.5 h-2.5 rounded-full bg-emerald-500 shadow-sm shadow-emerald-200"></div>
                    <span
                        class="text-[11px] font-black uppercase tracking-[0.3em] text-slate-900 leading-none">Immutable
                        Security</span>
                </div>
            </div>

            <!-- Services Narrative Section -->
            <div class="mt-32 max-w-5xl mx-auto">
                <div
                    class="crystal-card p-12 md:p-20 rounded-[3rem] text-center relative overflow-hidden animate-fade-in-up">
                    <div class="absolute inset-0 bg-gradient-to-br from-rose-500/5 to-transparent"></div>

                    <h2
                        class="text-3xl md:text-5xl font-black text-slate-900 mb-8 uppercase tracking-tighter relative z-10">
                        Elite Services for the <br /> <span
                            class="text-transparent bg-clip-text bg-gradient-to-r from-rose-600 to-pink-600">Modern
                            Enterprise.</span>
                    </h2>

                    <p
                        class="text-lg md:text-xl text-slate-600 font-bold leading-relaxed max-w-3xl mx-auto mb-12 relative z-10">
                        We combine high-level engineering with strategic digital architecture to deliver unrivaled
                        growth and operational excellence. From bespoke ERP ecosystems to high-performance web
                        platforms, our solutions are built to scale with your unique operational pulse.
                    </p>

                    <a href="{{ route('services') }}"
                        class="elite-btn inline-flex items-center gap-4 bg-slate-900 text-white font-black px-12 py-5 rounded-2xl uppercase tracking-[0.2em] text-[11px] hover:bg-slate-800 transition-all shadow-2xl relative z-10">
                        View All Capabilities
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Premium Split-Layout Modal -->
    <div id="premiumSaleModal" class="fixed inset-0 z-[100] flex items-center justify-center px-4" style="display: none;">
        <!-- Background Overlay -->
        <div class="absolute inset-0 bg-slate-900/80 backdrop-blur-2xl" onclick="closePremiumModal()"></div>

        <!-- Modal Card -->
        <div class="relative bg-white rounded-[3.5rem] shadow-[0_40px_100px_-20px_rgba(0,0,0,0.5)] border border-white/20 w-full max-w-4xl flex flex-col md:flex-row overflow-hidden modal-card no-scrollbar" style="font-family: Cambria, Georgia, serif;">
            
            <!-- Left Side: Dark Premium Visual -->
            <div class="w-full md:w-[42%] bg-gradient-to-br from-[#0f172a] to-[#1e1b4b] relative overflow-hidden flex items-center justify-center p-12">
                <!-- Floating Blobs -->
                <div class="floating-blob w-40 h-40 bg-purple-500/20 top-10 left-10" style="animation-delay: 0s;"></div>
                <div class="floating-blob w-32 h-32 bg-indigo-500/20 bottom-10 right-10" style="animation-delay: -5s;"></div>
                
                <!-- Tiny Drifting Particles -->
                @foreach(range(1, 15) as $p)
                <div class="drifting-particle" style="width: {{ rand(2,4) }}px; height: {{ rand(2,4) }}px; top: {{ rand(5,95) }}%; left: {{ rand(5,95) }}%; animation-delay: {{ rand(0,10) }}s;"></div>
                @endforeach

                <!-- Floating Micro Icons -->
                <div class="absolute text-xl opacity-30 animate-bounce" style="top: 20%; right: 20%; animation-duration: 8s;">🚀</div>
                <div class="absolute text-xl opacity-30 animate-pulse" style="bottom: 25%; left: 15%; animation-duration: 10s;">⚡</div>
                <div class="absolute text-xl opacity-30" style="top: 50%; left: 10%; animation: premiumFloat 12s infinite;">💎</div>

                <!-- Glass Badge -->
                <div class="relative z-20 glass-badge px-8 py-4 rounded-2xl border border-white/10 text-center shadow-2xl">
                    <span class="text-white text-[10px] font-black uppercase tracking-[0.4em] opacity-60 block mb-2">Internal Engine</span>
                    <div class="text-2xl font-black text-white uppercase tracking-tighter">Next-Gen <br/> ERP Engine</div>
                </div>
            </div>

            <!-- Right Side: Content -->
            <div class="w-full md:w-[58%] p-10 md:p-14 bg-white relative">
                <!-- Close Button -->
                <button onclick="closePremiumModal()" class="absolute top-8 right-8 text-slate-300 hover:text-slate-900 transition-colors">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <div class="mb-8">
                    <div class="inline-flex items-center gap-2 bg-indigo-50 px-4 py-1.5 rounded-full border border-indigo-100 mb-6">
                        <span class="text-[10px] font-black text-indigo-600 uppercase tracking-widest">Early Adopter Offer ✨</span>
                    </div>
                    <h2 class="text-4xl md:text-5xl font-black text-slate-900 uppercase tracking-tighter mb-4 leading-none">
                        The Elite <br/> <span class="text-gradient-gold">Agency Upgrade.</span>
                    </h2>
                    <p class="text-slate-600 text-base font-medium leading-relaxed" style="font-family: Cambria, Georgia, serif;">
                        Join the top 50 agents transforming their business with nexorabyte. This is your unfair advantage. 🚀
                    </p>
                </div>

                <!-- Price Block -->
                <div class="bg-emerald-50/50 rounded-[2.5rem] p-8 mb-8 border border-emerald-100/50 relative group overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/5 to-transparent opacity-50"></div>
                    <div class="relative z-10 flex flex-col items-start gap-1">
                        <div class="flex items-baseline gap-4">
                            <div class="text-7xl font-black tracking-tighter text-emerald-600">
                                ₹<span id="priceCounter">0</span>
                            </div>
                            <div class="text-xl text-rose-500 font-black line-through decoration-2">₹17,999</div>
                        </div>
                        <div class="text-[11px] font-black uppercase tracking-[0.2em] bg-white/50 px-3 py-1 rounded-full border border-emerald-100 shadow-sm text-slate-900">
                            ✨ Founder pricing — never available again
                        </div>
                    </div>
                </div>

                <!-- CTA -->
                <div class="flex flex-col gap-6">
                    <a href="{{ route('services.insurance-erp') }}" 
                       class="elite-btn cta-gradient-btn text-white font-black py-6 rounded-2xl uppercase tracking-[0.25em] text-[11px] shadow-2xl transition-all flex items-center justify-center gap-4">
                        Claim Founder Spot ⚡
                    </a>
                    
                    <div class="flex items-center justify-center px-2">
                        <div class="flex items-center gap-3 text-[10px] font-black text-slate-400 uppercase tracking-[0.3em]">
                            <span class="w-2 h-2 rounded-full bg-rose-500 animate-ping"></span>
                            Only <span id="spotsCounter" class="text-slate-900">48</span> spots remaining
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function closePremiumModal() {
            document.getElementById('premiumSaleModal').style.display = 'none';
            // Trigger protocol matrix immediately after closing sale popup
            if (window.showProtocolMatrix) {
                window.showProtocolMatrix();
            }
        }

        function animatePrice(target) {
            const el = document.getElementById('priceCounter');
            let current = 0;
            const duration = 2000;
            
            const timer = setInterval(() => {
                current += 157; // Faster increment
                if (current >= target) {
                    el.innerText = target.toLocaleString();
                    clearInterval(timer);
                } else {
                    el.innerText = current.toLocaleString();
                }
            }, 10);
        }

        // Auto-show logic (Once per session - Immediate)
        const showPopup = () => {
            if (!sessionStorage.getItem('founderSaleShown')) {
                const modal = document.getElementById('premiumSaleModal');
                modal.style.display = 'flex';
                animatePrice(14999);
                
                // Mark as shown for this session
                sessionStorage.setItem('founderSaleShown', 'true');
                
                // Subtle spots fluctuation simulation
                setTimeout(() => {
                    const spots = document.getElementById('spotsCounter');
                    if (spots) {
                        spots.classList.add('text-rose-400', 'scale-110', 'transition-all');
                        setTimeout(() => {
                            spots.innerText = "47";
                            spots.classList.remove('text-rose-400', 'scale-110');
                        }, 1000);
                    }
                }, 5000);
            }
        };

        // Trigger immediately on load
        if (document.readyState === 'complete') {
            showPopup();
        } else {
            window.addEventListener('load', showPopup);
        }
    </script>

    <!-- The nexorabyte Advantage Section -->
    <section class="py-24 px-8 relative overflow-hidden bg-slate-50/30">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div class="group animate-fade-in-up">
                    <div
                        class="w-12 h-12 rounded-xl bg-rose-50 flex items-center justify-center text-rose-600 mb-6 group-hover:scale-110 transition-transform border border-rose-100 italic font-black text-xl">
                        L</div>
                    <h3 class="text-xl font-extrabold text-slate-900 mb-4 uppercase tracking-tight">Zero-Latency
                        Architecture</h3>
                    <p class="text-slate-600 font-medium leading-relaxed text-sm">
                        Engineered for speed. We eliminate redundant processing cycles to deliver instantaneous
                        interactions even across complex enterprise datasets.
                    </p>
                </div>
                <div class="group animate-fade-in-up delay-100">
                    <div
                        class="w-12 h-12 rounded-xl bg-indigo-50 flex items-center justify-center text-indigo-600 mb-6 group-hover:scale-110 transition-transform border border-indigo-100 italic font-black text-xl">
                        S</div>
                    <h3 class="text-xl font-extrabold text-slate-900 mb-4 uppercase tracking-tight">Immutable Data
                        Security</h3>
                    <p class="text-slate-600 font-medium leading-relaxed text-sm">
                        Enterprise-grade protection is our baseline. Utilizing multi-tenant isolation and AES-256
                        encryption at rest and in transit.
                    </p>
                </div>
                <div class="group animate-fade-in-up delay-200">
                    <div
                        class="w-12 h-12 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-600 mb-6 group-hover:scale-110 transition-transform border border-emerald-100 italic font-black text-xl">
                        E</div>
                    <h3 class="text-xl font-extrabold text-slate-900 mb-4 uppercase tracking-tight">Elastic Scalability
                    </h3>
                    <p class="text-slate-600 font-medium leading-relaxed text-sm">
                        Custom-built engines designed to grow. As your operational pulse accelerates, your digital
                        infrastructure scales automatically to meet the demand.
                    </p>
                </div>
            </div>
        </div>
    </section>



    <!-- Domain Expertise Section -->
    <section class="py-32 px-8 overflow-hidden">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row items-end justify-between mb-20 gap-8">
                <div class="max-w-2xl">
                    <h2 class="text-[11px] font-black text-rose-600 uppercase tracking-[0.4em] mb-4">Elite
                        Specialization</h2>
                    <h2 class="text-3xl md:text-5xl font-extrabold text-slate-900 tracking-tight leading-tight">
                        Mastering Domains of <br /> High-Complexity.</h2>
                </div>
                <div class="text-slate-700 text-sm max-w-sm" style="font-family: Cambria, Georgia, serif;">
                    We don't just build software; we build the digital backbone for industries that operate on the edge
                    of precision.
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="crystal-card p-10 rounded-[3rem] border border-slate-100 hover:border-rose-200 group">
                    <div class="text-rose-600 font-black mb-6 flex items-center gap-3">
                        <span class="w-8 h-px bg-rose-200"></span> 01
                    </div>
                    <h4 class="text-2xl font-black text-slate-900 mb-4 uppercase tracking-tighter">FinTech & Insurance
                    </h4>
                    <p class="text-slate-700 text-sm leading-relaxed" style="font-family: Cambria, Georgia, serif;">
                        Complex ledger management, automated claims processing, and high-security transactional engines.
                    </p>
                </div>
                <div class="crystal-card p-10 rounded-[3rem] border border-slate-100 hover:border-indigo-200 group">
                    <div class="text-indigo-600 font-black mb-6 flex items-center gap-3">
                        <span class="w-8 h-px bg-indigo-200"></span> 02
                    </div>
                    <h4 class="text-2xl font-black text-slate-900 mb-4 uppercase tracking-tighter">Global Logistics</h4>
                    <p class="text-slate-700 text-sm leading-relaxed" style="font-family: Cambria, Georgia, serif;">
                        Real-time telemetry, supply chain automation, and intelligent inventory predictive models.</p>
                </div>
                <div class="crystal-card p-10 rounded-[3rem] border border-slate-100 hover:border-emerald-200 group">
                    <div class="text-emerald-600 font-black mb-6 flex items-center gap-3">
                        <span class="w-8 h-px bg-emerald-200"></span> 03
                    </div>
                    <h4 class="text-2xl font-black text-slate-900 mb-4 uppercase tracking-tighter">Bespoke ERPs</h4>
                    <p class="text-slate-700 text-sm leading-relaxed" style="font-family: Cambria, Georgia, serif;">
                        Unified operational engines tailored to unique internal business logic and multi-tier
                        hierarchies.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Studio Philosophy Section -->
    <!-- Studio Philosophy Section -->
    <section class="py-32 px-8 border-t border-slate-200">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
                <div class="animate-fade-in-up">
                    <span class="text-[10px] font-black text-rose-600 uppercase tracking-[0.4em] mb-6 block">Our
                        Vision</span>
                    <h2 class="text-4xl md:text-5xl font-extrabold text-slate-900 leading-[1.1] mb-8">Engineering the
                        Pulse <br /> of Tomorrow's Growth.</h2>
                    <p class="text-slate-700 text-lg leading-relaxed mb-12">
                        At nexorabyte, we reject the generic. We believe that technology should be a bespoke catalyst,
                        seamlessly integrated into your operational workflow. Every line of code we engineer is a
                        deliberate step toward
                        precision, performance, and unyielding scalability.
                    </p>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-10">
                        <div class="group">
                            <h4 class="text-slate-900 font-bold text-lg mb-2 uppercase tracking-tight">Customized Focus
                            </h4>
                            <p class="text-slate-700 text-sm leading-relaxed"
                                style="font-family: Cambria, Georgia, serif;">No templates. No compromises. Every
                                project is a unique engineering challenge built from the ground up.</p>
                        </div>
                        <div class="group">
                            <h4 class="text-slate-900 font-bold text-lg mb-2 uppercase tracking-tight">Enterprise Ops
                            </h4>
                            <p class="text-slate-700 text-sm leading-relaxed"
                                style="font-family: Cambria, Georgia, serif;">Advanced data security and multi-tenant
                                scaling are baked into every architecture we deliver.</p>
                        </div>
                    </div>
                </div>

                <div class="relative animate-fade-in-up delay-200">
                    <div class="absolute inset-0 bg-rose-500/5 blur-[120px] rounded-full"></div>
                    <div
                        class="relative crystal-card p-12 rounded-[3.5rem] border border-slate-200 shadow-xl shadow-slate-100">
                        <h4
                            class="text-rose-600 font-black uppercase tracking-widest text-[11px] mb-8 px-4 py-2 bg-rose-50 border border-rose-100 rounded-full inline-block">
                            Consulting Studio</h4>
                        <p class="text-slate-800 text-2xl font-black leading-tight italic mb-8">
                            "nexorabyte didn't just give us a tool; they gave us a new way to understand our own
                            business trajectory."
                        </p>
                        <div class="flex items-center gap-4">
                            <div
                                class="w-12 h-12 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-400 font-bold">
                                SO</div>
                            <div>
                                <div class="text-slate-900 font-bold text-sm">Strategic Operations</div>
                                <div class="text-slate-500 text-xs text-slate-400">Enterprise Client</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Standard Core Features -->
        <div class="mt-24 grid grid-cols-2 lg:grid-cols-4 gap-12 max-w-6xl mx-auto border-t border-slate-100 pt-16">
            <div class="text-center group">
                <div
                    class="text-[11px] font-black text-slate-900 uppercase tracking-[0.2em] mb-4 group-hover:text-rose-600 transition-colors">
                    Security Architecture</div>
                <div
                    class="text-[10px] font-bold text-slate-600 uppercase tracking-widest italic group-hover:text-slate-900 transition-all">
                    AES-256 Multi-Tenant Isolation</div>
            </div>
            <div class="text-center border-l border-slate-100 group px-6">
                <div
                    class="text-[11px] font-black text-slate-900 uppercase tracking-[0.2em] mb-4 group-hover:text-indigo-600 transition-colors">
                    Disaster Recovery</div>
                <div
                    class="text-[10px] font-bold text-slate-600 uppercase tracking-widest italic group-hover:text-slate-900 transition-all">
                    6-Hour Automated Snapshots</div>
            </div>
            <div class="text-center border-l border-slate-100 group px-6">
                <div
                    class="text-[11px] font-black text-slate-900 uppercase tracking-[0.2em] mb-4 group-hover:text-emerald-600 transition-colors">
                    Availability SLA</div>
                <div
                    class="text-[10px] font-bold text-slate-600 uppercase tracking-widest italic group-hover:text-slate-900 transition-all">
                    99.99% Redundant Logic Nodes</div>
            </div>
            <div class="text-center border-l border-slate-100 group px-6">
                <div
                    class="text-[11px] font-black text-slate-900 uppercase tracking-[0.2em] mb-4 group-hover:text-rose-600 transition-colors">
                    Global Delivery</div>
                <div
                    class="text-[10px] font-bold text-slate-600 uppercase tracking-widest italic group-hover:text-slate-900 transition-all">
                    Anycast Edge Network Integration</div>
            </div>
        </div>
        </div>
    </section>

    <x-footer />

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('welcomeCheckout', () => ({
                loadingPlan: null,

                async pay(plan) {
                    this.loadingPlan = plan;
                    const isAuthenticated = @json(auth()->check());
                    try {
                        // 1. Determine Endpoint Based on Auth Status
                        const endpoint = isAuthenticated ? '/billing/checkout' : '/get-started/checkout';
                        const verifyEndpoint = isAuthenticated ? '/billing/verify' : '/get-started/verify';
                        const redirectUrl = isAuthenticated ? 'https://erp.nexorabyte.in/dashboard' : "{{ route('register') }}?flow=onboarding&step=2";

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
                            alert(data.message || 'Error initializing payment.');
                            this.loadingPlan = null;
                            return;
                        }

                        // Handle Free Trial (No Razorpay needed)
                        if (data.is_free) {
                            window.location.href = redirectUrl + (redirectUrl.includes('?') ? '&' : '?') + "plan=" + plan + "&status=free_trial";
                            return;
                        }

                        const options = {
                            "key": data.key,
                            "amount": data.amount,
                            "currency": "INR",
                            "name": "nexorabyte",
                            "description": "Subscription Plan: " + plan.charAt(0).toUpperCase() + plan.slice(1),
                            "image": "{{ asset('images/favicon-nb.png') }}",
                            "order_id": data.order_id,
                            "handler": async (res) => {
                                const verifyRes = await fetch(verifyEndpoint, {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                    },
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
                                    alert('Payment verification failed.');
                                    this.loadingPlan = null;
                                }
                            },
                            "theme": { "color": plan === 'trial' ? "#10b981" : "#4f46e5" },
                            "modal": {
                                "ondismiss": () => { this.loadingPlan = null; }
                            }
                        };

                        const rzp = new Razorpay(options);
                        rzp.open();

                    } catch (error) {
                        alert('Something went wrong. Please try again.');
                        this.loadingPlan = null;
                    }
                }
            }))
        })
    </script>
</body>

</html>