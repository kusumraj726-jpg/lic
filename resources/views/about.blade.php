<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About Us | nexorabyte Digital Engineering</title>
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

        .glass-nav {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(40px) saturate(180%);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.05);
        }

        .crystal-card {
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.8);
            box-shadow: inset 0 0 20px rgba(255, 255, 255, 0.5);
            transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
        }

        .crystal-card:hover {
            border-color: rgba(244, 114, 182, 0.5);
            background: rgba(255, 255, 255, 0.9);
            transform: translateY(-8px);
        }

        .elite-btn {
            transition: all 0.3s cubic-bezier(0.23, 1, 0.32, 1);
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.8s cubic-bezier(0.23, 1, 0.32, 1) forwards;
        }

        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .m-nav-links { display: flex; align-items: center; gap: 1.5rem; }
        .m-hamburger { display: none; align-items: center; justify-content: center; width: 2.5rem; height: 2.5rem; background: rgba(255,255,255,0.85); border: 1px solid #e2e8f0; border-radius: 0.625rem; cursor: pointer; }
        .m-mobile-menu { display: none; }
        @media (max-width: 767px) {
            .m-nav-links { display: none !important; }
            .m-hamburger { display: flex !important; }
            .m-mobile-menu.open { display: flex !important; flex-direction: column; gap: 1rem; position: fixed; top: 4rem; left: 0; right: 0; background: rgba(255,255,255,0.97); backdrop-filter: blur(20px); border-bottom: 1px solid #f1f5f9; box-shadow: 0 10px 30px rgba(0,0,0,0.1); padding: 1.5rem; z-index: 60; }
            .m-mobile-menu.open a { font-size: 0.875rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em; color: #334155; text-decoration: none; padding: 0.5rem 0; border-bottom: 1px solid #f1f5f9; }
            .m-mobile-menu.open a:last-child { border-bottom: none; background: #0f172a; color: white; padding: 0.75rem 1.5rem; border-radius: 0.75rem; text-align: center; }
            h1 { font-size: 2.5rem !important; line-height: 1.1 !important; }
            main { padding-left: 1rem !important; padding-right: 1rem !important; padding-top: 5.5rem !important; padding-bottom: 3rem !important; }
            .crystal-card { padding: 1.25rem !important; border-radius: 1.5rem !important; }
        }
        @media (max-width: 480px) { h1 { font-size: 2rem !important; } }
    </style>
</head>

<body class="antialiased selection:bg-rose-500 selection:text-white">
    <!-- Premium Background Layers -->
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
    <nav style="position:fixed;width:100%;top:0;left:0;z-index:50;height:4rem;display:flex;align-items:center;background:rgba(255,255,255,0.85);backdrop-filter:blur(40px);border-bottom:1px solid rgba(255,255,255,0.3);box-shadow:0 10px 30px -10px rgba(0,0,0,0.05);">
        <div style="max-width:80rem;margin:0 auto;width:100%;padding:0 1rem;display:flex;justify-content:space-between;align-items:center;height:4rem;">
            <a href="/" style="display:flex;align-items:center;gap:0.75rem;text-decoration:none;">
                <img src="{{ asset('images/company_logo.jpg') }}" alt="nexorabyte" class="h-11 w-auto object-contain" style="filter: url(#chroma-key-black) contrast(1.1);">
                <span style="font-size:1rem;font-weight:900;color:#0f172a;letter-spacing:0.15em;">nexorabyte</span>
            </a>
            <div class="m-nav-links" style="display:flex;align-items:center;gap:1.5rem;">
                <a href="{{ route('services') }}" style="font-size:0.6875rem;font-weight:600;text-transform:uppercase;letter-spacing:0.1em;color:#374151;text-decoration:none;">Services</a>
                <a href="{{ route('force-login') }}" style="background:#0f172a;color:white;font-size:0.6875rem;font-weight:700;padding:0.625rem 1.5rem;border-radius:9999px;text-transform:uppercase;letter-spacing:0.1em;text-decoration:none;">Sign In</a>
            </div>
            <button id="ab-hamburger" class="m-hamburger" aria-label="Menu">
                <svg id="ab-ham" style="width:1.25rem;height:1.25rem;color:#374151;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                <svg id="ab-cls" style="display:none;width:1.25rem;height:1.25rem;color:#374151;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <div id="ab-menu" class="m-mobile-menu">
            <a href="{{ route('services') }}">Services</a>
            <a href="{{ route('force-login') }}">Sign In</a>
        </div>
    </nav>
    <script>(function(){var b=document.getElementById('ab-hamburger'),m=document.getElementById('ab-menu'),h=document.getElementById('ab-ham'),c=document.getElementById('ab-cls');if(!b)return;b.addEventListener('click',function(){var o=m.classList.toggle('open');h.style.display=o?'none':'block';c.style.display=o?'block':'none';});document.addEventListener('click',function(e){if(!b.contains(e.target)&&!m.contains(e.target)){m.classList.remove('open');h.style.display='block';c.style.display='none';}});})();</script>

    <main class="pt-44 pb-24 px-8">
        <div class="max-w-5xl mx-auto">
            <!-- Hero -->
            <div class="text-center mb-24 animate-fade-in-up">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-rose-500/10 border border-rose-500/20 text-rose-600 text-[10px] font-black uppercase tracking-[0.3em] mb-8">
                    The Studio Vision • Architectural Integrity
                </div>
                <h1 class="text-6xl md:text-8xl font-extrabold text-slate-900 mb-8 tracking-tighter leading-tight">
                    Architecting <br/> <span class="text-transparent bg-clip-text bg-gradient-to-r from-rose-600 to-pink-600">Digital Excellence.</span>
                </h1>
                <p class="text-lg md:text-2xl text-slate-700 font-medium max-w-3xl mx-auto leading-relaxed">
                    nexorabyte is a premier digital studio focusing on the intersection of technical precision and operational strategy. We build the digital backbone that moves enterprises forward.
                </p>
            </div>

            <!-- Focus Sections -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-32">
                <div class="crystal-card p-12 rounded-[3.5rem] animate-fade-in-up delay-100">
                    <h3 class="text-2xl font-black text-slate-900 mb-6 uppercase tracking-tighter">Our Core Goal</h3>
                    <p class="text-slate-700 leading-relaxed font-medium mb-6">
                        To eliminate the "administrative friction" that stalls growth. We believe your software should be an invisible employee—a bespoke catalyst that operates with perfect precision, allowing you to focus on strategy, not systems.
                    </p>
                    <div class="flex items-center gap-4 text-[10px] font-black uppercase tracking-widest text-rose-600">
                        <span class="w-8 h-px bg-rose-200"></span>
                        Precision Engineering
                    </div>
                </div>

                <div class="crystal-card p-12 rounded-[3.5rem] animate-fade-in-up delay-200">
                    <h3 class="text-2xl font-black text-slate-900 mb-6 uppercase tracking-tighter">The Objective</h3>
                    <p class="text-slate-700 leading-relaxed font-medium mb-6">
                        We aim to scale enterprises through elastic, intelligent digital architecture. Whether it is a bespoke ERP system or a high-traffic web presence, we deliver unyielding scalability and immutable security by default.
                    </p>
                    <div class="flex items-center gap-4 text-[10px] font-black uppercase tracking-widest text-indigo-600">
                        <span class="w-8 h-px bg-indigo-200"></span>
                        Enterprise Scaling
                    </div>
                </div>
            </div>


            <!-- The Studio Stack -->
            <div class="mb-32 py-24 bg-slate-900/5 rounded-[4rem] border border-slate-200/50 px-12">
                <div class="flex flex-col lg:flex-row items-center gap-16">
                    <div class="lg:w-1/3">
                        <h3 class="text-3xl font-black text-slate-900 mb-6 uppercase tracking-tighter">The Studio Stack</h3>
                        <p class="text-slate-600 font-medium leading-relaxed">Our arsenal is composed of high-performance technologies selected for their stability and extreme horizontal scaling capabilities.</p>
                    </div>
                    <div class="lg:w-2/3 grid grid-cols-2 sm:grid-cols-4 gap-6 w-full">
                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 text-center group hover:bg-slate-900 transition-all">
                            <div class="text-[10px] font-black uppercase tracking-widest text-slate-400 group-hover:text-slate-500 mb-2">Frontend</div>
                            <div class="text-xs font-bold text-slate-900 group-hover:text-white">React & Next.js</div>
                        </div>
                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 text-center group hover:bg-slate-900 transition-all">
                            <div class="text-[10px] font-black uppercase tracking-widest text-slate-400 group-hover:text-slate-500 mb-2">Backend</div>
                            <div class="text-xs font-bold text-slate-900 group-hover:text-white">Laravel & Node</div>
                        </div>
                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 text-center group hover:bg-slate-900 transition-all">
                            <div class="text-[10px] font-black uppercase tracking-widest text-slate-400 group-hover:text-slate-500 mb-2">Data</div>
                            <div class="text-xs font-bold text-slate-900 group-hover:text-white">Postgres & Redis</div>
                        </div>
                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 text-center group hover:bg-slate-900 transition-all">
                            <div class="text-[10px] font-black uppercase tracking-widest text-slate-400 group-hover:text-slate-500 mb-2">Cloud</div>
                            <div class="text-xs font-bold text-slate-900 group-hover:text-white">AWS & Vercel</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Architectural Pillars Deep-Dive -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 mb-32">
                <div>
                    <div class="w-12 h-12 bg-rose-500/10 rounded-xl flex items-center justify-center text-rose-600 mb-6">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900 mb-4">Zero-Latency Performance</h4>
                    <p class="text-sm text-slate-600 leading-relaxed font-medium">We optimize every network request and line of logic to ensure your users experience instantaneous interactions, even across complex enterprise datasets.</p>
                </div>
                <div>
                    <div class="w-12 h-12 bg-indigo-500/10 rounded-xl flex items-center justify-center text-indigo-600 mb-6">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900 mb-4">Immutable Data Integrity</h4>
                    <p class="text-sm text-slate-600 leading-relaxed font-medium">Enterprise-grade protection is our baseline. Utilizing multi-tenant isolation and AES-256 encryption both at rest and in transit.</p>
                </div>
                <div>
                    <div class="w-12 h-12 bg-emerald-500/10 rounded-xl flex items-center justify-center text-emerald-600 mb-6">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900 mb-4">Elastic Scalability</h4>
                    <p class="text-sm text-slate-600 leading-relaxed font-medium">Your infrastructure should scale automatically to meet demand. We build systems that breathe with your operational requirements.</p>
                </div>
            </div>

            <!-- Philosophy -->
            <div class="text-center max-w-3xl mx-auto animate-fade-in-up delay-200">
                <h2 class="text-4xl font-extrabold text-slate-900 mb-8 tracking-tight">Zero Templates. <br/>Total Command.</h2>
                <p class="text-lg text-slate-600 leading-relaxed mb-12">
                    At nexorabyte, we reject the generic. Every line of code we engineer is a deliberate step toward performance and unyielding scalability. We don't just build tools; we build the future stability of your operation.
                </p>
                <div class="flex justify-center gap-8 border-t border-slate-100 pt-12">
                    <div class="text-center">
                        <div class="text-2xl font-black text-slate-900 uppercase">99.9%</div>
                        <div class="text-[9px] font-black uppercase tracking-widest text-slate-400 mt-2">Architecture SLA</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-black text-slate-900 uppercase">100%</div>
                        <div class="text-[9px] font-black uppercase tracking-widest text-slate-400 mt-2">Bespoke Logic</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-black text-slate-900 uppercase">24/7</div>
                        <div class="text-[9px] font-black uppercase tracking-widest text-slate-400 mt-2">Elite Support</div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer x-data="{}" class="py-20 border-t border-white/5 bg-[#0f111a] relative overflow-hidden">
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
                        <li><a href="{{ route('lifecycle') }}" class="text-slate-500 text-sm hover:text-rose-500 transition-all hover:pl-2">Our Lifecycle</a></li>
                        <li><a href="javascript:void(0)" @click="$dispatch('open-contact')" class="text-slate-500 text-sm hover:text-rose-500 transition-all hover:pl-2">Contact Us</a></li>
                    </ul>
                </div>
            </div>
            <div class="pt-8 border-t border-white/5 flex flex-col md:flex-row items-center justify-between gap-6">
                <p class="text-[9px] font-black tracking-[0.3em] text-slate-600 uppercase">&copy; {{ date('Y') }} nexorabyte. ARCHITECTING EXCELLENCE.</p>
                <div class="flex gap-8">
                    <a href="#" class="text-[9px] font-black uppercase tracking-[0.3em] text-slate-600 hover:text-white transition-colors">Privacy</a>
                    <a href="#" class="text-[9px] font-black uppercase tracking-[0.3em] text-slate-600 hover:text-white transition-colors">Terms</a>
                </div>
            </div>
        </div>
    </footer>
    <x-contact-modal />
</body>
</html>
