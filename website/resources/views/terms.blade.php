<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Terms & Conditions | nexorabyte Digital Engineering</title>
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

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.8s cubic-bezier(0.23, 1, 0.32, 1) forwards;
        }

        .terms-section h2 {
            font-family: 'Inter', sans-serif;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #0f172a;
            margin-bottom: 1.5rem;
            font-size: 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .terms-section h2 span {
            width: 2rem;
            height: 1px;
            background: #fda4af;
        }

        .terms-section p {
            line-height: 1.8;
            margin-bottom: 2rem;
            color: #475569;
            font-weight: 500;
        }

        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
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
            <div style="display:flex; align-items:center; gap:1.5rem;">
                <a href="/" style="display:flex;align-items:center;gap:0.75rem;text-decoration:none;">
                    <img src="{{ asset('images/company_logo.jpg') }}" alt="nexorabyte" class="h-10 w-auto object-contain" style="filter: url(#chroma-key-black) contrast(1.1) brightness(1.2);">
                    <span style="font-size:1rem;font-weight:900;color:#0f172a;letter-spacing:0.15em;">nexorabyte</span>
                </a>
                <a href="/" class="hidden md:flex items-center gap-2 text-[10px] font-black uppercase tracking-[0.3em] text-slate-400 hover:text-rose-500 transition-colors" style="text-decoration:none;">
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"/></svg>
                    BACK TO HOME
                </a>
            </div>
            <div class="hidden md:flex items-center gap-6">
                <a href="{{ route('services') }}" style="font-size:0.6875rem;font-weight:600;text-transform:uppercase;letter-spacing:0.1em;color:#374151;text-decoration:none;">Services</a>
                <a href="{{ route('force-login') }}" style="background:#0f172a;color:white;font-size:0.6875rem;font-weight:700;padding:0.625rem 1.5rem;border-radius:9999px;text-transform:uppercase;letter-spacing:0.1em;text-decoration:none;">Sign In</a>
            </div>
        </div>
    </nav>

    <main class="pt-44 pb-24 px-8">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="mb-20 animate-fade-in-up text-center">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-rose-500/10 border border-rose-500/20 text-rose-600 text-[10px] font-black uppercase tracking-[0.3em] mb-8">
                    Legal Framework • Architectural Integrity
                </div>
                <h1 class="text-5xl md:text-7xl font-extrabold text-slate-900 mb-8 tracking-tighter leading-tight">
                    Terms & <span class="text-transparent bg-clip-text bg-gradient-to-r from-rose-600 to-pink-600">Conditions.</span>
                </h1>
                <p class="text-lg text-slate-700 font-medium leading-relaxed max-w-2xl mx-auto">
                    By accessing nexorabyte’s digital infrastructure, you agree to operate within the parameters of this architectural agreement.
                </p>
            </div>

            <!-- Content -->
            <div class="crystal-card p-12 md:p-16 rounded-[3.5rem] animate-fade-in-up delay-100">
                <div class="terms-section">
                    <h2><span></span> 01. Acceptance of Terms</h2>
                    <p>
                        By engaging with nexorabyte's services, including our bespoke ERP ecosystems and web development frameworks, you acknowledge and agree to be bound by the terms specified herein. These terms govern all digital interactions and deployments managed by our studio.
                    </p>

                    <h2><span></span> 02. Service Architecture</h2>
                    <p>
                        nexorabyte provides high-performance digital engineering services. All deliverables, including customized ERP modules and web architectures, are engineered to specific operational requirements. We reserve the right to modify the technical stack or delivery methodology to ensure optimal system performance and security.
                    </p>

                    <h2><span></span> 03. Intellectual Property</h2>
                    <p>
                        The "nexorabyte" identity, logo, and proprietary architectural patterns remain the exclusive property of nexorabyte. Clients are granted a non-exclusive license to use the deployed solutions within their operational framework, subject to the terms of their specific service agreement.
                    </p>

                    <h2><span></span> 04. Immutable Security & Data</h2>
                    <p>
                        Security is our baseline. While we implement enterprise-grade protection, including AES-256 encryption and multi-tenant isolation, users are responsible for maintaining the confidentiality of their access credentials. nexorabyte is not liable for data breaches resulting from user-side security failures.
                    </p>

                    <h2><span></span> 05. Liability Limitations</h2>
                    <p>
                        nexorabyte engineers systems for high availability (99.9% SLA). However, we are not liable for indirect, incidental, or consequential damages resulting from system downtime or operational fragmentation outside our direct architectural control.
                    </p>

                    <h2><span></span> 06. Governing Law</h2>
                    <p>
                        These terms shall be governed by and construed in accordance with the laws of the jurisdiction in which nexorabyte operates. Any disputes arising from these terms will be subject to the exclusive jurisdiction of the local courts.
                    </p>
                </div>

                <div class="mt-12 pt-12 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-6">

                    <a href="javascript:void(0)" onclick="window.print()" class="text-[10px] font-black uppercase tracking-widest text-rose-600 hover:text-rose-500 transition-colors flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                        Print Terms
                    </a>
                </div>
            </div>
        </div>
    </main>

    <x-footer />
</body>
</html>
