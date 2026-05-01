<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Our Lifecycle | nexorabyte Engineering Process</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon-nb.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">

    <!-- CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Cambria', Georgia, serif;
            background: #ffffff;
            color: #1e293b;
        }

        .premium-bg {
            position: fixed;
            inset: 0;
            z-index: -1;
            background: linear-gradient(135deg, #ffffff 0%, #ffe4e6 100%);
            overflow: hidden;
        }

        .aura {
            position: absolute;
            width: 100%;
            height: 100%;
            filter: blur(140px);
            opacity: 0.4;
        }

        .aura-1 {
            top: -10%;
            left: -10%;
            width: 70%;
            height: 70%;
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

        @keyframes auraMove {
            0% { transform: translate(-5%, -5%) scale(1); }
            100% { transform: translate(15%, 20%) scale(1.1); }
        }

        .grid-overlay {
            position: absolute;
            inset: 0;
            background-image: 
                linear-gradient(rgba(0, 0, 0, 0.02) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 0, 0, 0.02) 1px, transparent 1px);
            background-size: 50px 50px;
            mask-image: radial-gradient(circle at center, black, transparent 80%);
        }

        .glass-nav {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(40px) saturate(180%);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .stage-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(0, 0, 0, 0.05);
            transition: all 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .stage-card:hover {
            transform: translateY(-10px);
            border-color: rgba(37, 99, 235, 0.2);
            box-shadow: 0 30px 60px -12px rgba(0, 0, 0, 0.08);
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fade-in-up {
            animation: fadeInUp 1s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
    </style>
</head>

<body class="antialiased selection:bg-rose-500 selection:text-white">
    <!-- Background -->
    <div class="premium-bg">
        <div class="aura aura-1"></div>
        <div class="aura aura-2"></div>
        <div class="grid-overlay"></div>
    </div>

    <!-- SVG Filter for Logo Transparency -->
    <svg style="position: absolute; width: 0; height: 0;" aria-hidden="true">
        <filter id="chroma-key-black"><feColorMatrix type="matrix" values="1 0 0 0 0 0 1 0 0 0 0 0 1 0 0 1 1 1 0 -0.1" /></filter>
    </svg>

    <!-- Navigation -->
    <nav class="fixed w-full z-50 glass-nav h-16 flex items-center">
        <div class="max-w-7xl mx-auto w-full px-6 flex justify-between items-center">
            <div class="flex items-center gap-8">
                <a href="/" class="flex items-center gap-3">
                    <img src="{{ asset('images/company_logo.jpg') }}" alt="nexorabyte" class="h-11 w-auto object-contain" style="filter: url(#chroma-key-black) contrast(1.1);">
                    <span class="text-lg font-black text-slate-900 tracking-[0.2em]">nexorabyte</span>
                </a>
                <a href="/" class="hidden md:flex items-center gap-2 text-[10px] font-black uppercase tracking-[0.3em] text-slate-400 hover:text-rose-500 transition-colors">
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"/></svg>
                    BACK TO HOME
                </a>
            </div>
            <div class="flex items-center gap-6">
                <a href="{{ route('services') }}" class="text-[11px] font-semibold uppercase tracking-widest hover:text-rose-600 transition-colors">Services</a>
                <a href="{{ route('about') }}" class="text-[11px] font-semibold uppercase tracking-widest hover:text-rose-600 transition-colors">About</a>
                <a href="{{ route('force-login') }}" class="bg-slate-900 text-white text-[11px] font-bold px-6 py-2.5 rounded-full uppercase tracking-widest hover:bg-slate-800 transition-all">Sign In</a>
            </div>
        </div>
    </nav>

    <main class="pt-44 pb-32 px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Hero Header -->
            <div class="max-w-4xl mx-auto text-center mb-32 animate-fade-in-up">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-rose-500/10 border border-rose-500/20 text-rose-600 text-[9px] font-black uppercase tracking-[0.3em] mb-8 mx-auto">
                    The Engineering Standard
                </div>
                <h1 class="text-6xl md:text-8xl font-extrabold text-slate-900 mb-8 tracking-tighter leading-[0.9]">
                    Our <br/> <span class="text-transparent bg-clip-text bg-gradient-to-r from-rose-600 to-pink-600">Lifecycle.</span>
                </h1>
                <p class="text-xl text-slate-700 font-medium leading-relaxed max-w-3xl mx-auto">
                    At nexorabyte, we don't just write code; we architect systems. Our 4-stage lifecycle is a rigorous engineering methodology designed to ensure data integrity, operational velocity, and unyielding scalability.
                </p>
            </div>

            <!-- Stages Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-44">
                <!-- Stage 01 -->
                <div class="stage-card p-10 rounded-[2.5rem] flex flex-col h-full animate-fade-in-up" style="animation-delay: 0.1s">
                    <div class="text-[10px] font-black tracking-[0.3em] text-rose-600 uppercase mb-8 flex items-center gap-3">
                        <span class="w-2.5 h-2.5 rounded-full bg-rose-600 animate-pulse"></span>
                        Stage 01
                    </div>
                    <h3 class="text-2xl font-black text-slate-900 mb-6 uppercase tracking-tighter">Strategic <br/>Discovery</h3>
                    <p class="text-sm text-slate-800 leading-relaxed font-bold mb-8">
                        We begin by auditing your existing administrative systems to identify "friction points"—operational bottlenecks where human effort is wasted on repetitive logic.
                    </p>
                    <ul class="mt-auto space-y-3">
                        <li class="flex items-center gap-3 text-[11px] font-black text-slate-500 uppercase tracking-widest">
                            <svg class="w-3.5 h-3.5 text-rose-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            Friction Audit
                        </li>
                        <li class="flex items-center gap-3 text-[11px] font-black text-slate-500 uppercase tracking-widest">
                            <svg class="w-3.5 h-3.5 text-rose-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            Data Mapping
                        </li>
                    </ul>
                </div>

                <!-- Stage 02 -->
                <div class="stage-card p-10 rounded-[2.5rem] flex flex-col h-full animate-fade-in-up" style="animation-delay: 0.2s">
                    <div class="text-[10px] font-black tracking-[0.3em] text-pink-600 uppercase mb-8 flex items-center gap-3">
                        <span class="w-2.5 h-2.5 rounded-full bg-pink-600"></span>
                        Stage 02
                    </div>
                    <h3 class="text-2xl font-black text-slate-900 mb-6 uppercase tracking-tighter">Architectural <br/>Mapping</h3>
                    <p class="text-sm text-slate-800 leading-relaxed font-bold mb-8">
                        Our architects design the "Digital Backbone." We blueprint the schema using a high-altitude edge network philosophy, focusing on low latency and elastic scaling.
                    </p>
                    <ul class="mt-auto space-y-3">
                        <li class="flex items-center gap-3 text-[11px] font-black text-slate-500 uppercase tracking-widest">
                            <svg class="w-3.5 h-3.5 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            Schema Design
                        </li>
                        <li class="flex items-center gap-3 text-[11px] font-black text-slate-500 uppercase tracking-widest">
                            <svg class="w-3.5 h-3.5 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            Edge Strategy
                        </li>
                    </ul>
                </div>

                <!-- Stage 03 -->
                <div class="stage-card p-10 rounded-[2.5rem] flex flex-col h-full animate-fade-in-up" style="animation-delay: 0.3s">
                    <div class="text-[10px] font-black tracking-[0.3em] text-rose-700 uppercase mb-8 flex items-center gap-3">
                        <span class="w-2.5 h-2.5 rounded-full bg-rose-700"></span>
                        Stage 03
                    </div>
                    <h3 class="text-2xl font-black text-slate-900 mb-6 uppercase tracking-tighter">Precision <br/>Fabrication</h3>
                    <p class="text-sm text-slate-800 leading-relaxed font-bold mb-8">
                        The build phase. Our engineers craft bespoke logic using clean-room methodologies. Every line of code is optimized for stability and immutable protection.
                    </p>
                    <ul class="mt-auto space-y-3">
                        <li class="flex items-center gap-3 text-[11px] font-black text-slate-500 uppercase tracking-widest">
                            <svg class="w-3.5 h-3.5 text-rose-700" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            Bespoke Logic
                        </li>
                        <li class="flex items-center gap-3 text-[11px] font-black text-slate-500 uppercase tracking-widest">
                            <svg class="w-3.5 h-3.5 text-rose-700" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            Security Audit
                        </li>
                    </ul>
                </div>

                <!-- Stage 04 -->
                <div class="stage-card p-10 rounded-[2.5rem] flex flex-col h-full animate-fade-in-up" style="animation-delay: 0.4s">
                    <div class="text-[10px] font-black tracking-[0.3em] text-pink-700 uppercase mb-8 flex items-center gap-3">
                        <span class="w-2.5 h-2.5 rounded-full bg-pink-700"></span>
                        Stage 04
                    </div>
                    <h3 class="text-2xl font-black text-slate-900 mb-6 uppercase tracking-tighter">Elastic <br/>Optimization</h3>
                    <p class="text-sm text-slate-800 leading-relaxed font-bold mb-8">
                        Deployment is just the beginning. We perform continuous performance tuning and automated scaling to ensure your system grows with your operational pulse.
                    </p>
                    <ul class="mt-auto space-y-3">
                        <li class="flex items-center gap-3 text-[11px] font-black text-slate-500 uppercase tracking-widest">
                            <svg class="w-3.5 h-3.5 text-pink-700" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            Auto-Scaling
                        </li>
                        <li class="flex items-center gap-3 text-[11px] font-black text-slate-500 uppercase tracking-widest">
                            <svg class="w-3.5 h-3.5 text-pink-700" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            Live Monitoring
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Detailed Philosophy -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-24 items-center mb-32">
                <div class="animate-fade-in-up">
                    <h2 class="text-4xl font-extrabold text-slate-900 mb-8 tracking-tight">Built for Infinite Scale.</h2>
                    <p class="text-lg text-slate-700 leading-relaxed mb-8">
                        Templates are for the others. At nexorabyte, we believe that the unique operational pulse of your business cannot be captured by off-the-shelf solutions.
                    </p>
                    <p class="text-lg text-slate-700 leading-relaxed">
                        Our lifecycle ensures that every architectural decision is made with visibility into your long-term roadmap. We don't just provide software; we provide the permanent stability required for high-velocity growth.
                    </p>
                </div>
                <div class="relative animate-fade-in-up" style="animation-delay: 0.2s">
                    <div class="absolute inset-0 bg-rose-600/10 blur-[80px] rounded-full"></div>
                    <div class="relative bg-white/40 backdrop-blur-3xl border border-black/5 rounded-[3rem] p-12 overflow-hidden shadow-2xl">
                        <div class="grid grid-cols-2 gap-8">
                            <div>
                                <div class="text-3xl font-black text-slate-900 tracking-tighter mb-2">30%</div>
                                <div class="text-[9px] font-black uppercase tracking-widest text-slate-400">Avg. Friction Decrease</div>
                            </div>
                            <div>
                                <div class="text-3xl font-black text-slate-900 tracking-tighter mb-2">99.9%</div>
                                <div class="text-[9px] font-black uppercase tracking-widest text-slate-400">Architecture SLA</div>
                            </div>
                            <div>
                                <div class="text-3xl font-black text-slate-900 tracking-tighter mb-2">AES-256</div>
                                <div class="text-[9px] font-black uppercase tracking-widest text-slate-400">Security Standard</div>
                            </div>
                            <div>
                                <div class="text-3xl font-black text-slate-900 tracking-tighter mb-2">24/7</div>
                                <div class="text-[9px] font-black uppercase tracking-widest text-slate-400">Operational Pulse</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer x-data="{}" class="py-20 border-t border-white/5 bg-[#0f111a] relative overflow-hidden">
        <!-- Footer Aurora Glow -->
        <div class="absolute -bottom-48 left-1/2 -translate-x-1/2 w-full h-96 bg-rose-500/10 blur-[120px] rounded-full"></div>
        
        <div class="max-w-7xl mx-auto px-8 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 lg:gap-8 mb-16">
                <div class="md:col-span-2">
                    <div class="flex items-center gap-4 mb-6">
                        <img src="{{ asset('images/company_logo.jpg') }}" alt="nexorabyte" class="h-10 w-auto object-contain" style="filter: url(#chroma-key-black) contrast(1.1) brightness(1.2);">
                        <span class="text-xl font-black text-white tracking-[0.2em]">nexorabyte</span>
                    </div>
                    <p class="text-slate-400 text-sm leading-relaxed max-w-sm mb-8 font-medium">
                        Architecting the digital backbone of the modern enterprise through bespoke ERP logic, elite engineering, and immutable security.
                    </p>
                </div>

                <div>
                    <h5 class="text-white font-black tracking-[0.3em] uppercase text-[10px] mb-6">Our Services</h5>
                    <ul class="space-y-4">
                        <li><a href="{{ route('services.web-development') }}" class="text-slate-500 text-sm hover:text-rose-500 transition-all hover:pl-2">Customized Websites</a></li>
                        <li><a href="{{ route('services.insurance-erp') }}" class="text-slate-500 text-sm hover:text-rose-500 transition-all hover:pl-2">Insurance ERP Systems</a></li>
                    </ul>
                </div>

                <div>
                    <h5 class="text-white font-black tracking-[0.3em] uppercase text-[10px] mb-6">Studio</h5>
                    <ul class="space-y-4">
                        <li><a href="{{ route('about') }}" class="text-slate-500 text-sm hover:text-rose-500 transition-all hover:pl-2">About Us</a></li>
                        <li><a href="{{ route('lifecycle') }}" class="text-slate-500 text-sm hover:text-rose-500 transition-all hover:pl-2 underline decoration-rose-500/30 underline-offset-4">Our Lifecycle</a></li>
                        <li><a href="{{ route('contact') }}" class="text-slate-500 text-sm hover:text-rose-500 transition-all hover:pl-2">Contact Us</a></li>
                    </ul>
                </div>
            </div>

            <div class="pt-8 border-t border-white/5 flex flex-col md:flex-row items-center justify-between gap-6">
                <p class="text-[9px] font-black tracking-[0.3em] text-slate-600 uppercase">&copy; {{ date('Y') }} nexorabyte. ARCHITECTING EXCELLENCE.</p>
                <div class="flex gap-8">
                    <a href="{{ route('terms') }}" class="text-[9px] font-black uppercase tracking-[0.3em] text-slate-600 hover:text-white transition-colors">Terms & conditions</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
