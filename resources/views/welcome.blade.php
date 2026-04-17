<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NexoraByte ERP | Elite Command Center</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet">

    <!-- CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #020617;
        }

        .mesh-bg {
            background-color: #050510;
            background-image:
                radial-gradient(circle at 15% 20%, rgba(99, 102, 241, 0.4) 0%, transparent 40%),
                radial-gradient(circle at 85% 30%, rgba(236, 72, 153, 0.4) 0%, transparent 40%),
                radial-gradient(circle at 50% 80%, rgba(14, 165, 233, 0.35) 0%, transparent 55%);
            background-attachment: fixed;
        }

        .glass-nav {
            background: rgba(2, 6, 23, 0.85);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .crystal-card {
            background: rgba(15, 23, 42, 0.4);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.06);
            transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
        }

        .crystal-card:hover {
            border-color: rgba(99, 102, 241, 0.3);
            background: rgba(15, 23, 42, 0.6);
            transform: translateY(-8px);
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
    </style>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>

<body class="mesh-bg text-slate-400 antialiased selection:bg-indigo-500 selection:text-white">

    <!-- Navigation -->
    <nav class="fixed w-full z-50 glass-nav h-20 flex items-center">
        <div class="max-w-7xl mx-auto w-full px-8 flex justify-between items-center">
            <a href="{{ route('dashboard') }}" class="sidebar-logo flex items-center gap-4">
                <img src="{{ asset('images/logo.png') }}?v=100" alt="logo" class="h-16 w-auto object-contain">
                <span class="text-2xl font-black text-white tracking-[0.2em] uppercase">NexoraByte</span>
            </a>

            <div class="flex items-center gap-10">
                <div
                    class="hidden lg:flex items-center gap-8 text-[11px] font-semibold text-slate-500 uppercase tracking-widest dark:text-slate-400">
                    <a href="#features" class="hover:text-white transition-colors">Features</a>
                    <a href="#pricing" class="hover:text-white transition-colors">Pricing</a>
                </div>

                <div class="flex items-center gap-6">
                    @auth
                        <a href="{{ route('force-login') }}"
                            class="text-[11px] font-semibold uppercase tracking-widest hover:text-white transition-colors">Sign
                            In</a>
                        <a href="{{ route('billing.index') }}"
                            class="elite-btn bg-indigo-600 shadow-lg text-white text-[11px] font-bold px-6 py-2.5 rounded-full uppercase tracking-widest hover:bg-indigo-500">Sign
                            Up</a>
                    @else
                        <a href="{{ route('force-login') }}"
                            class="text-[11px] font-semibold uppercase tracking-widest hover:text-white transition-colors">Sign
                            In</a>
                        <a href="{{ route('get.started') }}"
                            class="elite-btn bg-indigo-600 shadow-lg text-white text-[11px] font-bold px-6 py-2.5 rounded-full uppercase tracking-widest hover:bg-indigo-500">Sign
                            Up</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-32 pb-20 px-8 text-center relative border-b border-white/[0.02] overflow-hidden">
        <div
            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-indigo-600/20 blur-[120px] rounded-full pointer-events-none">
        </div>
        <div class="max-w-6xl mx-auto relative z-10 pt-10">
            <div
                class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 text-[10px] font-bold uppercase tracking-widest mb-8">
                <span class="w-2 h-2 rounded-full bg-indigo-500 animate-pulse"></span>
                Next-Gen Digital Agency & Premium ERP Solutions
            </div>
            <h1 class="text-5xl md:text-7xl font-black text-white mb-8 leading-[1.1] tracking-tight">
                Transforming Operations & <br /> Driving Growth <span
                    class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 via-cyan-400 to-emerald-400 italic">Digitally.</span>
            </h1>
            <p
                class="text-lg md:text-xl text-slate-400 font-medium tracking-tight leading-relaxed max-w-3xl mx-auto mb-10">
                A premium digital partner delivering elite web development, highly-targeted marketing campaigns, and
                specialized multi-tenant ERP software engineered for total operational clarity.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-6">
                <a href="#services"
                    class="elite-btn bg-white text-slate-950 font-black px-8 py-4 rounded-xl uppercase tracking-widest hover:bg-slate-200 transition-colors">
                    Explore Our Services
                </a>
                <a href="{{ route('get.started') }}"
                    class="elite-btn bg-slate-800/80 text-white font-black px-8 py-4 rounded-xl border border-white/10 uppercase tracking-widest hover:bg-slate-700 transition-colors flex items-center gap-3">
                    <svg class="w-5 h-5 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z">
                        </path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Get ERP Access
                </a>
            </div>
        </div>
    </section>

    <!-- Trusted By / Stats -->
    </section>

    <!-- Interactive ERP Showcase Section -->
    <section class="py-24 px-8 relative overflow-hidden" x-data="{ 
        activeTab: 'dashboard',
        tabs: [
            { id: 'dashboard', name: 'Dashboard', icon: 'M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z' },
            { id: 'clients', name: 'Client Directory', icon: 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z' },
            { id: 'claims', name: 'Claims Center', icon: 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z' },
            { id: 'renewals', name: 'Policy Pulse', icon: 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z' }
        ]
    }">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16 animate-fade-in-up">
                <span class="text-indigo-400 text-[10px] font-bold uppercase tracking-[0.3em] mb-3 block">Live Product
                    Deep-Dive</span>
                <h2 class="text-4xl md:text-6xl font-extrabold text-white tracking-tight mb-6">Experience Total <br />
                    Operational <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-cyan-400">Clarity.</span>
                </h2>
                <p class="text-slate-400 text-lg max-w-2xl mx-auto">Explore how our flagship software streamlines every
                    workflow in your agency. Exact UI, zero friction.</p>
            </div>

            <div class="flex flex-col lg:flex-row gap-8 items-start">
                <!-- Tabs Sidebar -->
                <div class="w-full lg:w-72 flex flex-col gap-2 shrink-0 animate-fade-in-up delay-100">
                    <template x-for="tab in tabs" :key="tab.id">
                        <button @click="activeTab = tab.id"
                            :class="activeTab === tab.id ? 'bg-indigo-500/10 border-indigo-500/30 text-white ' : 'border-transparent text-slate-500 hover:text-slate-300 hover:bg-white/5' dark:text-slate-400"
                            class="flex items-center gap-4 px-6 py-4 rounded-2xl border transition-all duration-300 text-left group">
                            <div :class="activeTab === tab.id ? 'text-indigo-400' : 'text-slate-600 group-hover:text-slate-400'"
                                class="transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="tab.icon">
                                    </path>
                                </svg>
                            </div>
                            <span class="text-xs font-bold uppercase tracking-widest" x-text="tab.name"></span>
                        </button>
                    </template>
                </div>

                <!-- Showcase Content -->
                <div class="flex-1 w-full animate-fade-in-up delay-200">
                    <!-- Browser Mockup Outer Frame -->
                    <div class="rounded-[2rem] overflow-hidden showcase-glow"
                        style="background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 100%); border: 1px solid rgba(99,102,241,0.2);">

                        <!-- Top Bar (Clean HTML — no browser chrome from images) -->
                        <div class="h-12 flex items-center px-6 justify-between"
                            style="background: rgba(15,23,42,0.95); border-bottom: 1px solid rgba(255,255,255,0.05);">
                            <div class="flex gap-2">
                                <div class="w-3 h-3 rounded-full" style="background:#FF5F56;"></div>
                                <div class="w-3 h-3 rounded-full" style="background:#FFBD2E;"></div>
                                <div class="w-3 h-3 rounded-full" style="background:#27C93F;"></div>
                            </div>
                            <div class="flex items-center gap-2 px-5 py-1 rounded-full"
                                style="background:rgba(99,102,241,0.08); border: 1px solid rgba(99,102,241,0.15);">
                                <div class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></div>
                                <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">nexorabyte.in /
                                    <span class="text-indigo-300" x-text="activeTab"></span></span>
                            </div>
                            <div class="w-14"></div>
                        </div>

                        <!-- Screenshot Display Area: crops browser chrome, shows ERP UI only -->
                        <div class="relative" style="height: 540px; overflow: hidden;">

                            <!-- Dashboard: auto-scrolling stacked screenshots -->
                            <div x-show="activeTab === 'dashboard'"
                                x-transition:enter="transition ease-out duration-500"
                                x-transition:enter-start="opacity-0 translate-y-2"
                                x-transition:enter-end="opacity-100 translate-y-0" class="scroll-animate">
                                {{-- Each img: margin-top -85px crops the browser chrome from the screenshot --}}
                                <img src="{{ asset('images/screenshots/ss_dashboard_full.png') }}" alt="Dashboard"
                                    style="display:block; width:100%; margin-top:-85px;" />
                                <img src="{{ asset('images/screenshots/ss_query_chart.png') }}" alt="Query Chart"
                                    style="display:block; width:100%; margin-top:-85px;" />
                                <img src="{{ asset('images/screenshots/ss_claim_analytics.png') }}"
                                    alt="Claim Analytics" style="display:block; width:100%; margin-top:-85px;" />
                                <img src="{{ asset('images/screenshots/ss_celebration.png') }}" alt="Celebration"
                                    style="display:block; width:100%; margin-top:-85px;" />
                            </div>

                            <!-- Clients -->
                            <div x-show="activeTab === 'clients'" x-transition:enter="transition ease-out duration-500"
                                x-transition:enter-start="opacity-0 translate-y-2"
                                x-transition:enter-end="opacity-100 translate-y-0">
                                <img src="{{ asset('images/screenshots/ss_clients.png') }}" alt="Client Directory"
                                    style="display:block; width:100%; margin-top:-85px;" />
                            </div>

                            <!-- Claims -->
                            <div x-show="activeTab === 'claims'" x-transition:enter="transition ease-out duration-500"
                                x-transition:enter-start="opacity-0 translate-y-2"
                                x-transition:enter-end="opacity-100 translate-y-0">
                                <img src="{{ asset('images/screenshots/ss_query_detail.png') }}" alt="Insurance Claims"
                                    style="display:block; width:100%; margin-top:-85px;" />
                            </div>

                            <!-- Policy Pulse: auto-scrolling -->
                            <div x-show="activeTab === 'renewals'" x-transition:enter="transition ease-out duration-500"
                                x-transition:enter-start="opacity-0 translate-y-2"
                                x-transition:enter-end="opacity-100 translate-y-0" class="scroll-animate">
                                <img src="{{ asset('images/screenshots/ss_priority_alerts.png') }}"
                                    alt="Priority Alerts" style="display:block; width:100%; margin-top:-85px;" />
                                <img src="{{ asset('images/screenshots/ss_celebration.png') }}" alt="Celebration Pulse"
                                    style="display:block; width:100%; margin-top:-85px;" />
                            </div>

                            <!-- Bottom gradient fade — blends screen into frame -->
                            <div class="absolute bottom-0 left-0 right-0 pointer-events-none"
                                style="height:100px; background: linear-gradient(to bottom, transparent 0%, rgba(15,23,42,0.95) 100%);">
                            </div>

                            <!-- Subtle top glow overlay -->
                            <div class="absolute top-0 left-0 right-0 pointer-events-none"
                                style="height:30px; background: linear-gradient(to bottom, rgba(99,102,241,0.05), transparent);">
                            </div>

                        </div>

                        <!-- Bottom Label -->
                        <div class="px-6 py-3 flex items-center justify-between"
                            style="background:rgba(15,23,42,0.95); border-top:1px solid rgba(255,255,255,0.04);">
                            <div class="flex gap-2">
                                <span class="text-[8px] font-black uppercase tracking-widest px-2 py-1 rounded-full"
                                    style="background:rgba(99,102,241,0.15); color:#a5b4fc;">Live System</span>
                                <span class="text-[8px] font-black uppercase tracking-widest px-2 py-1 rounded-full"
                                    style="background:rgba(16,185,129,0.1); color:#6ee7b7;">Multi-Tenant</span>
                            </div>
                            <span class="text-[8px] text-slate-600 uppercase tracking-widest font-bold dark:text-slate-300">NexoraByte Cloud
                                ERP</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Smart Services Tailored for Every Need (Product Suite) -->
    <section id="services" class="py-24 px-8 relative mt-8">
        <div class="max-w-7xl mx-auto">


            <div class="mb-16 text-center transform -translate-y-12">
                <span
                    class="text-indigo-400 text-[10px] font-bold uppercase tracking-[0.2em] mb-2 block animate-pulse">Our
                    Product Suite</span>
                <h2 class="text-4xl md:text-6xl font-extrabold text-white tracking-tight mb-4 capitalize">Smart Services
                    Tailored <br /> For Every Need</h2>
                <p class="text-slate-400 text-lg tracking-tight max-w-2xl mx-auto">We provide an end-to-end digital
                    ecosystem to automate your operations and amplify your brand presence.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Digital Marketing -->
                <div class="crystal-card rounded-[2rem] p-10 flex flex-col group relative overflow-hidden">
                    <div
                        class="absolute -right-10 -top-10 w-40 h-40 bg-indigo-500/10 rounded-full blur-3xl group-hover:bg-indigo-500/20 transition-all duration-500">
                    </div>
                    <div
                        class="w-14 h-14 bg-indigo-500/10 rounded-2xl flex items-center justify-center mb-8 border border-indigo-500/20 text-indigo-400 relative z-10">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-4 tracking-tight relative z-10">Data-Driven <br />
                        Marketing</h3>
                    <p class="text-slate-400 text-sm leading-relaxed mb-8 relative z-10">Premium SEO, targeted ad
                        campaigns, and high-conversion social media strategies that guarantee maximum ROI and explosive
                        brand growth.</p>
                    <ul
                        class="space-y-3 mt-auto text-[11px] font-bold uppercase tracking-wider text-slate-300 relative z-10">
                        <li class="flex items-center gap-3"><span class="text-indigo-500">❖</span> Lead Generation Pro
                        </li>
                        <li class="flex items-center gap-3"><span class="text-indigo-500">❖</span> Enterprise SEO</li>
                        <li class="flex items-center gap-3"><span class="text-indigo-500">❖</span> Brand Positioning
                        </li>
                    </ul>
                </div>

                <!-- Custom Websites -->
                <div class="crystal-card rounded-[2rem] p-10 flex flex-col group relative overflow-hidden">
                    <div
                        class="absolute -right-10 -top-10 w-40 h-40 bg-cyan-500/10 rounded-full blur-3xl group-hover:bg-cyan-500/20 transition-all duration-500">
                    </div>
                    <div
                        class="w-14 h-14 bg-cyan-500/10 rounded-2xl flex items-center justify-center mb-8 border border-cyan-500/20 text-cyan-400 relative z-10">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-4 tracking-tight relative z-10">Premium <br /> Web
                        Development</h3>
                    <p class="text-slate-400 text-sm leading-relaxed mb-8 relative z-10">Bespoke, lightning-fast modern
                        websites tailored to capture attention, drive conversions, and perfectly encapsulate your brand
                        identity.</p>
                    <ul
                        class="space-y-3 mt-auto text-[11px] font-bold uppercase tracking-wider text-slate-300 relative z-10">
                        <li class="flex items-center gap-3"><span class="text-cyan-500">❖</span> Next-Gen Tech Stacks
                        </li>
                        <li class="flex items-center gap-3"><span class="text-cyan-500">❖</span> Conversion Optimized
                        </li>
                        <li class="flex items-center gap-3"><span class="text-cyan-500">❖</span> Server Maintenance</li>
                    </ul>
                </div>

                <!-- Cloud ERP -->
                <div
                    class="crystal-card rounded-[2rem] p-10 flex flex-col group relative overflow-hidden ring-1 ring-indigo-500/20">
                    <div
                        class="absolute -right-10 -top-10 w-40 h-40 bg-emerald-500/10 rounded-full blur-3xl group-hover:bg-emerald-500/20 transition-all duration-500">
                    </div>
                    <div
                        class="absolute top-6 right-6 bg-indigo-500 text-white text-[9px] font-black uppercase tracking-widest px-3 py-1 rounded-full shadow-lg z-10">
                        Flagship</div>
                    <div
                        class="w-14 h-14 bg-emerald-500/10 rounded-2xl flex items-center justify-center mb-8 border border-emerald-500/20 text-emerald-400 relative z-10">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-4 tracking-tight relative z-10">Specialized <br /> Cloud
                        ERP</h3>
                    <p class="text-slate-400 text-sm leading-relaxed mb-8 relative z-10">Our flagship NexoraByte SaaS
                        structure engineered for zero-friction administration, multi-tenant isolation, and flawless
                        internal operations.</p>
                    <ul
                        class="space-y-3 mt-auto text-[11px] font-bold uppercase tracking-wider text-slate-300 relative z-10">
                        <li class="flex items-center gap-3"><span class="text-emerald-500">❖</span> Workflow Automation
                        </li>
                        <li class="flex items-center gap-3"><span class="text-emerald-500">❖</span> Secured Data
                            Isolation</li>
                        <li class="flex items-center gap-3"><span class="text-emerald-500">❖</span> Intelligence Matrix
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Deep Dive Showcase: NexoraByte ERP -->
    <section
        class="py-24 px-8 border-t border-white/5 bg-gradient-to-b from-slate-900/40 to-[#020617] overflow-hidden relative">
        <div
            class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxjaXJjbGUgY3g9IjIuNSIgY3k9IjIuNSIgcj0iMSIgZmlsbD0icmdiYSgyNTUsMjU1LDI1NSwwLjAyKSIvPjwvZz48L3N2Zz4=')]">
        </div>
        <div class="max-w-7xl mx-auto flex flex-col lg:flex-row items-center gap-16 relative z-10">
            <!-- Left Side: Content -->
            <div class="flex-1 space-y-8">
                <span
                    class="text-emerald-400 text-[10px] font-bold uppercase tracking-[0.2em] bg-emerald-500/10 px-3 py-1 rounded-full border border-emerald-500/20">Flagship
                    Software Showcase</span>
                <h2 class="text-4xl md:text-5xl font-extrabold text-white tracking-tight leading-[1.1]">NexoraByte Cloud
                    ERP: <br /><span class="text-slate-400">Powerful Where It Counts.</span></h2>
                <p class="text-slate-400 text-lg leading-relaxed pt-2">
                    Originally engineered exclusively for high-performing insurance agencies, NexoraByte is our premium
                    multi-tenant enterprise solution. See how our bespoke software manages the workflows that dictate
                    your growth.
                </p>

                <div class="space-y-6 pt-6">
                    <!-- Feature Item -->
                    <div class="flex gap-5 group">
                        <div
                            class="flex-shrink-0 w-14 h-14 bg-indigo-500/10 rounded-2xl flex items-center justify-center border border-indigo-500/20 text-indigo-400 group-hover:bg-indigo-500 group-hover:text-white transition-all">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-white font-bold text-lg mb-1">Centralised Client Management</h4>
                            <p class="text-slate-500 text-sm leading-relaxed dark:text-slate-400">Real-time tracking of individual
                                portfolios, automated policy ingestion, and flawless role-based security isolation.</p>
                        </div>
                    </div>
                    <!-- Feature Item -->
                    <div class="flex gap-5 group">
                        <div
                            class="flex-shrink-0 w-14 h-14 bg-emerald-500/10 rounded-2xl flex items-center justify-center border border-emerald-500/20 text-emerald-400 group-hover:bg-emerald-500 group-hover:text-white transition-all">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-white font-bold text-lg mb-1">Automated Pulse Engine</h4>
                            <p class="text-slate-500 text-sm leading-relaxed dark:text-slate-400">Never miss a critical date. Intelligent
                                systems automatically trigger renewal reminders and direct WhatsApp client greetings.
                            </p>
                        </div>
                    </div>
                    <!-- Feature Item -->
                    <div class="flex gap-5 group">
                        <div
                            class="flex-shrink-0 w-14 h-14 bg-cyan-500/10 rounded-2xl flex items-center justify-center border border-cyan-500/20 text-cyan-400 group-hover:bg-cyan-500 group-hover:text-white transition-all">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-white font-bold text-lg mb-1">Deep Diagnostic Analytics</h4>
                            <p class="text-slate-500 text-sm leading-relaxed dark:text-slate-400">Granular oversight across your entire
                                operational timeline with interactive query charts and claim visualization.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side: Premium ERP Screenshot Frame -->
            <div class="flex-1 relative w-full flex justify-center lg:justify-end mt-12 lg:mt-0">
                <div class="relative w-full max-w-lg">
                    <!-- Ambient glow -->
                    <div
                        class="absolute inset-x-10 bottom-0 top-20 bg-indigo-600/25 blur-[90px] rounded-full pointer-events-none">
                    </div>

                    <!-- Outer ring glow -->
                    <div class="absolute -inset-1 rounded-[2rem] blur-sm"
                        style="background: linear-gradient(135deg, rgba(99,102,241,0.3), rgba(14,165,233,0.15));"></div>

                    <!-- Browser frame (clean HTML chrome, no screenshot's browser UI) -->
                    <div class="relative rounded-[1.75rem] overflow-hidden transform rotate-2 hover:rotate-0 transition-transform duration-700"
                        style="border: 1px solid rgba(99,102,241,0.25); box-shadow: 0 30px 80px -10px rgba(0,0,0,0.7);">

                        <!-- Top bar -->
                        <div class="h-11 flex items-center px-5 justify-between"
                            style="background:#0f172a; border-bottom:1px solid rgba(255,255,255,0.05);">
                            <div class="flex gap-1.5">
                                <div class="w-2.5 h-2.5 rounded-full" style="background:#FF5F56;"></div>
                                <div class="w-2.5 h-2.5 rounded-full" style="background:#FFBD2E;"></div>
                                <div class="w-2.5 h-2.5 rounded-full" style="background:#27C93F;"></div>
                            </div>
                            <div class="flex items-center gap-1.5 px-4 py-1 rounded-full"
                                style="background:rgba(99,102,241,0.1); border:1px solid rgba(99,102,241,0.2);">
                                <div class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></div>
                                <span
                                    class="text-[8px] font-bold text-slate-400 uppercase tracking-widest">nexorabyte.in/dashboard</span>
                            </div>
                            <div class="w-10"></div>
                        </div>

                        <!-- Screenshot cropped (margin-top: -85px removes browser chrome) -->
                        <div style="overflow:hidden; position:relative; max-height:420px;">
                            <img src="{{ asset('images/screenshots/ss_dashboard_full.png') }}"
                                alt="NexoraByte ERP Dashboard" style="display:block; width:100%; margin-top:-85px;" />
                            <!-- Bottom fade -->
                            <div
                                style="position:absolute; bottom:0; left:0; right:0; height:80px; background:linear-gradient(to bottom, transparent, #0f172a); pointer-events:none;">
                            </div>
                        </div>
                    </div>

                    <!-- Floating module badges -->
                    <div class="absolute -right-6 top-16 bg-slate-900 rounded-2xl border p-3.5 transform rotate-3 z-20"
                        style="border-color:rgba(99,102,241,0.25); box-shadow: 0 20px 40px rgba(0,0,0,0.5);">
                        <div class="flex items-center gap-2.5 mb-2">
                            <div class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-black transition-all group-hover:bg-emerald-500 group-hover:text-white"
                                style="background:rgba(16,185,129,0.2); color:#34d399;">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M3 12h3L9 3l6 18 3-9h3" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-[10px] text-white font-bold">Priority Diagnostic</div>
                                <div class="text-[8px]" style="color:#6ee7b7;">● Live Pulse Active</div>
                            </div>
                        </div>
                        <div class="flex gap-1 flex-wrap">
                            <span class="text-[7px] font-black uppercase tracking-widest px-2 py-0.5 rounded-full"
                                style="background:rgba(99,102,241,0.15); color:#a5b4fc;">Clients</span>
                            <span class="text-[7px] font-black uppercase tracking-widest px-2 py-0.5 rounded-full"
                                style="background:rgba(16,185,129,0.12); color:#6ee7b7;">Claims</span>
                            <span class="text-[7px] font-black uppercase tracking-widest px-2 py-0.5 rounded-full"
                                style="background:rgba(245,158,11,0.12); color:#fcd34d;">Renewals</span>
                        </div>
                    </div>

                    <!-- Second floating badge -->
                    <div class="absolute -left-6 -bottom-4 bg-slate-900 rounded-2xl border p-3 z-20"
                        style="border-color:rgba(16,185,129,0.25); box-shadow: 0 20px 40px rgba(0,0,0,0.5);">
                        <div class="text-[8px] font-black uppercase tracking-widest mb-1" style="color:#6ee7b7;">
                            Intelligence</div>
                        <div class="text-white text-lg font-black leading-none">2 Alerts</div>
                        <div class="text-[7px] mt-1" style="color:#94a3b8;">Real-time · Live</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section (Mirroring Billing Page) -->
    <section id="pricing" class="py-24 bg-white/5 border-y border-white/5 px-8">
        <div class="max-w-7xl mx-auto">
            <div class="mb-12 text-center">
                <h2 class="text-4xl md:text-5xl font-extrabold text-white tracking-tight mb-4 uppercase">Choose Your
                    Plan</h2>
                <p class="text-slate-500 text-lg uppercase font-bold tracking-widest opacity-60 dark:text-slate-400">Pay once. Access your
                    workspace. Scale infinitely.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 w-full max-w-6xl mx-auto" x-data="welcomeCheckout">

                <!-- Trial Plan (One-Time) -->
                <div
                    class="bg-slate-900/40 backdrop-blur border border-emerald-800 rounded-[2rem] p-8 relative flex flex-col justify-between hover:border-emerald-500 transition-all crystal-card">
                    <div
                        class="absolute -top-4 inset-x-0 mx-auto w-max bg-emerald-500 text-emerald-950 font-black text-[10px] uppercase tracking-widest px-4 py-1.5 rounded-full shadow-lg">
                        One-Time Trial
                    </div>
                    <div>
                        <h3 class="text-2xl font-extrabold text-white uppercase tracking-widest mb-1">Try It Out</h3>
                        <p class="text-slate-400 text-[10px] font-bold uppercase tracking-widest mb-6 opacity-60">2
                            Months Access</p>
                        <div class="flex items-baseline gap-1 mb-8 border-b border-white/5 pb-6">
                            <span class="text-5xl font-extrabold text-white">₹99</span>
                            <span class="text-slate-500 text-xs font-bold uppercase tracking-widest dark:text-slate-400">/once</span>
                        </div>
                        <ul class="space-y-4 mb-8">
                            <li
                                class="flex items-center gap-3 text-[10px] text-slate-300 font-bold uppercase tracking-widest">
                                <span class="bg-emerald-500/20 p-1 rounded"><svg class="h-4 w-4 text-emerald-400"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg></span>
                                60 Days Full Access
                            </li>
                            <li
                                class="flex items-center gap-3 text-[10px] text-slate-300 font-bold uppercase tracking-widest">
                                <span class="bg-emerald-500/20 p-1 rounded"><svg class="h-4 w-4 text-emerald-400"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg></span>
                                All Core Modules
                            </li>
                            <li
                                class="flex items-center gap-3 text-[10px] text-slate-300 font-bold uppercase tracking-widest">
                                <span class="bg-emerald-500/20 p-1 rounded"><svg class="h-4 w-4 text-emerald-400"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg></span>
                                Upgrade Anytime
                            </li>
                        </ul>
                    </div>
                    <button @click="pay('trial')" :disabled="loadingPlan !== null"
                        class="w-full bg-slate-800/80 hover:bg-emerald-600 text-white text-[10px] font-black py-4 rounded-xl border border-emerald-800 hover:border-emerald-500 uppercase tracking-widest transition-all text-center elite-btn">
                        <span x-show="loadingPlan !== 'trial'">Try For ₹99</span>
                        <span x-show="loadingPlan === 'trial'" class="animate-pulse">Processing...</span>
                    </button>
                </div>

                <!-- Monthly Plan -->
                <div
                    class="bg-slate-900/40 backdrop-blur border border-white/5 rounded-[2rem] p-8 relative flex flex-col justify-between hover:border-indigo-500 transition-all crystal-card">
                    <div>
                        <h3 class="text-2xl font-extrabold text-white uppercase tracking-widest mb-1">Starter</h3>
                        <p class="text-slate-400 text-[10px] font-bold uppercase tracking-widest mb-6 opacity-60">
                            Monthly Plan</p>
                        <div class="flex items-baseline gap-1 mb-8 border-b border-white/5 pb-6">
                            <span class="text-5xl font-extrabold text-white">₹999</span>
                            <span class="text-slate-500 text-xs font-bold uppercase tracking-widest dark:text-slate-400">/mo</span>
                        </div>
                        <ul class="space-y-4 mb-8">
                            <li
                                class="flex items-center gap-3 text-[10px] text-slate-300 font-bold uppercase tracking-widest">
                                <span class="bg-indigo-500/20 p-1 rounded"><svg class="h-4 w-4 text-indigo-400"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg></span>
                                Unlimited Clients
                            </li>
                            <li
                                class="flex items-center gap-3 text-[10px] text-slate-300 font-bold uppercase tracking-widest">
                                <span class="bg-indigo-500/20 p-1 rounded"><svg class="h-4 w-4 text-indigo-400"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg></span>
                                Unlimited Staff Accounts
                            </li>
                            <li
                                class="flex items-center gap-3 text-[10px] text-slate-300 font-bold uppercase tracking-widest">
                                <span class="bg-indigo-500/20 p-1 rounded"><svg class="h-4 w-4 text-indigo-400"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg></span>
                                Priority Support
                            </li>
                        </ul>
                    </div>
                    <button @click="pay('monthly')" :disabled="loadingPlan !== null"
                        class="w-full bg-slate-800/80 hover:bg-indigo-600 text-white text-[10px] font-black py-4 rounded-xl border border-white/5 hover:border-indigo-500 uppercase tracking-widest transition-all text-center elite-btn">
                        <span x-show="loadingPlan !== 'monthly'">Pay ₹999/mo</span>
                        <span x-show="loadingPlan === 'monthly'" class="animate-pulse">Processing...</span>
                    </button>
                </div>

                <!-- Yearly Plan (Aligned & Matched) -->
                <div
                    class="bg-gradient-to-b from-indigo-600 to-indigo-900 border border-indigo-500 rounded-[2rem] p-8 relative flex flex-col justify-between shadow-2xl crystal-card">
                    <div
                        class="absolute -top-4 inset-x-0 mx-auto w-max bg-amber-500 text-amber-950 font-black text-[10px] uppercase tracking-widest px-4 py-1.5 rounded-full shadow-lg">
                        Best Value — 2 Months Free
                    </div>
                    <div>
                        <h3 class="text-2xl font-extrabold text-white uppercase tracking-widest mb-1">Professional</h3>
                        <p class="text-indigo-200 text-[10px] font-bold uppercase tracking-widest mb-6 opacity-60">
                            Annual Plan</p>
                        <div class="flex items-baseline gap-1 mb-8 border-b border-indigo-500/50 pb-6">
                            <span class="text-5xl font-extrabold text-white">₹9,990</span>
                            <span class="text-indigo-200 text-xs font-bold uppercase tracking-widest">/yr</span>
                        </div>
                        <ul class="space-y-4 mb-8">
                            <li
                                class="flex items-center gap-3 text-[10px] text-white font-bold uppercase tracking-widest">
                                <span class="bg-indigo-400/30 p-1 rounded border border-indigo-400"><svg
                                        class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg></span>
                                Everything in Starter
                            </li>
                            <li
                                class="flex items-center gap-3 text-[10px] text-white font-bold uppercase tracking-widest">
                                <span class="bg-indigo-400/30 p-1 rounded border border-indigo-400"><svg
                                        class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg></span>
                                Advanced API Access
                            </li>
                            <li
                                class="flex items-center gap-3 text-[10px] text-white font-bold uppercase tracking-widest">
                                <span class="bg-indigo-400/30 p-1 rounded border border-indigo-400"><svg
                                        class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg></span>
                                Dedicated Account Manager
                            </li>
                        </ul>
                    </div>
                    <button @click="pay('yearly')" :disabled="loadingPlan !== null"
                        class="w-full bg-indigo-950/50 hover:bg-white/10 text-white text-[10px] font-black py-4 rounded-xl border border-indigo-400/30 hover:border-white/20 uppercase tracking-widest transition-all text-center elite-btn">
                        <span x-show="loadingPlan !== 'yearly'">Pay ₹9,990/yr</span>
                        <span x-show="loadingPlan === 'yearly'" class="animate-pulse">Processing...</span>
                    </button>
                </div>
            </div>

            <!-- Standard Core Features -->
            <div class="mt-24 grid grid-cols-2 md:grid-cols-4 gap-8 max-w-5xl mx-auto opacity-40">
                <div class="text-center">
                    <div class="text-[9px] font-bold text-white uppercase tracking-widest mb-2">Security</div>
                    <div class="text-[7px] font-bold text-slate-500 uppercase tracking-widest italic dark:text-slate-400">AES-256 Isolation
                    </div>
                </div>
                <div class="text-center border-l border-white/5">
                    <div class="text-[9px] font-bold text-white uppercase tracking-widest mb-2">Backups</div>
                    <div class="text-[7px] font-bold text-slate-500 uppercase tracking-widest italic dark:text-slate-400">6-Hour Snapshots
                    </div>
                </div>
                <div class="text-center border-l border-white/5">
                    <div class="text-[9px] font-bold text-white uppercase tracking-widest mb-2">Uptime</div>
                    <div class="text-[7px] font-bold text-slate-500 uppercase tracking-widest italic dark:text-slate-400">99.9% Logic SLA
                    </div>
                </div>
                <div class="text-center border-l border-white/5">
                    <div class="text-[9px] font-bold text-white uppercase tracking-widest mb-2">Network</div>
                    <div class="text-[7px] font-bold text-slate-500 uppercase tracking-widest italic dark:text-slate-400">Global Edge Nodes
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="py-24 border-t border-white/5 bg-[#020617] relative">
        <div class="max-w-7xl mx-auto px-8 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 lg:gap-8 mb-16">
                <div class="md:col-span-2">
                    <a href="#" class="flex items-center gap-4 mb-6">
                        <img src="{{ asset('images/logo.png') }}?v=100" alt="logo" class="h-10 w-auto object-contain">
                        <span class="text-xl font-black text-white tracking-[0.2em] uppercase">NexoraByte Digital</span>
                    </a>
                    <p class="text-slate-400 text-sm leading-relaxed max-w-sm mb-8">
                        Elevating brands and optimizing operations through elite digital marketing, custom web
                        experiences, and specialized cloud ERP systems.
                    </p>
                    <div class="flex gap-4">
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center text-slate-400 hover:bg-indigo-500 hover:text-white transition-all"><svg
                                class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                            </svg></a>
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center text-slate-400 hover:bg-cyan-500 hover:text-white transition-all"><svg
                                class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                            </svg></a>
                    </div>
                </div>

                <div>
                    <h5 class="text-white font-bold tracking-widest uppercase text-xs mb-6">Our Services</h5>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-slate-400 text-sm hover:text-indigo-400 transition-colors">Digital
                                Marketing</a></li>
                        <li><a href="#" class="text-slate-400 text-sm hover:text-indigo-400 transition-colors">Web
                                Development</a></li>
                        <li><a href="#" class="text-slate-400 text-sm hover:text-indigo-400 transition-colors">SEO &
                                Lead Gen</a></li>
                        <li><a href="#" class="text-slate-400 text-sm hover:text-indigo-400 transition-colors">Cloud ERP
                                Solutions</a></li>
                    </ul>
                </div>

                <div>
                    <h5 class="text-white font-bold tracking-widest uppercase text-xs mb-6">Company</h5>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-slate-400 text-sm hover:text-indigo-400 transition-colors">About
                                Us</a></li>
                        <li><a href="#" class="text-slate-400 text-sm hover:text-indigo-400 transition-colors">Our
                                Process</a></li>
                        <li><a href="#"
                                class="text-slate-400 text-sm hover:text-indigo-400 transition-colors">Contact</a></li>
                        <li><a href="{{ route('login') }}"
                                class="text-slate-400 text-sm hover:text-indigo-400 transition-colors">Client/Staff
                                Login</a></li>
                    </ul>
                </div>
            </div>

            <div class="pt-8 border-t border-white/5 flex flex-col md:flex-row items-center justify-between gap-4">
                <p class="text-[10px] font-bold uppercase tracking-[0.2em] text-slate-600 dark:text-slate-300">&copy; {{ date('Y') }} NEXORABYTE
                    DIGITAL. ALL RIGHTS RESERVED.</p>
                <div class="flex gap-6">
                    <a href="#"
                        class="text-[10px] uppercase tracking-widest text-slate-600 hover:text-slate-400 dark:text-slate-300">Privacy</a>
                    <a href="#"
                        class="text-[10px] uppercase tracking-widest text-slate-600 hover:text-slate-400 dark:text-slate-300">Terms</a>
                </div>
            </div>
        </div>
    </footer>

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
                        const redirectUrl = isAuthenticated ? "{{ route('dashboard') }}" : "{{ route('register') }}?flow=onboarding&step=2";

                        const response = await fetch(endpoint, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({ plan: plan })
                        });

                        const data = await response.json();

                        if (!data.success) {
                            alert(data.message || 'Error initializing payment.');
                            this.loadingPlan = null;
                            return;
                        }

                        const options = {
                            "key": data.key,
                            "amount": data.amount,
                            "currency": "INR",
                            "name": "NexoraByte",
                            "description": "Subscription Plan: " + plan.charAt(0).toUpperCase() + plan.slice(1),
                            "image": "{{ asset('images/logo.png') }}",
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