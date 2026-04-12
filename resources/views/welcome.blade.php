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
            background: rgba(2, 6, 23, 0.95);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }
    </style>
</head>
<body class="bg-slate-950 text-slate-300 antialiased selection:bg-indigo-500 selection:text-white">

    <!-- Navigation -->
    <nav class="fixed w-full z-50 glass-nav">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/logo.png') }}" alt="Velora Logo" class="h-10 w-auto">
                    <span class="text-2xl font-black text-white tracking-widest uppercase">Velora</span>
                </div>
                
                <div class="hidden md:flex items-center gap-6">
                    <a href="#features" class="text-[10px] font-black text-slate-500 hover:text-white transition-colors uppercase tracking-[0.2em]">Features</a>
                    <a href="#pricing" class="text-[10px] font-black text-slate-500 hover:text-white transition-colors uppercase tracking-[0.2em]">Pricing</a>
                </div>

                <div class="flex items-center gap-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ route('dashboard') }}" class="text-[10px] font-black text-slate-400 hover:text-white uppercase tracking-widest">Dashboard</a>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-[10px] font-black text-slate-500 hover:text-red-400 uppercase tracking-widest">Logout</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="text-[10px] font-black text-slate-400 hover:text-white uppercase tracking-widest">Sign In</a>
                            @if (Route::has('get.started'))
                                <a href="{{ route('get.started') }}" class="bg-indigo-600 hover:bg-indigo-500 text-white text-[10px] font-black px-6 py-2.5 rounded-full uppercase tracking-widest shadow-lg shadow-indigo-600/20">Sign Up</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <main class="relative pt-40 pb-32 overflow-hidden text-center">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-900 border border-slate-800 text-slate-400 text-[10px] font-bold uppercase tracking-widest mb-10">
                <span class="w-1.5 h-1.5 rounded-full bg-indigo-500"></span>
                Velora ERP 2.0 is Live
            </div>
            
            <h1 class="text-6xl md:text-8xl font-black text-white tracking-tighter mb-8 leading-none uppercase">
                The Ultimate <br/>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-cyan-400">Command Center.</span>
            </h1>
            
            <p class="mt-4 max-w-2xl mx-auto text-lg text-slate-400 mb-20 uppercase tracking-widest font-medium opacity-80">
                Securely manage clients, automate renewals, and allocate staff from a single, beautifully engineered workspace.
            </p>
            
            <!-- Features Grid -->
            <div class="grid grid-cols-1 md:grid-cols-4 md:grid-rows-2 gap-4 max-w-6xl mx-auto text-left py-10">
                <div class="md:col-span-2 md:row-span-2 bg-slate-900/40 border border-slate-800 rounded-[2rem] p-10 flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 bg-indigo-600/10 rounded-xl flex items-center justify-center mb-10 border border-indigo-500/20">
                            <svg class="w-6 h-6 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" /></svg>
                        </div>
                        <h3 class="text-3xl font-black text-white mb-6 uppercase tracking-tighter">Revenue <br/>Architecture.</h3>
                        <p class="text-slate-500 text-sm leading-relaxed uppercase tracking-widest font-bold">Audited subscription cycles and real-time MRR tracking built into the core.</p>
                    </div>
                </div>

                <div class="md:col-span-2 bg-slate-900/40 border border-slate-800 rounded-[2rem] p-10 flex items-center gap-8">
                    <div class="w-20 h-20 bg-cyan-500/5 rounded-2xl flex items-center justify-center border border-cyan-500/10">
                        <svg class="w-8 h-8 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                    </div>
                    <div>
                        <h4 class="text-lg font-black text-white mb-1 uppercase tracking-tighter">Tenant Shield</h4>
                        <p class="text-slate-600 text-[10px] font-black uppercase tracking-[0.2em]">Data Isolation Logic.</p>
                    </div>
                </div>

                <div class="bg-indigo-600 rounded-[2rem] p-8 flex flex-col justify-end">
                    <h4 class="text-lg font-black text-white uppercase tracking-tighter">Auto-Renew</h4>
                    <p class="text-indigo-200 text-[10px] font-bold uppercase tracking-widest">Cycle 01</p>
                </div>

                <div class="bg-slate-900/40 border border-slate-800 rounded-[2rem] p-8 flex flex-col justify-end">
                    <h4 class="text-lg font-black text-white uppercase tracking-tighter">Staff Sync</h4>
                    <p class="text-slate-600 text-[10px] font-black uppercase tracking-widest">Multi-User</p>
                </div>
            </div>
        </div>
    </main>

    <!-- Pricing Section -->
    <section id="pricing" class="py-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="mb-20">
                <h3 class="text-4xl font-black text-white uppercase tracking-tight italic">Platform Logic.</h3>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
                <!-- Trial -->
                <div class="bg-slate-900/30 border border-slate-800 rounded-[3rem] p-12 flex flex-col">
                    <div class="text-[10px] font-black text-emerald-500 uppercase tracking-[0.3em] mb-4">Trial</div>
                    <div class="text-5xl font-black text-white mb-10 tracking-tighter">₹99</div>
                    <div class="space-y-4 mb-12 text-[10px] uppercase font-black text-slate-500 tracking-widest leading-relaxed">
                        <p>• 60 Days Full Access</p>
                        <p>• All Core ERP Modules</p>
                        <p>• Live Data Sync</p>
                    </div>
                    <a href="{{ route('get.started') }}" class="mt-auto bg-slate-800 hover:bg-slate-700 text-white text-[10px] font-black py-4 rounded-2xl uppercase tracking-[0.2em] transition-all">Sign Up Now</a>
                </div>

                <!-- Monthly -->
                <div class="bg-slate-900/30 border border-slate-800 rounded-[3rem] p-12 flex flex-col">
                    <div class="text-[10px] font-black text-indigo-400 uppercase tracking-[0.3em] mb-4">Starter</div>
                    <div class="text-5xl font-black text-white mb-10 tracking-tighter">₹999</div>
                    <div class="space-y-4 mb-12 text-[10px] uppercase font-black text-slate-500 tracking-widest leading-relaxed">
                        <p>• Unlimited Clients</p>
                        <p>• Unlimited Staff</p>
                        <p>• Standard Security</p>
                    </div>
                    <a href="{{ route('get.started') }}" class="mt-auto bg-slate-800 hover:bg-slate-700 text-white text-[10px] font-black py-4 rounded-2xl uppercase tracking-[0.2em] transition-all">Sign Up Now</a>
                </div>

                <!-- Pro -->
                <div class="bg-indigo-600 rounded-[3rem] p-12 flex flex-col shadow-2xl">
                    <div class="text-[10px] font-black text-indigo-200 uppercase tracking-[0.3em] mb-4">Pro</div>
                    <div class="text-5xl font-black text-white mb-10 tracking-tighter">₹9,990</div>
                    <div class="space-y-4 mb-12 text-[10px] uppercase font-black text-indigo-100 tracking-widest leading-relaxed">
                        <p>• Everything In Starter</p>
                        <p>• Custom Staff Logic</p>
                        <p>• Priority Support</p>
                        <p>• 2 Months Free</p>
                    </div>
                    <a href="{{ route('get.started') }}" class="mt-auto bg-white text-indigo-600 text-[10px] font-black py-4 rounded-2xl uppercase tracking-[0.2em] transition-all">Sign Up Yearly</a>
                </div>
            </div>
        </div>
    </section>

    <footer class="py-20 border-t border-slate-900 text-center">
        <p class="text-slate-700 text-[10px] font-black uppercase tracking-[0.4em]">
            &copy; {{ date('Y') }} Velora ERP Platform.
        </p>
    </footer>

</body>
</html>
