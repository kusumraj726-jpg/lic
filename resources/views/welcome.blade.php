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
            
            <h1 class="text-5xl md:text-7xl font-black text-white tracking-tight mb-8 leading-tight uppercase">
                The Ultimate Command Center <br/>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-cyan-400">For Modern Businesses.</span>
            </h1>
            
            <p class="mt-4 max-w-2xl mx-auto text-xl text-slate-400 mb-12">
                Securely manage clients, automate renewals, and allocate staff from a single, beautifully engineered multi-tenant workspace.
            </p>
            
            <div class="flex flex-col sm:flex-row justify-center gap-4 mb-20">
                <a href="{{ route('get.started') }}" class="bg-indigo-600 hover:bg-indigo-500 text-white font-black px-8 py-4 rounded-2xl uppercase tracking-widest shadow-xl shadow-indigo-600/30 transition-all hover:-translate-y-1 block text-center">
                    Get Started
                </a>
                <a href="{{ route('login') }}" class="bg-slate-900 hover:bg-slate-800 border border-slate-700 text-white font-bold px-8 py-4 rounded-2xl uppercase tracking-widest transition-all hover:border-slate-500 block text-center">
                    Sign In
                </a>
            </div>
            
            <!-- Strategic Bento Grid (Filling the space logically) -->
            <div class="grid grid-cols-1 md:grid-cols-4 md:grid-rows-2 gap-4 max-w-6xl mx-auto text-left py-10">
                <!-- Large Revenue Card -->
                <div class="md:col-span-2 md:row-span-2 bg-slate-900 border border-indigo-500/20 rounded-[3rem] p-10 flex flex-col justify-between group hover:border-indigo-500/50 transition-all shadow-2xl relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-indigo-600/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div>
                        <div class="w-14 h-14 bg-indigo-600 rounded-2xl flex items-center justify-center mb-10 shadow-lg shadow-indigo-500/20">
                            <svg class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" /></svg>
                        </div>
                        <h3 class="text-4xl font-black text-white mb-6 uppercase tracking-tight leading-none">Revenue <br/>Architecture.</h3>
                        <p class="text-slate-400 text-lg leading-relaxed mb-6 font-medium">Built-in subscription auditing and real-time payment tracking. Monitor MRR/ARR growth with military precision.</p>
                    </div>
                </div>

                <!-- Secure Isolation Card -->
                <div class="md:col-span-2 bg-slate-900 border border-slate-800 rounded-[3rem] p-10 flex items-center gap-8 hover:border-cyan-500/30 transition-all group">
                    <div class="w-24 h-24 shrink-0 bg-cyan-500/10 rounded-3xl flex items-center justify-center border border-cyan-500/20 group-hover:bg-cyan-500/20">
                        <svg class="w-10 h-10 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                    </div>
                    <div>
                        <h4 class="text-xl font-black text-white mb-2 uppercase tracking-tight italic">Secure Isolation</h4>
                        <p class="text-slate-500 text-xs font-black uppercase tracking-widest leading-relaxed">Multi-tenant data partitioning built on elite security logic.</p>
                    </div>
                </div>

                <!-- Small Automation Card -->
                <div class="bg-indigo-600 p-8 rounded-[3rem] flex flex-col justify-center gap-6 shadow-2xl shadow-indigo-900/40 group hover:scale-[1.02] transition-transform">
                    <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <div>
                        <h4 class="text-lg font-black text-white uppercase tracking-tighter italic">Auto-Renew</h4>
                        <p class="text-indigo-200 text-[10px] font-bold uppercase tracking-widest">Automated Claim Cycles</p>
                    </div>
                </div>

                <!-- Small Staff logic Card -->
                <div class="bg-slate-900 border border-slate-800 rounded-[3rem] p-8 flex flex-col justify-center gap-6 hover:border-emerald-500/30 transition-all">
                    <div class="w-12 h-12 bg-emerald-500/10 rounded-2xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                    </div>
                    <div>
                        <h4 class="text-lg font-black text-white uppercase tracking-tighter italic">Staff Sync</h4>
                        <p class="text-slate-500 text-[10px] font-bold uppercase tracking-widest">Multi-User Logic</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Detailed Features -->
    <section id="features" class="py-32 bg-slate-950 relative border-t border-slate-900 border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-24">
                <h2 class="text-indigo-400 font-bold tracking-widest uppercase text-sm mb-4">Enterprise Operations</h2>
                <h3 class="text-4xl md:text-5xl font-black text-white tracking-tight uppercase italic">Built to Scale.</h3>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div class="bg-slate-900/50 border border-slate-800 rounded-[2.5rem] p-10 hover:border-indigo-500/50 transition-colors">
                    <div class="w-16 h-16 bg-indigo-500/10 rounded-3xl flex items-center justify-center mb-8">
                        <svg class="w-8 h-8 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                    </div>
                    <h4 class="text-2xl font-black text-white mb-4 uppercase tracking-tighter">Multi-Tenancy</h4>
                    <p class="text-slate-400 text-sm leading-relaxed uppercase tracking-wider font-bold opacity-60">Complete platform isolation for every advisor.</p>
                </div>
                
                <div class="bg-slate-900/50 border border-slate-800 rounded-[2.5rem] p-10 hover:border-cyan-500/50 transition-colors">
                    <div class="w-16 h-16 bg-cyan-500/10 rounded-3xl flex items-center justify-center mb-8">
                        <svg class="w-8 h-8 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" /></svg>
                    </div>
                    <h4 class="text-2xl font-black text-white mb-4 uppercase tracking-tighter">Query Engine</h4>
                    <p class="text-slate-400 text-sm leading-relaxed uppercase tracking-wider font-bold opacity-60">High-performance claim and query registration.</p>
                </div>
                
                <div class="bg-slate-900/50 border border-slate-800 rounded-[2.5rem] p-10 hover:border-purple-500/50 transition-colors">
                    <div class="w-16 h-16 bg-purple-500/10 rounded-3xl flex items-center justify-center mb-8">
                        <svg class="w-8 h-8 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <h4 class="text-2xl font-black text-white mb-4 uppercase tracking-tighter">Smart Renewal</h4>
                    <p class="text-slate-400 text-sm leading-relaxed uppercase tracking-wider font-bold opacity-60">Automated deadline tracking and reminders.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="py-32 relative overflow-hidden">
        <div class="absolute top-0 right-0 -mr-40 -mt-40 w-96 h-96 rounded-full bg-indigo-900/20 blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 -ml-40 -mb-40 w-96 h-96 rounded-full bg-cyan-900/20 blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="text-center mb-24">
                <h2 class="text-indigo-400 font-bold tracking-widest uppercase text-sm mb-4">Pricing Models</h2>
                <h3 class="text-4xl md:text-6xl font-black text-white tracking-tight uppercase">Scale Immediately.</h3>
                <p class="mt-6 text-slate-500 uppercase font-black tracking-widest text-xs">Fixed costs. Zero hidden fees.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
                <!-- Trial Plan -->
                <div class="pricing-card bg-slate-900 border border-emerald-800/30 rounded-[3rem] p-10 flex flex-col justify-between relative">
                    <div class="absolute -top-4 inset-x-0 mx-auto w-max bg-emerald-500 text-emerald-950 font-black text-[10px] uppercase tracking-widest px-5 py-2 rounded-full shadow-lg italic">The Trial Entrance</div>
                    <div>
                        <h4 class="text-2xl font-black text-white uppercase tracking-widest mb-2">Experimental</h4>
                        <p class="text-slate-500 text-xs font-black uppercase mb-8">60 Days Velocity</p>
                        <div class="flex items-baseline gap-2 mb-10 pb-10 border-b border-slate-800">
                            <span class="text-5xl font-black text-white tracking-tighter">₹99</span>
                            <span class="text-slate-600 font-black uppercase tracking-widest text-xs">/Once</span>
                        </div>
                        <ul class="space-y-4 mb-10">
                            <li class="flex items-center gap-3 text-slate-300 font-bold text-xs uppercase tracking-widest opacity-80"><svg class="w-4 h-4 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>60 Days Access</li>
                            <li class="flex items-center gap-3 text-slate-300 font-bold text-xs uppercase tracking-widest opacity-80"><svg class="w-4 h-4 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>All Core Modules</li>
                        </ul>
                    </div>
                    <a href="{{ route('get.started') }}" class="w-full bg-emerald-500/10 hover:bg-emerald-500 text-emerald-400 hover:text-white font-black py-5 rounded-2xl border border-emerald-500/30 transition-all uppercase tracking-widest text-xs">Sign Up for ₹99</a>
                </div>

                <!-- Monthly Plan -->
                <div class="pricing-card bg-slate-900 border border-slate-800 rounded-[3rem] p-10 flex flex-col justify-between">
                    <div>
                        <h4 class="text-2xl font-black text-white uppercase tracking-widest mb-2">Starter</h4>
                        <p class="text-slate-500 text-xs font-black uppercase mb-8">Monthly Velocity</p>
                        <div class="flex items-baseline gap-2 mb-10 pb-10 border-b border-slate-800">
                            <span class="text-6xl font-black text-white tracking-tighter">₹999</span>
                            <span class="text-slate-600 font-black uppercase tracking-widest text-xs">/Mo</span>
                        </div>
                        <ul class="space-y-5 mb-10 text-xs uppercase tracking-widest font-bold">
                            <li class="flex items-center gap-4 text-slate-300 opacity-80"><svg class="w-4 h-4 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Unlimited Clients</li>
                            <li class="flex items-center gap-4 text-slate-300 opacity-80"><svg class="w-4 h-4 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Unlimited Staff</li>
                        </ul>
                    </div>
                    <a href="{{ route('get.started') }}" class="w-full bg-slate-800 hover:bg-slate-700 text-white font-black py-5 rounded-2xl border border-slate-700 transition-all uppercase tracking-widest text-xs">Sign Up Now</a>
                </div>

                <!-- Yearly Plan -->
                <div class="pricing-card bg-gradient-to-b from-indigo-600 to-indigo-900 border border-indigo-500 rounded-[3rem] p-12 flex flex-col justify-between relative shadow-2xl shadow-indigo-900/50">
                    <div class="absolute -top-4 inset-x-0 mx-auto w-max bg-amber-500 text-amber-950 font-black text-[10px] uppercase tracking-widest px-6 py-2 rounded-full shadow-lg">2 Months Free</div>
                    <div>
                        <h4 class="text-3xl font-black text-white uppercase tracking-widest mb-2 italic">Pro</h4>
                        <p class="text-indigo-200 text-xs font-black uppercase mb-10 opacity-70">Annual Velocity</p>
                        <div class="flex items-baseline gap-2 mb-12 pb-12 border-b border-indigo-500/50">
                            <span class="text-6xl font-black text-white tracking-tighter">₹9,990</span>
                            <span class="text-indigo-300 font-black uppercase tracking-widest text-xs">/Yr</span>
                        </div>
                        <ul class="space-y-6 mb-12 text-xs uppercase tracking-widest font-black">
                            <li class="flex items-center gap-4 text-white"><svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Everything In Starter</li>
                            <li class="flex items-center gap-4 text-white opacity-90"><svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>Custom Staff Logic</li>
                        </ul>
                    </div>
                    <a href="{{ route('get.started') }}" class="w-full bg-white text-indigo-900 font-black py-6 rounded-[2rem] shadow-xl block text-center uppercase tracking-widest transition-transform hover:-translate-y-1 text-xs">Sign Up Yearly</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="border-t border-slate-900 bg-slate-950 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-10">
            <div class="flex items-center gap-4">
                <img src="{{ asset('images/logo.png') }}" alt="Velora Logo" class="h-8 w-auto opacity-30 grayscale filter">
                <span class="text-slate-600 font-black uppercase tracking-[0.3em] text-sm">Velora ERP Platform</span>
            </div>
            <p class="text-slate-700 text-xs font-black uppercase tracking-widest">
                &copy; {{ date('Y') }} Platform Control Systems. Designed for absolute scale.
            </p>
        </div>
    </footer>

</body>
</html>
