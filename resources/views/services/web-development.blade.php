<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Custom Web Engineering | nexorabyte</title>
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
        body { font-family: 'Cambria', Georgia, serif; background: #f8fafc; color: #1e293b; }
        .premium-bg { position: fixed; inset: 0; z-index: -1; background: linear-gradient(135deg, #ffffff 0%, #ffe4e6 100%); overflow: hidden; }
        .aura { position: absolute; width: 100%; height: 100%; filter: blur(140px); opacity: 0.4; }
        .aura-1 { top: -20%; left: -10%; width: 60%; height: 60%; background: radial-gradient(circle, rgba(251, 113, 133, 0.4) 0%, transparent 70%); animation: auraMove 25s infinite alternate; }
        .aura-2 { bottom: -20%; right: -10%; width: 80%; height: 80%; background: radial-gradient(circle, rgba(251, 113, 133, 0.45) 0%, transparent 70%); animation: auraMove 30s infinite alternate-reverse; }
        .aura-3 { top: 30%; left: 50%; width: 50%; height: 50%; background: radial-gradient(circle, rgba(244, 114, 182, 0.5) 0%, transparent 70%); animation: auraMove 22s infinite alternate; filter: blur(120px); }
        @keyframes auraMove { 0% { transform: translate(-5%, -5%) scale(1); } 100% { transform: translate(15%, 20%) scale(1.15); } }
        .grid-overlay { position: absolute; inset: 0; background-image: linear-gradient(rgba(0, 0, 0, 0.03) 1px, transparent 1px), linear-gradient(90deg, rgba(0, 0, 0, 0.03) 1px, transparent 1px); background-size: 60px 60px; mask-image: radial-gradient(circle at center, black, transparent 90%); }
        .noise { position: absolute; inset: 0; background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 250 250' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.8' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)'/%3E%3C/svg%3E"); opacity: 0.04; mix-blend-mode: multiply; pointer-events: none; }
        .glass-nav { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(40px) saturate(180%); border-bottom: 1px solid rgba(255, 255, 255, 0.3); box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.05); }
        .crystal-card { background: rgba(255, 255, 255, 0.6); backdrop-filter: blur(12px); border: 1px solid rgba(255, 255, 255, 0.8); box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02), inset 0 0 20px rgba(255, 255, 255, 0.5); transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1); }
        .crystal-card:hover { border-color: rgba(244, 114, 182, 0.5); background: rgba(255, 255, 255, 0.9); transform: translateY(-12px); box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.05); }
        .elite-btn { transition: all 0.3s cubic-bezier(0.23, 1, 0.32, 1); }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        .animate-fade-in-up { animation: fadeInUp 0.8s cubic-bezier(0.23, 1, 0.32, 1) forwards; }
        /* ── Mobile Nav ── */
        .m-nav-links  { display: flex; align-items: center; gap: 1.5rem; }
        .m-hamburger  { display: none; align-items: center; justify-content: center; width: 2.5rem; height: 2.5rem; background: rgba(255,255,255,0.85); border: 1px solid #e2e8f0; border-radius: 0.625rem; cursor: pointer; }
        .m-mobile-menu { display: none; }
        @media (max-width: 1279px) {
            .m-nav-links  { display: none !important; }
            .m-hamburger  { display: flex !important; }
            .m-mobile-menu.open { display: flex !important; flex-direction: column; gap: 1rem; position: fixed; top: 4rem; left: 0; right: 0; background: rgba(255,255,255,0.97); backdrop-filter: blur(20px); border-bottom: 1px solid #f1f5f9; box-shadow: 0 10px 30px rgba(0,0,0,0.1); padding: 1.5rem; z-index: 60; }
            .m-mobile-menu.open a { font-size: 0.875rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em; color: #334155; text-decoration: none; padding: 0.5rem 0; border-bottom: 1px solid #f1f5f9; }
            .m-mobile-menu.open a:last-child { border-bottom: none; background: #e11d48; color: white; padding: 0.75rem 1.5rem; border-radius: 0.75rem; text-align: center; }
            h1 { font-size: 2.5rem !important; line-height: 1.15 !important; }
            section, main { padding-left: 1rem !important; padding-right: 1rem !important; padding-top: 5.5rem !important; }
            .crystal-card { padding: 1.25rem !important; border-radius: 1.5rem !important; }
        }
        @media (max-width: 480px) { h1 { font-size: 2rem !important; } }
        @media (max-width: 768px) {
            input, select, textarea {
                font-size: 16px !important;
            }
        }
    </style>
</head>

<body class="text-slate-700 antialiased selection:bg-rose-500 selection:text-white" x-data="{ 
    showConsultModal: false, 
    consultStep: 'form',
    isSubmitting: false,
    consultForm: {
        name: '',
        email: '',
        service: 'Custom Web Engineering',
        message: ''
    },
    async submitConsult() {
        this.isSubmitting = true;
        try {
            const response = await fetch('{{ route('consultation.store') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(this.consultForm)
            });
            if (response.ok) {
                this.consultStep = 'success';
            } else {
                alert('Submission failed. Please try again.');
            }
        } catch (error) {
            alert('An error occurred. Please try again.');
        } finally {
            this.isSubmitting = false;
        }
    }
}">
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
    <nav style="position:fixed;width:100%;top:0;left:0;z-index:50;height:4rem;display:flex;align-items:center;background:rgba(255,255,255,0.85);backdrop-filter:blur(40px);border-bottom:1px solid rgba(255,255,255,0.3);box-shadow:0 10px 30px -10px rgba(0,0,0,0.05);">
        <div style="max-width:80rem;margin:0 auto;width:100%;padding:0 1rem;display:flex;justify-content:space-between;align-items:center;height:4rem;">
            <div style="display:flex; align-items:center; gap:1.5rem;">
                <a href="/" style="display:flex;align-items:center;gap:0.75rem;text-decoration:none;">
                    <img src="{{ asset('images/company_logo.jpg') }}" alt="nexorabyte" class="h-11 w-auto object-contain" style="filter: url(#chroma-key-black) contrast(1.1);">
                    <span style="font-size:1rem;font-weight:900;color:#0f172a;letter-spacing:0.15em;">nexorabyte</span>
                </a>
                <a href="{{ route('services') }}" class="hidden md:flex items-center gap-2 text-[10px] font-black uppercase tracking-[0.3em] text-slate-400 hover:text-rose-500 transition-colors" style="text-decoration:none;">
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"/></svg>
                    BACK TO SERVICES
                </a>
            </div>
            <!-- Desktop links -->
            <div class="m-nav-links hidden xl:flex">
                <a href="#consultation-section" style="background:#e11d48;color:white;font-size:0.6875rem;font-weight:700;padding:0.625rem 1.5rem;border-radius:1rem;text-transform:uppercase;letter-spacing:0.1em;text-decoration:none;">Consult Now</a>
            </div>
            <!-- Hamburger -->
            <button id="wd-hamburger" class="m-hamburger" aria-label="Menu">
                <svg id="wd-ham" style="width:1.25rem;height:1.25rem;color:#374151;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                <svg id="wd-cls" style="display:none;width:1.25rem;height:1.25rem;color:#374151;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <!-- Mobile dropdown -->
        <div id="wd-menu" class="m-mobile-menu">
            <a href="{{ route('services') }}">← Back to Services</a>
            <a href="#consultation-section">Consult Now</a>
        </div>
    </nav>
    <script>
        (function(){var b=document.getElementById('wd-hamburger'),m=document.getElementById('wd-menu'),h=document.getElementById('wd-ham'),c=document.getElementById('wd-cls');if(!b)return;b.addEventListener('click',function(){var o=m.classList.toggle('open');h.style.display=o?'none':'block';c.style.display=o?'block':'none';});document.addEventListener('click',function(e){if(!b.contains(e.target)&&!m.contains(e.target)){m.classList.remove('open');h.style.display='block';c.style.display='none';}});})();
    </script>

    <!-- Hero -->
    <section class="pt-44 pb-24 px-8 text-center relative overflow-hidden">
        <div class="max-w-5xl mx-auto relative z-10">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-rose-50 border border-rose-100 text-rose-600 text-[10px] font-black uppercase tracking-[0.3em] mb-8 animate-fade-in-up">
                Architecture & Performance Velocity
            </div>
            <h1 class="text-6xl md:text-8xl font-extrabold text-slate-900 mb-8 leading-tight tracking-tight animate-fade-in-up delay-100">
                Custom Web <br/> <span class="text-transparent bg-clip-text bg-gradient-to-r from-rose-600 via-pink-600 to-rose-400 italic">Engineering.</span>
            </h1>
            <p class="text-lg md:text-2xl text-slate-700 font-medium max-w-3xl mx-auto mb-12 animate-fade-in-up delay-200">
                We don't just build websites; we engineer high-performance digital ecosystems designed to eliminate administrative friction and scale your business pulse.
            </p>
        </div>
    </section>

    <!-- Capabilities -->
    <section class="py-24 px-8 bg-white/30 backdrop-blur-sm">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16 animate-fade-in-up">
                <span class="text-[10px] font-black text-rose-600 uppercase tracking-[0.4em] mb-4 block">Core Competencies</span>
                <h2 class="text-4xl font-extrabold text-slate-900 tracking-tight">Strategic Engineering.</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <div class="crystal-card p-12 rounded-[3.5rem] relative overflow-hidden group animate-fade-in-up">
                    <div class="absolute -right-16 -top-16 w-48 h-48 bg-rose-500/5 rounded-full blur-[60px]"></div>
                    <div class="w-16 h-16 rounded-2xl bg-rose-50 flex items-center justify-center text-rose-600 mb-10 border border-rose-100 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" /></svg>
                    </div>
                    <h3 class="text-3xl font-black text-slate-900 mb-6 uppercase tracking-tight">Custom Tech Stacks</h3>
                    <p class="text-slate-600 leading-relaxed font-medium mb-10">Utilizing high-velocity frameworks like Laravel and React to build immutable backends and seamless frontends.</p>
                    <div class="flex flex-wrap gap-3">
                        <span class="px-4 py-1.5 rounded-full bg-white border border-slate-100 text-[10px] font-black text-slate-400 uppercase tracking-widest shadow-sm">Laravel</span>
                        <span class="px-4 py-1.5 rounded-full bg-white border border-slate-100 text-[10px] font-black text-slate-400 uppercase tracking-widest shadow-sm">React</span>
                        <span class="px-4 py-1.5 rounded-full bg-white border border-slate-100 text-[10px] font-black text-slate-400 uppercase tracking-widest shadow-sm">Edge Cloud</span>
                    </div>
                </div>

                <div class="crystal-card p-12 rounded-[3.5rem] relative overflow-hidden group animate-fade-in-up delay-100">
                    <div class="absolute -right-16 -top-16 w-48 h-48 bg-emerald-500/5 rounded-full blur-[60px]"></div>
                    <div class="w-16 h-16 rounded-2xl bg-emerald-50 flex items-center justify-center text-emerald-600 mb-10 border border-emerald-100 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                    </div>
                    <h3 class="text-3xl font-black text-slate-900 mb-6 uppercase tracking-tight">Performance First</h3>
                    <p class="text-slate-600 leading-relaxed font-medium mb-10">Every millisecond is an operational asset. We optimize for lightning-fast delivery and absolute security.</p>
                    <div class="flex flex-wrap gap-3">
                        <span class="px-4 py-1.5 rounded-full bg-white border border-slate-100 text-[10px] font-black text-slate-400 uppercase tracking-widest shadow-sm">99+ Core Web Vitals</span>
                        <span class="px-4 py-1.5 rounded-full bg-white border border-slate-100 text-[10px] font-black text-slate-400 uppercase tracking-widest shadow-sm">SEO Engineering</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Project Inquiry -->
    <section id="consultation-section" class="py-32 px-8 relative overflow-hidden bg-slate-50/50">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-rose-500/10 blur-[120px] rounded-full animate-pulse"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-indigo-500/10 blur-[120px] rounded-full animate-pulse delay-700"></div>
        
        <div class="max-w-6xl mx-auto relative z-10">
            <div class="crystal-card p-16 md:p-24 rounded-[4rem] text-center border-rose-100 shadow-2xl shadow-rose-100/20 relative overflow-hidden group">
                <!-- Precision Grid Overlay -->
                <div class="absolute inset-0 opacity-[0.03] pointer-events-none" style="background-image: radial-gradient(#e11d48 1px, transparent 1px); background-size: 30px 30px;"></div>
                
                <div class="relative z-10">
                    <div class="inline-flex items-center gap-3 px-4 py-2 rounded-full bg-rose-50 border border-rose-100 mb-10">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rose-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-rose-500"></span>
                        </span>
                        <span class="text-[9px] font-black text-rose-600 uppercase tracking-[0.3em]">Studio Connection Live</span>
                    </div>

                    <h2 class="text-5xl md:text-7xl font-black text-slate-950 mb-10 tracking-tighter uppercase leading-[0.95]">
                        Ready to Engineer Your <br/> 
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-rose-600 via-pink-600 to-rose-400 italic">Digital Future?</span>
                    </h2>
                    
                    <p class="text-slate-900 text-lg md:text-2xl font-bold mb-16 max-w-3xl mx-auto leading-relaxed opacity-80">
                        Consult with our studio to architect a web experience that scales with your ambition. We bridge the gap between complex logic and seamless execution.
                    </p>

                    <div class="flex flex-col md:flex-row items-center justify-center gap-8 mb-16">
                        <div class="flex items-center gap-3 group/item">
                            <div class="w-10 h-10 rounded-xl bg-white shadow-sm flex items-center justify-center text-rose-500 border border-slate-100 group-hover/item:scale-110 transition-transform">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                            </div>
                            <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Secure Logic</span>
                        </div>
                        <div class="h-px w-8 bg-slate-100 hidden md:block"></div>
                        <div class="flex items-center gap-3 group/item text-indigo-500">
                            <div class="w-10 h-10 rounded-xl bg-white shadow-sm flex items-center justify-center text-indigo-500 border border-slate-100 group-hover/item:scale-110 transition-transform">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                            </div>
                            <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">High Velocity</span>
                        </div>
                        <div class="h-px w-8 bg-slate-100 hidden md:block"></div>
                        <div class="flex items-center gap-3 group/item">
                            <div class="w-10 h-10 rounded-xl bg-white shadow-sm flex items-center justify-center text-emerald-500 border border-slate-100 group-hover/item:scale-110 transition-transform">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" /></svg>
                            </div>
                            <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Infinite Scale</span>
                        </div>
                    </div>

                    <button @click="showConsultModal = true" class="elite-btn bg-slate-950 text-white font-black px-16 py-6 rounded-2xl uppercase tracking-[0.3em] text-[12px] shadow-2xl hover:bg-rose-600 transition-all transform hover:scale-105 group-hover:shadow-rose-500/20 active:scale-95">
                        Consult Now
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Engineering Workflow -->
    <section class="py-24 px-8 border-y border-slate-100 bg-slate-50/30">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16 animate-fade-in-up">
                <span class="text-[10px] font-black text-rose-600 uppercase tracking-[0.4em] mb-4 block">The Lifecycle</span>
                <h2 class="text-4xl font-extrabold text-slate-900 tracking-tight">Engineering Workflow.</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="crystal-card p-10 rounded-[3rem] animate-fade-in-up">
                    <div class="text-rose-600 font-black mb-6 flex items-center gap-3"><span class="w-8 h-px bg-rose-200"></span> 01</div>
                    <h4 class="text-xl font-black text-slate-900 mb-4 uppercase">Discovery & Architecture</h4>
                    <p class="text-slate-600 text-sm leading-relaxed font-medium">We map your operational pulse to define a technical architecture that supports complex business logic and future scale.</p>
                </div>
                <div class="crystal-card p-10 rounded-[3rem] animate-fade-in-up delay-100">
                    <div class="text-rose-600 font-black mb-6 flex items-center gap-3"><span class="w-8 h-px bg-rose-200"></span> 02</div>
                    <h4 class="text-xl font-black text-slate-900 mb-4 uppercase">Bespoke Engineering</h4>
                    <p class="text-slate-600 text-sm leading-relaxed font-medium">No templates are used. We build custom React frontends and robust Laravel backends engineered for immutable security.</p>
                </div>
                <div class="crystal-card p-10 rounded-[3rem] animate-fade-in-up delay-200">
                    <div class="text-rose-600 font-black mb-6 flex items-center gap-3"><span class="w-8 h-px bg-rose-200"></span> 03</div>
                    <h4 class="text-xl font-black text-slate-900 mb-4 uppercase">Velocity Deployment</h4>
                    <p class="text-slate-600 text-sm leading-relaxed font-medium">Optimized delivery through Anycast CDNs and edge caching, ensuring your platform is fast for users globally from day one.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Specializations Grid -->
    <section class="py-24 px-8 relative overflow-hidden">
        <div class="max-w-7xl mx-auto relative z-10">
            <div class="text-center mb-16 animate-fade-in-up">
                <span class="text-[10px] font-black text-rose-600 uppercase tracking-[0.4em] mb-4 block">Our Focus</span>
                <h2 class="text-4xl font-extrabold text-slate-900 tracking-tight">Technical Specializations.</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                <div class="group animate-fade-in-up">
                    <h4 class="text-slate-900 font-bold text-lg mb-4 uppercase tracking-tight border-l-4 border-rose-500 pl-4">SaaS Ecosystems</h4>
                    <p class="text-slate-500 text-sm leading-relaxed font-medium">Multi-tenant platforms with complex subscription logic and robust data isolation for enterprise-grade software products.</p>
                </div>
                <div class="group animate-fade-in-up delay-100">
                    <h4 class="text-slate-900 font-bold text-lg mb-4 uppercase tracking-tight border-l-4 border-rose-500 pl-4">E-commerce Architectures</h4>
                    <p class="text-slate-500 text-sm leading-relaxed font-medium">High-conversion, custom-built shopping experiences designed for extreme traffic peaks and seamless payment integrations.</p>
                </div>
                <div class="group animate-fade-in-up delay-200">
                    <h4 class="text-slate-900 font-bold text-lg mb-4 uppercase tracking-tight border-l-4 border-rose-500 pl-4">Enterprise Portals</h4>
                    <p class="text-slate-500 text-sm leading-relaxed font-medium">Internal tools and client-facing portals designed to centralize administrative workflows and eliminate operational friction.</p>
                </div>
            </div>
        </div>
    </section>


    <!-- Consultation Modal -->
    <div x-show="showConsultModal" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="fixed inset-0 z-[100] flex items-center justify-center p-6 bg-slate-900/60 backdrop-blur-md"
         style="display: none;">
        
        <div class="crystal-card w-full max-w-2xl rounded-[3rem] p-12 relative overflow-hidden" @click.away="showConsultModal = false" style="font-family: 'Cambria', Georgia, serif;">
            <button @click="showConsultModal = false" class="absolute top-8 right-8 text-slate-400 hover:text-slate-900 transition-colors">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>

            <div x-show="consultStep === 'form'">
                <div class="mb-10">
                    <span class="text-[10px] font-black text-rose-600 uppercase tracking-[0.4em] mb-4 block">Discovery Protocol</span>
                    <h3 class="text-3xl font-black text-slate-950 tracking-tight uppercase">Studio Consultation</h3>
                </div>

                <form @submit.prevent="submitConsult()" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-widest mb-2 ml-4">Full Name</label>
                            <input type="text" required x-model="consultForm.name" placeholder="John Doe" class="w-full bg-white/50 border border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold focus:border-rose-500 focus:ring-0 transition-all">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-widest mb-2 ml-4">Business Email</label>
                            <input type="email" required x-model="consultForm.email" placeholder="john@company.com" class="w-full bg-white/50 border border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold focus:border-rose-500 focus:ring-0 transition-all">
                        </div>
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-widest mb-2 ml-4">Project Scope</label>
                        <select x-model="consultForm.service" class="w-full bg-white/50 border border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold focus:border-rose-500 focus:ring-0 transition-all appearance-none">
                            <option>Custom Web Engineering</option>
                            <option>SaaS Ecosystem Architecture</option>
                            <option>Enterprise ERP Integration</option>
                            <option>E-commerce Transformation</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-widest mb-2 ml-4">Message</label>
                        <textarea rows="4" x-model="consultForm.message" placeholder="Briefly describe your digital ambitions..." class="w-full bg-white/50 border border-slate-100 rounded-2xl px-6 py-4 text-sm font-bold focus:border-rose-500 focus:ring-0 transition-all"></textarea>
                    </div>
                    <button type="submit" 
                            :disabled="isSubmitting"
                            class="w-full elite-btn bg-rose-600 text-white font-black py-5 rounded-2xl uppercase tracking-[0.2em] text-[12px] shadow-2xl shadow-rose-200 hover:bg-rose-700 disabled:opacity-50">
                        <span x-show="!isSubmitting">Submit Request</span>
                        <span x-show="isSubmitting">Processing...</span>
                    </button>
                </form>
            </div>

            <div x-show="consultStep === 'success'" class="text-center py-10">
                <div class="w-20 h-20 bg-rose-50 text-rose-600 rounded-full flex items-center justify-center mx-auto mb-8 border border-rose-100 animate-bounce">
                    <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                </div>
                <h3 class="text-3xl font-extrabold text-slate-900 tracking-tight uppercase mb-4">Request Logged</h3>
                <p class="text-slate-600 font-medium mb-10">Our engineering lead will analyze your requirements and reach out within 24 hours.</p>
                <button @click="showConsultModal = false; consultStep = 'form'" class="elite-btn bg-slate-900 text-white font-black px-12 py-4 rounded-2xl uppercase tracking-[0.2em] text-[10px]">Close Protocol</button>
            </div>
        </div>
    </div>

    <footer x-data="{}" class="py-20 border-t border-white/5 bg-[#0f111a] relative overflow-hidden">
        <!-- Footer Aurora Glow -->
        <div class="absolute -bottom-48 left-1/2 -translate-x-1/2 w-full h-96 bg-rose-500/10 blur-[120px] rounded-full"></div>
        
        <div class="max-w-7xl mx-auto px-8 relative z-10">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-12 lg:gap-8 mb-16">
                <div class="col-span-2 md:col-span-2">
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