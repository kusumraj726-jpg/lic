<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Get Started | Select Your Ecosystem</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

    <!-- CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Cambria', Georgia, serif;
            background: #f8fafc;
            color: #1e293b;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
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

        @keyframes auraMove {
            0% { transform: translate(-5%, -5%) scale(1); }
            100% { transform: translate(15%, 20%) scale(1.15); }
        }

        .grid-overlay {
            position: absolute;
            inset: 0;
            background-image: 
                linear-gradient(rgba(0, 0, 0, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 0, 0, 0.03) 1px, transparent 1px);
            background-size: 60px 60px;
            mask-image: radial-gradient(circle at center, black, transparent 90%);
        }

        .crystal-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
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
            box-shadow: 0 25px 50px -12px rgba(244, 114, 182, 0.15);
        }

        .elite-btn {
            transition: all 0.3s cubic-bezier(0.23, 1, 0.32, 1);
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.8s cubic-bezier(0.23, 1, 0.32, 1) forwards;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>

<body class="antialiased selection:bg-rose-500 selection:text-white">
    <div class="premium-bg">
        <div class="aura aura-1"></div>
        <div class="aura aura-2"></div>
        <div class="grid-overlay"></div>
    </div>

    <!-- SVG Filter for Logo Transparency -->
    <svg style="position: absolute; width: 0; height: 0;" aria-hidden="true">
        <filter id="chroma-key-black"><feColorMatrix type="matrix" values="1 0 0 0 0 0 1 0 0 0 0 0 1 0 0 1 1 1 0 -0.1" /></filter>
    </svg>

    <div class="flex-grow flex items-center justify-center py-20 px-8">
        <div class="max-w-6xl w-full">
            <div class="text-center mb-16 animate-fade-in-up">
                <a href="/" class="inline-flex items-center gap-4 mb-10 group">
                    <img src="{{ asset('images/company_logo.jpg') }}" alt="nexorabyte" class="h-12 w-auto object-contain" style="filter: url(#chroma-key-black) contrast(1.1);">
                    <span class="text-2xl font-black text-slate-900 tracking-[0.2em]">nexorabyte</span>
                </a>
                <h1 class="text-4xl md:text-6xl font-black text-slate-900 mb-6 uppercase tracking-tight">Select Your Pathway</h1>
                <p class="text-slate-600 font-medium text-lg max-w-2xl mx-auto uppercase tracking-widest text-[10px]">Which ecosystem shall we engineer for you today?</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                <!-- Customized Website -->
                <a href="{{ route('services.web-development') }}" class="crystal-card p-12 rounded-[4rem] group animate-fade-in-up delay-100 relative overflow-hidden">
                    <div class="absolute -right-20 -top-20 w-64 h-64 bg-rose-500/5 rounded-full blur-[100px] group-hover:bg-rose-500/10 transition-all duration-700"></div>
                    
                    <div class="w-20 h-20 rounded-3xl bg-rose-50 flex items-center justify-center text-rose-600 mb-10 border border-rose-100 group-hover:scale-110 transition-transform">
                        <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9-9c1.657 0 3 2.239 3 5s-1.343 5-3 5m0-10c-1.657 0-3 2.239-3 5s1.343 5 3 5m-5 10a9 9 0 01-9-9m9-9a9 9 0 01-9-9" /></svg>
                    </div>

                    <h2 class="text-3xl font-black text-slate-900 mb-6 uppercase tracking-tight">Customized Website</h2>
                    <p class="text-slate-500 font-medium leading-relaxed mb-10">
                        Bespoke web architectures, high-velocity performance, and elite engineering for modern digital brands.
                    </p>

                    <div class="flex items-center gap-4 text-rose-600 font-black text-[11px] uppercase tracking-[0.3em]">
                        Explore Engineering Workflow
                        <svg class="w-5 h-5 group-hover:translate-x-2 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                    </div>
                </a>

                <!-- Insurance ERP -->
                <a href="{{ route('services.insurance-erp') }}" class="crystal-card p-12 rounded-[4rem] group animate-fade-in-up delay-200 relative overflow-hidden">
                    <div class="absolute -right-20 -top-20 w-64 h-64 bg-indigo-500/5 rounded-full blur-[100px] group-hover:bg-indigo-500/10 transition-all duration-700"></div>

                    <div class="w-20 h-20 rounded-3xl bg-indigo-50 flex items-center justify-center text-indigo-600 mb-10 border border-indigo-100 group-hover:scale-110 transition-transform">
                        <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                    </div>

                    <h2 class="text-3xl font-black text-slate-900 mb-6 uppercase tracking-tight">Insurance ERP</h2>
                    <p class="text-slate-500 font-medium leading-relaxed mb-10">
                        Bespoke operational ecosystems, automated commission ledgers, and unified command for elite insurance agencies.
                    </p>

                    <div class="flex items-center gap-4 text-indigo-600 font-black text-[11px] uppercase tracking-[0.3em]">
                        Initialize ERP Protocol
                        <svg class="w-5 h-5 group-hover:translate-x-2 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <footer class="py-10 text-center border-t border-slate-100">
        <p class="text-[9px] font-black tracking-[0.4em] text-slate-400 uppercase">&copy; {{ date('Y') }} nexorabyte. ARCHITECTING EXCELLENCE.</p>
    </footer>
</body>

</html>
