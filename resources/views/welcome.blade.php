<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Velora ERP | Elite Command Center</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">

    <!-- CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #020617;
        }

        .mesh-bg {
            background-image:
                radial-gradient(at 0% 0%, hsla(243, 75%, 59%, 0.15) 0px, transparent 50%),
                radial-gradient(at 100% 0%, hsla(180, 100%, 50%, 0.1) 0px, transparent 50%),
                radial-gradient(at 50% 100%, hsla(243, 75%, 59%, 0.05) 0px, transparent 50%);
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
    </style>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>

<body class="mesh-bg text-slate-400 antialiased selection:bg-indigo-500 selection:text-white">

    <!-- Navigation -->
    <nav class="fixed w-full z-50 glass-nav h-20 flex items-center">
        <div class="max-w-7xl mx-auto w-full px-8 flex justify-between items-center">
            <a href="{{ route('dashboard') }}" class="sidebar-logo flex items-center gap-4">
                <img src="{{ asset('images/logo.png') }}?v=100" alt="logo" class="h-16 w-auto object-contain">
                <span class="text-2xl font-black text-white tracking-[0.2em] uppercase">Velora</span>
            </a>

            <div class="flex items-center gap-10">
                <div
                    class="hidden lg:flex items-center gap-8 text-[11px] font-semibold text-slate-500 uppercase tracking-widest">
                    <a href="#features" class="hover:text-white transition-colors">Features</a>
                    <a href="#pricing" class="hover:text-white transition-colors">Pricing</a>
                </div>

                <div class="flex items-center gap-6">
                    @auth
                        <a href="{{ route('dashboard') }}"
                            class="text-[11px] font-semibold uppercase tracking-widest hover:text-white transition-colors">Sign
                            In</a>
                        <a href="{{ route('billing.index') }}"
                            class="elite-btn bg-indigo-600 shadow-lg shadow-indigo-600/20 text-white text-[11px] font-bold px-6 py-2.5 rounded-full uppercase tracking-widest hover:bg-indigo-500">Sign
                            Up</a>
                    @else
                        <a href="{{ route('login') }}"
                            class="text-[11px] font-semibold uppercase tracking-widest hover:text-white transition-colors">Sign
                            In</a>
                        <a href="{{ route('get.started') }}"
                            class="elite-btn bg-indigo-600 shadow-lg shadow-indigo-600/20 text-white text-[11px] font-bold px-6 py-2.5 rounded-full uppercase tracking-widest hover:bg-indigo-500">Sign
                            Up</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-40 pb-12 text-center relative border-b border-white/[0.02]">
        <div class="max-w-5xl mx-auto px-8">
            <h1 class="text-6xl md:text-8xl font-black text-white mb-6 leading-[0.9] tracking-tight">
                MANAGEMENT <br />
                <span
                    class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-300 via-indigo-400 to-cyan-400 italic">RE-ENGINEERED.</span>
            </h1>
            <div class="space-y-6 mt-10 max-w-2xl mx-auto">
                <p class="text-lg text-slate-400 font-medium tracking-tight leading-relaxed opacity-80 uppercase">
                    A high-performance command center designed for rapid scale, isolated security, and total operational
                    clarity.
                </p>
                <div class="pt-6 flex flex-col items-center gap-3">
                    <div class="h-px w-10 bg-indigo-500/30"></div>
                    <span class="text-[8px] font-black text-indigo-500 uppercase tracking-[0.6em]">Enterprise Security •
                        Infinite Scale</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section (Rich Content, Not Big Boxes) -->
    <section id="features" class="py-20 px-8">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Card 1 -->
                <div class="crystal-card rounded-[2.5rem] p-12 flex flex-col min-h-[400px]">
                    <div
                        class="w-10 h-10 bg-indigo-500/10 rounded-xl flex items-center justify-center mb-8 border border-indigo-500/10 text-indigo-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                    </div>
                    <h3
                        class="text-2xl font-bold text-white mb-4 tracking-tight uppercase italic underline decoration-indigo-500/30 underline-offset-8">
                        Business Core.</h3>
                    <p class="text-slate-500 text-[11px] font-medium leading-relaxed tracking-wide mb-8">Unifying your
                        entire operational ecosystem with precision resource planning and real-time oversight.</p>
                    <ul class="space-y-3 mt-auto text-[9px] font-bold uppercase tracking-[0.2em] text-slate-400/70">
                        <li class="flex items-center gap-3"><span class="w-1 h-1 bg-indigo-500 rounded-full"></span>
                            Dynamic Asset Lifecycle</li>
                        <li class="flex items-center gap-3"><span class="w-1 h-1 bg-indigo-500 rounded-full"></span>
                            Automated Ledger Balance</li>
                        <li class="flex items-center gap-3"><span class="w-1 h-1 bg-indigo-500 rounded-full"></span>
                            End-to-End Workflow Sync</li>
                    </ul>
                </div>

                <!-- Card 2 -->
                <div class="crystal-card rounded-[2.5rem] p-12 flex flex-col min-h-[400px]">
                    <div
                        class="w-10 h-10 bg-cyan-500/10 rounded-xl flex items-center justify-center mb-8 border border-cyan-500/10 text-cyan-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                            </path>
                        </svg>
                    </div>
                    <h3
                        class="text-2xl font-bold text-white mb-4 tracking-tight uppercase italic underline decoration-cyan-500/30 underline-offset-8">
                        Tenant Shield.</h3>
                    <p class="text-slate-500 text-[11px] font-medium leading-relaxed tracking-wide mb-8">Absolute data
                        isolation for multi-tenant enterprise environments.</p>
                    <ul class="space-y-3 mt-auto text-[9px] font-bold uppercase tracking-[0.2em] text-slate-400/70">
                        <li class="flex items-center gap-3"><span class="w-1 h-1 bg-cyan-500 rounded-full"></span>
                            AES-256 Row Isolation</li>
                        <li class="flex items-center gap-3"><span class="w-1 h-1 bg-cyan-500 rounded-full"></span>
                            Identity Token Validation</li>
                        <li class="flex items-center gap-3"><span class="w-1 h-1 bg-cyan-500 rounded-full"></span>
                            Secure Vault Access</li>
                    </ul>
                </div>

                <!-- Card 3 -->
                <div class="crystal-card rounded-[2.5rem] p-12 flex flex-col min-h-[400px]">
                    <div
                        class="w-10 h-10 bg-emerald-500/10 rounded-xl flex items-center justify-center mb-8 border border-emerald-500/10 text-emerald-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3
                        class="text-2xl font-bold text-white mb-4 tracking-tight uppercase italic underline decoration-emerald-500/30 underline-offset-8">
                        Staff Intelligence.</h3>
                    <p class="text-slate-500 text-[11px] font-medium leading-relaxed tracking-wide mb-8">Advanced
                        workforce synchronization and permission matrix logic.</p>
                    <ul class="space-y-3 mt-auto text-[9px] font-bold uppercase tracking-[0.2em] text-slate-400/70">
                        <li class="flex items-center gap-3"><span class="w-1 h-1 bg-emerald-500 rounded-full"></span>
                            Custom Auth Gateways</li>
                        <li class="flex items-center gap-3"><span class="w-1 h-1 bg-emerald-500 rounded-full"></span>
                            Activity Performance Logs</li>
                        <li class="flex items-center gap-3"><span class="w-1 h-1 bg-emerald-500 rounded-full"></span>
                            Global Asset Sync</li>
                    </ul>
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
                <p class="text-slate-500 text-lg uppercase font-bold tracking-widest opacity-60">Pay once. Access your
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
                            <span class="text-slate-500 text-xs font-bold uppercase tracking-widest">/once</span>
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
                            <span class="text-slate-500 text-xs font-bold uppercase tracking-widest">/mo</span>
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
                    class="bg-gradient-to-b from-indigo-600 to-indigo-900 border border-indigo-500 rounded-[2rem] p-8 relative flex flex-col justify-between shadow-2xl shadow-indigo-900/50 crystal-card">
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
                    <div class="text-[7px] font-bold text-slate-500 uppercase tracking-widest italic">AES-256 Isolation
                    </div>
                </div>
                <div class="text-center border-l border-white/5">
                    <div class="text-[9px] font-bold text-white uppercase tracking-widest mb-2">Backups</div>
                    <div class="text-[7px] font-bold text-slate-500 uppercase tracking-widest italic">6-Hour Snapshots
                    </div>
                </div>
                <div class="text-center border-l border-white/5">
                    <div class="text-[9px] font-bold text-white uppercase tracking-widest mb-2">Uptime</div>
                    <div class="text-[7px] font-bold text-slate-500 uppercase tracking-widest italic">99.9% Logic SLA
                    </div>
                </div>
                <div class="text-center border-l border-white/5">
                    <div class="text-[9px] font-bold text-white uppercase tracking-widest mb-2">Network</div>
                    <div class="text-[7px] font-bold text-slate-500 uppercase tracking-widest italic">Global Edge Nodes
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="py-20 opacity-20 text-center pointer-events-none">
        <p class="text-[10px] font-bold uppercase tracking-[0.5em] text-slate-500">&copy; {{ date('Y') }} VELORA</p>
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
                            "name": "Velora",
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