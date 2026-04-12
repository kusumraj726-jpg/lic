<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Velora ERP | The Ultimate Command Center</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Outfit', sans-serif; }
        .glass-nav {
            background: rgba(2, 6, 23, 0.85); /* slate-950 with opacity */
            backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }
        .hero-glow {
            position: absolute;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(79, 70, 229, 0.15) 0%, rgba(2, 6, 23, 0) 70%);
            top: -200px;
            left: 50%;
            transform: translateX(-50%);
            z-index: -1;
            pointer-events: none;
        }
        .pricing-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .pricing-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px -12px rgba(79, 70, 229, 0.25);
        }
    </style>
</head>
<body class="bg-slate-950 text-slate-300 antialiased selection:bg-indigo-500 selection:text-white">

    <!-- Navigation -->
    <nav class="fixed w-full z-50 glass-nav transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/logo.png') }}" alt="Velora Logo" class="h-10 w-auto object-contain">
                    <span class="text-2xl font-black text-white tracking-widest uppercase">Velora</span>
                </div>
                
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#features" class="text-sm font-bold text-slate-400 hover:text-white transition-colors uppercase tracking-widest">Features</a>
                    <a href="#pricing" class="text-sm font-bold text-slate-400 hover:text-white transition-colors uppercase tracking-widest">Pricing</a>
                    
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm font-black text-indigo-400 hover:text-indigo-300 transition-colors uppercase tracking-widest">Sign Up</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-bold text-slate-400 hover:text-white transition-colors uppercase tracking-widest">Sign In</a>
                        <a href="{{ route('get.started') }}" class="bg-indigo-600 hover:bg-indigo-500 text-white font-black text-xs px-6 py-2.5 rounded-full uppercase tracking-widest shadow-lg shadow-indigo-600/30 transition-all hover:-translate-y-0.5">Sign Up</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <main class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
        <div class="hero-glow"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative text-center">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 text-xs font-bold uppercase tracking-widest mb-8">
                <span class="w-2 h-2 rounded-full bg-indigo-500 animate-pulse"></span>
                Velora ERP 2.0 is Live
            </div>
            
            <h1 class="text-5xl md:text-7xl font-black text-white tracking-tight mb-8 leading-tight">
                The Ultimate Command Center <br/>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-cyan-400">For Modern Businesses.</span>
            </h1>
            
            <p class="mt-4 max-w-2xl mx-auto text-xl text-slate-400 mb-12">
                Securely manage clients, automate renewals, and allocate staff from a single, beautifully engineered multi-tenant workspace.
            </p>
            
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('get.started') }}" class="bg-indigo-600 hover:bg-indigo-500 text-white font-black px-8 py-4 rounded-2xl uppercase tracking-widest shadow-xl shadow-indigo-600/30 transition-all hover:-translate-y-1 block text-center">
                    Get Started
                </a>
                <a href="{{ route('login') }}" class="bg-slate-900 hover:bg-slate-800 border border-slate-700 text-white font-bold px-8 py-4 rounded-2xl uppercase tracking-widest transition-all hover:border-slate-500 block text-center">
                    Sign In
                </a>
            </div>
            
            <div class="mt-16 relative mx-auto max-w-5xl">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-transparent z-10 bottom-0 h-full w-full pointer-events-none"></div>
                <div class="rounded-2xl border border-slate-800 bg-slate-900/50 p-2 shadow-2xl backdrop-blur-sm">
                    <div class="h-[400px] md:h-[600px] w-full rounded-xl bg-slate-950 border border-slate-800 flex items-center justify-center overflow-hidden relative">
                        <!-- Mockup App UI inside hero -->
                        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-5"></div>
                        <div class="text-center z-10 w-full max-w-md p-8 border border-slate-800 rounded-3xl bg-slate-900 shadow-2xl">
                             <div class="flex items-center gap-4 mb-8">
                                <div class="w-12 h-12 bg-indigo-500 rounded-xl flex items-center justify-center">
                                    <img src="{{ asset('images/logo.png') }}" class="w-8 h-8 filter brightness-200">
                                </div>
                                <div class="text-left">
                                    <h3 class="text-white font-bold">Admin Console</h3>
                                    <p class="text-slate-400 text-xs">Secure Multi-Tenant Environment</p>
                                </div>
                             </div>
                             <div class="space-y-3">
                                 <div class="h-4 bg-slate-800 rounded w-full"></div>
                                 <div class="h-4 bg-slate-800 rounded w-5/6"></div>
                                 <div class="h-4 bg-slate-800 rounded w-4/6"></div>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Features Section -->
    <section id="features" class="py-24 bg-slate-950 relative border-t border-slate-900 border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <h2 class="text-indigo-400 font-bold tracking-widest uppercase text-sm mb-3">Enterprise Grade</h2>
                <h3 class="text-3xl md:text-4xl font-black text-white tracking-tight">Everything you need to scale.</h3>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-slate-900 border border-slate-800 rounded-3xl p-8 hover:border-indigo-500/50 transition-colors">
                    <div class="w-14 h-14 bg-indigo-500/10 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                    </div>
                    <h4 class="text-xl font-bold text-white mb-3">Multi-Tenant Isolation</h4>
                    <p class="text-slate-400 text-sm leading-relaxed">Absolute data privacy. Every client and staff member is securely partitioned within your unique workspace ecosystem.</p>
                </div>
                
                <!-- Feature 2 -->
                <div class="bg-slate-900 border border-slate-800 rounded-3xl p-8 hover:border-cyan-500/50 transition-colors">
                    <div class="w-14 h-14 bg-cyan-500/10 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" /></svg>
                    </div>
                    <h4 class="text-xl font-bold text-white mb-3">Claims & Query Engine</h4>
                    <p class="text-slate-400 text-sm leading-relaxed">Centralize support operations. Built-in helpdesk to register claims, track queries, and maintain crystal-clear resolution logs.</p>
                </div>
                
                <!-- Feature 3 -->
                <div class="bg-slate-900 border border-slate-800 rounded-3xl p-8 hover:border-purple-500/50 transition-colors">
                    <div class="w-14 h-14 bg-purple-500/10 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <h4 class="text-xl font-bold text-white mb-3">Automated Renewals</h4>
                    <p class="text-slate-400 text-sm leading-relaxed">Never miss a deadline. Automatically track client policy renewals, service expirations, and financial milestones effortlessly.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="py-24 relative overflow-hidden">
        <!-- Background gradients -->
        <div class="absolute top-0 right-0 -mr-40 -mt-40 w-96 h-96 rounded-full bg-indigo-900/20 blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 -ml-40 -mb-40 w-96 h-96 rounded-full bg-cyan-900/20 blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="text-center mb-20">
                <h2 class="text-indigo-400 font-bold tracking-widest uppercase text-sm mb-3">Transparent Pricing</h2>
                <h3 class="text-3xl md:text-5xl font-black text-white tracking-tight">Scale Without Boundaries.</h3>
                <p class="mt-4 text-slate-400">Fixed costs. No hidden fees. Start building your portfolio today.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 max-w-6xl mx-auto">
                <!-- Trial Plan -->
                <div class="pricing-card bg-slate-900 border border-emerald-800 rounded-[2rem] p-8 flex flex-col justify-between relative">
                    <div class="absolute -top-4 inset-x-0 mx-auto w-max bg-emerald-500 text-emerald-950 font-black text-[10px] uppercase tracking-widest px-4 py-1.5 rounded-full shadow-lg">One-Time Trial</div>
                    <div>
                        <h4 class="text-xl font-black text-white uppercase tracking-widest mb-2">Try It Out</h4>
                        <p class="text-slate-400 text-sm font-medium mb-6">60 Days Access</p>
                        <div class="flex items-baseline gap-2 mb-8 pb-8 border-b border-slate-800">
                            <span class="text-4xl font-black text-white">₹99</span>
                            <span class="text-slate-500 font-bold uppercase tracking-widest">/once</span>
                        </div>
                        <ul class="space-y-4 mb-8">
                            <li class="flex items-center gap-3 text-slate-300 font-bold text-sm"><span class="bg-emerald-500/20 p-1 rounded"><svg class="w-4 h-4 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg></span>60 Days Full Access</li>
                            <li class="flex items-center gap-3 text-slate-300 font-bold text-sm"><span class="bg-emerald-500/20 p-1 rounded"><svg class="w-4 h-4 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg></span>All Core Modules</li>
                            <li class="flex items-center gap-3 text-slate-300 font-bold text-sm"><span class="bg-emerald-500/20 p-1 rounded"><svg class="w-4 h-4 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg></span>Upgrade Anytime</li>
                        </ul>
                    </div>
                    <a href="{{ route('get.started') }}" class="w-full bg-slate-800 hover:bg-emerald-600 text-white font-black py-4 rounded-xl border border-emerald-800 hover:border-emerald-500 block text-center uppercase tracking-widest transition-colors">Try For ₹99</a>
                </div>
                <!-- Starter Plan -->
                <div class="pricing-card bg-slate-900 border border-slate-800 rounded-[2rem] p-8 flex flex-col justify-between">
                    <div>
                        <h4 class="text-2xl font-black text-white uppercase tracking-widest mb-2">Starter</h4>
                        <p class="text-slate-400 text-sm font-medium mb-8">Billed Monthly</p>
                        
                        <div class="flex items-baseline gap-2 mb-10 pb-10 border-b border-slate-800">
                            <span class="text-5xl font-black text-white">₹999</span>
                            <span class="text-slate-500 font-bold uppercase tracking-widest">/mo</span>
                        </div>

                        <ul class="space-y-5 mb-10">
                            <li class="flex items-center gap-4 text-slate-300 font-bold text-sm">
                                <span class="bg-indigo-500/20 p-1 rounded">
                                    <svg class="w-4 h-4 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                </span>
                                Unlimited Clients
                            </li>
                            <li class="flex items-center gap-4 text-slate-300 font-bold text-sm">
                                <span class="bg-indigo-500/20 p-1 rounded">
                                    <svg class="w-4 h-4 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                </span>
                                Unlimited Staff Accounts
                            </li>
                            <li class="flex items-center gap-4 text-slate-300 font-bold text-sm">
                                <span class="bg-indigo-500/20 p-1 rounded">
                                    <svg class="w-4 h-4 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                </span>
                                Standard Security & Support
                            </li>
                        </ul>
                    </div>
                    
                    <a href="{{ route('get.started') }}" class="w-full bg-slate-800 hover:bg-slate-700 text-white font-black py-4 rounded-xl border border-slate-700 block text-center uppercase tracking-widest transition-colors">
                        Start Monthly Plan
                    </a>
                </div>

                <!-- Professional Plan -->
                <div class="pricing-card bg-gradient-to-b from-indigo-600 to-indigo-900 border border-indigo-500 rounded-[2rem] p-10 flex flex-col justify-between relative shadow-2xl shadow-indigo-900/50">
                    <div class="absolute -top-4 inset-x-0 mx-auto w-max bg-amber-500 text-amber-950 font-black text-[10px] uppercase tracking-widest px-4 py-1.5 rounded-full shadow-lg">
                        Recommended: 2 Months Free
                    </div>
                    
                    <div>
                        <h4 class="text-2xl font-black text-white uppercase tracking-widest mb-2">Professional</h4>
                        <p class="text-indigo-200 text-sm font-medium mb-8">Billed Annually</p>
                        
                        <div class="flex items-baseline gap-2 mb-10 pb-10 border-b border-indigo-500/50">
                            <span class="text-5xl font-black text-white">₹9,990</span>
                            <span class="text-indigo-300 font-bold uppercase tracking-widest">/yr</span>
                        </div>

                        <ul class="space-y-5 mb-10">
                            <li class="flex items-center gap-4 text-white font-bold text-sm">
                                <span class="bg-indigo-400/30 p-1 rounded border border-indigo-400">
                                    <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                </span>
                                Everything in Starter
                            </li>
                            <li class="flex items-center gap-4 text-white font-bold text-sm">
                                <span class="bg-indigo-400/30 p-1 rounded border border-indigo-400">
                                    <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                </span>
                                Custom Staff Permissions
                            </li>
                            <li class="flex items-center gap-4 text-white font-bold text-sm">
                                <span class="bg-indigo-400/30 p-1 rounded border border-indigo-400">
                                    <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                </span>
                                Priority 24/7 Developer Support
                            </li>
                        </ul>
                    </div>
                    
                    <a href="{{ route('get.started') }}" class="w-full bg-white text-indigo-900 font-black py-4 rounded-xl shadow-lg block text-center uppercase tracking-widest transition-transform hover:-translate-y-1">
                        Start Yearly Plan
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="border-t border-slate-900 bg-slate-950 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="flex items-center gap-2">
                <img src="{{ asset('images/logo.png') }}" alt="Velora Logo" class="h-6 w-auto opacity-50 grayscale">
                <span class="text-slate-500 font-bold uppercase tracking-widest text-sm">Velora ERP</span>
            </div>
            <p class="text-slate-600 text-sm font-medium">
                &copy; {{ date('Y') }} All rights reserved. Designed for performance.
            </p>
        </div>
    </footer>

</body>
</html>
