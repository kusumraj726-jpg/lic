<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Refund & Cancellation Policy | nexorabyte Digital Engineering</title>
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
        @keyframes auraMove { 0% { transform: translate(-5%, -5%) scale(1); } 100% { transform: translate(15%, 20%) scale(1.15); } }
        .grid-overlay { position: absolute; inset: 0; background-image: linear-gradient(rgba(0, 0, 0, 0.03) 1px, transparent 1px), linear-gradient(90deg, rgba(0, 0, 0, 0.03) 1px, transparent 1px); background-size: 60px 60px; mask-image: radial-gradient(circle at center, black, transparent 90%); }
        .crystal-card { background: rgba(255, 255, 255, 0.6); backdrop-filter: blur(12px); border: 1px solid rgba(255, 255, 255, 0.8); box-shadow: inset 0 0 20px rgba(255, 255, 255, 0.5); transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1); }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        .animate-fade-in-up { animation: fadeInUp 0.8s cubic-bezier(0.23, 1, 0.32, 1) forwards; }
        .terms-section h2 { font-family: 'Inter', sans-serif; font-weight: 900; text-transform: uppercase; letter-spacing: 0.1em; color: #0f172a; margin-bottom: 1.5rem; font-size: 1.25rem; display: flex; align-items: center; gap: 0.75rem; }
        .terms-section h2 span { width: 2rem; height: 1px; background: #fda4af; }
        .terms-section p { line-height: 1.8; margin-bottom: 2rem; color: #475569; font-weight: 500; }
    </style>
</head>

<body class="antialiased selection:bg-rose-500 selection:text-white">
    <!-- SVG Filter for Logo Transparency -->
    <svg style="position: absolute; width: 0; height: 0;" aria-hidden="true">
        <filter id="chroma-key-black">
            <feColorMatrix type="matrix" values="1 0 0 0 0 0 1 0 0 0 0 0 1 0 0 1 1 1 0 -0.1" />
        </filter>
    </svg>

    <div class="premium-bg"><div class="aura aura-1"></div><div class="aura aura-2"></div><div class="grid-overlay"></div></div>

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
        </div>
    </nav>

    <main class="pt-44 pb-24 px-8">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="mb-20 animate-fade-in-up text-center">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-rose-500/10 border border-rose-500/20 text-rose-600 text-[10px] font-black uppercase tracking-[0.3em] mb-8">
                    Consumer Protection • Transactional Logic
                </div>
                <h1 class="text-5xl md:text-7xl font-extrabold text-slate-900 mb-8 tracking-tighter leading-tight">
                    Refund & <span class="text-transparent bg-clip-text bg-gradient-to-r from-rose-600 to-pink-600">Cancellation.</span>
                </h1>
                <p class="text-lg text-slate-700 font-medium leading-relaxed max-w-2xl mx-auto">
                    We engineer for satisfaction. Our refund and cancellation policy is designed to be fair and transparent for all digital engineering services.
                </p>
            </div>

            <div class="crystal-card p-12 md:p-16 rounded-[3.5rem] animate-fade-in-up delay-100">
                <div class="terms-section">
                    <h2><span></span> 01. Cancellation Protocol</h2>
                    <p>
                        Subscriptions can be cancelled at any time through your dashboard. Upon cancellation, your access to the nexorabyte ecosystem will remain active until the end of your current billing cycle, after which the environment will be decommissioned.
                    </p>

                    <h2><span></span> 02. Refund Eligibility</h2>
                    <p>
                        Since nexorabyte provides non-tangible, irrevocable digital software (ERP access and web engineering), we generally do not issue refunds once the order is confirmed and the service is deployed.
                    </p>

                    <h2><span></span> 03. Exception Logic</h2>
                    <p>
                        In cases where the digital service is technically defective and cannot be resolved by our engineering team after thoroughly examining the issue over a reasonable number of business days, a partial or full refund may be processed at our studio's discretion.
                    </p>

                    <h2><span></span> 04. Trial Periods</h2>
                    <p>
                        We offer a 30-day trial for ₹1 to allow you to evaluate the architecture before committing to a full subscription. Fees paid for trials are non-refundable.
                    </p>

                    <h2><span></span> 05. Duplicate Payments</h2>
                    <p>
                        In the event of accidental duplicate payments, the excess amount will be refunded to the original payment source within 5-7 business days of being reported.
                    </p>
                </div>


            </div>
        </div>
    </main>

    <x-footer />
</body>

</html>
