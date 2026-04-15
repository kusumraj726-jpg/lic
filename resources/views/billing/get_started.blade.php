<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Get Started | Velora ERP</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-slate-950 text-slate-300 antialiased min-h-screen flex flex-col">

    <!-- Back to Website -->
    <div class="px-6 pt-6">
        <a href="{{ url('/') }}" class="inline-flex items-center gap-2 text-slate-400 hover:text-white text-sm font-bold uppercase tracking-widest transition-colors">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
            Back to Website
        </a>
    </div>

    <div class="flex-1 flex flex-col justify-center items-center py-12 px-4">

        <!-- Header -->
        <div class="mb-12 text-center">
            <div class="flex items-center justify-center gap-3 mb-6">
                <img src="{{ asset('images/logo.png') }}?v=100" alt="Velora" class="h-20 w-auto object-contain">
                <span class="text-3xl font-black text-white tracking-widest uppercase">Velora</span>
            </div>
            <h1 class="text-4xl md:text-5xl font-black text-white tracking-tight mb-4">Choose Your Plan</h1>
            <p class="text-slate-400 text-lg">Pay once. Create your account. Access your workspace.</p>
            <div class="mt-4 flex flex-wrap items-center justify-center gap-3 text-sm font-bold">
                <span class="flex items-center gap-1 text-green-400">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Step 1: Pay
                </span>
                <span class="text-slate-600 dark:text-slate-300">→</span>
                <span class="text-slate-500 dark:text-slate-400">Step 2: Register</span>
                <span class="text-slate-600 dark:text-slate-300">→</span>
                <span class="text-slate-500 dark:text-slate-400">Step 3: Login & Use</span>
            </div>
        </div>

        <!-- Error from session -->
        @if(session('error'))
            <div class="mb-6 bg-red-900/50 border border-red-500 text-red-200 px-6 py-3 rounded-xl text-sm font-medium">
                {{ session('error') }}
            </div>
        @endif

        <!-- Pricing Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 w-full max-w-6xl mx-auto" x-data="guestCheckout()">

            <!-- Trial Plan (One-Time) -->
            <div class="bg-slate-900 border border-emerald-800 rounded-[2rem] p-8 relative flex flex-col justify-between hover:border-emerald-500 transition-colors">
                <div class="absolute -top-4 inset-x-0 mx-auto w-max bg-emerald-500 text-emerald-950 font-black text-[10px] uppercase tracking-widest px-4 py-1.5 rounded-full shadow-lg">
                    One-Time Trial
                </div>
                <div>
                    <h3 class="text-2xl font-extrabold text-white uppercase tracking-widest mb-1">Try It Out</h3>
                    <p class="text-slate-400 text-sm font-medium uppercase tracking-widest mb-6 border-b border-white/5 pb-2">2 Months Access</p>
                    <div class="flex items-baseline gap-1 mb-8 border-b border-slate-800 pb-6">
                        <span class="text-5xl font-extrabold text-white">₹99</span>
                        <span class="text-slate-500 text-sm font-bold uppercase tracking-widest dark:text-slate-400">/once</span>
                    </div>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center gap-3 text-sm text-slate-300 font-bold">
                            <span class="bg-emerald-500/20 p-1 rounded"><svg class="h-4 w-4 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg></span>
                            60 Days Full Access
                        </li>
                        <li class="flex items-center gap-3 text-sm text-slate-300 font-bold">
                            <span class="bg-emerald-500/20 p-1 rounded"><svg class="h-4 w-4 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg></span>
                            All Core Modules
                        </li>
                        <li class="flex items-center gap-3 text-sm text-slate-300 font-bold">
                            <span class="bg-emerald-500/20 p-1 rounded"><svg class="h-4 w-4 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg></span>
                            Upgrade Anytime
                        </li>
                        <li class="flex items-start gap-3 text-xs text-slate-500 font-medium mt-2 dark:text-slate-400">
                            <svg class="h-4 w-4 text-slate-600 mt-0.5 shrink-0 dark:text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            One-time per account. Access auto-expires after 60 days.
                        </li>
                    </ul>
                </div>
                <button @click="pay('trial')" :disabled="loadingPlan !== null" class="w-full bg-slate-800 hover:bg-emerald-600 text-white font-black py-4 rounded-xl border border-emerald-800 hover:border-emerald-500 uppercase tracking-widest transition-all">
                    <span x-show="loadingPlan !== 'trial'">Try For ₹99</span>
                    <span x-show="loadingPlan === 'trial'" class="animate-pulse">Processing...</span>
                </button>
            </div>

            <!-- Monthly Plan -->
            <div class="bg-slate-900 border border-slate-700 rounded-[2rem] p-8 relative flex flex-col justify-between hover:border-indigo-500 transition-colors">
                <div>
                    <h3 class="text-2xl font-extrabold text-white uppercase tracking-widest mb-1">Starter</h3>
                    <p class="text-slate-400 text-sm font-medium uppercase tracking-widest mb-6 border-b border-white/5 pb-2">Monthly Plan</p>
                    <div class="flex items-baseline gap-1 mb-8 border-b border-slate-800 pb-6">
                        <span class="text-5xl font-extrabold text-white">₹999</span>
                        <span class="text-slate-500 text-sm font-bold uppercase tracking-widest dark:text-slate-400">/mo</span>
                    </div>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center gap-3 text-sm text-slate-300 font-bold">
                            <span class="bg-indigo-500/20 p-1 rounded"><svg class="h-4 w-4 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg></span>
                            Unlimited Clients
                        </li>
                        <li class="flex items-center gap-3 text-sm text-slate-300 font-bold">
                            <span class="bg-indigo-500/20 p-1 rounded"><svg class="h-4 w-4 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg></span>
                            Unlimited Staff Accounts
                        </li>
                        <li class="flex items-center gap-3 text-sm text-slate-300 font-bold">
                            <span class="bg-indigo-500/20 p-1 rounded"><svg class="h-4 w-4 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg></span>
                            Priority Support
                        </li>
                    </ul>
                </div>
                <button @click="pay('monthly')" :disabled="loadingPlan !== null" class="w-full bg-slate-800 hover:bg-indigo-600 text-white font-black py-4 rounded-xl border border-slate-700 hover:border-indigo-500 uppercase tracking-widest transition-all">
                    <span x-show="loadingPlan !== 'monthly'">Pay ₹999/mo</span>
                    <span x-show="loadingPlan === 'monthly'" class="animate-pulse">Processing...</span>
                </button>
            </div>

            <!-- Yearly Plan -->
            <div class="bg-gradient-to-b from-indigo-600 to-indigo-900 border border-indigo-500 rounded-[2rem] p-8 relative flex flex-col justify-between shadow-2xl">
                <div class="absolute -top-4 inset-x-0 mx-auto w-max bg-amber-500 text-amber-950 font-black text-[10px] uppercase tracking-widest px-4 py-1.5 rounded-full shadow-lg">
                    Best Value — 2 Months Free
                </div>
                <div>
                    <h3 class="text-2xl font-extrabold text-white uppercase tracking-widest mb-1">Professional</h3>
                    <p class="text-indigo-200 text-sm font-medium uppercase tracking-widest mb-6 border-b border-white/10 pb-2">Annual Plan</p>
                    <div class="flex items-baseline gap-1 mb-8 border-b border-indigo-500/50 pb-6">
                        <span class="text-5xl font-extrabold text-white">₹9,990</span>
                        <span class="text-indigo-200 text-sm font-bold uppercase tracking-widest">/yr</span>
                    </div>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center gap-3 text-sm text-white font-bold">
                            <span class="bg-indigo-400/30 p-1 rounded border border-indigo-400"><svg class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg></span>
                            Everything in Starter
                        </li>
                        <li class="flex items-center gap-3 text-sm text-white font-bold">
                            <span class="bg-indigo-400/30 p-1 rounded border border-indigo-400"><svg class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg></span>
                            Advanced API Access
                        </li>
                        <li class="flex items-center gap-3 text-sm text-white font-bold">
                            <span class="bg-indigo-400/30 p-1 rounded border border-indigo-400"><svg class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg></span>
                            Dedicated Account Manager
                        </li>
                    </ul>
                </div>
                <button @click="pay('yearly')" :disabled="loadingPlan !== null" class="w-full bg-indigo-950/50 hover:bg-white/10 text-white font-black py-4 rounded-xl border border-indigo-400 shadow-lg uppercase tracking-widest transition-all">
                    <span x-show="loadingPlan !== 'yearly'">Pay ₹9,990/yr</span>
                    <span x-show="loadingPlan === 'yearly'" class="animate-pulse">Processing...</span>
                </button>
            </div>

        </div>

        <p class="mt-12 text-slate-500 text-sm text-center dark:text-slate-400">
            Already have an account?
            <a href="{{ route('login') }}" class="text-indigo-400 hover:text-indigo-300 font-bold underline transition-colors">Sign In</a>
        </p>

    </div>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('guestCheckout', () => ({
                loadingPlan: null,

                async pay(plan) {
                    this.loadingPlan = plan;
                    try {
                        const response = await fetch('/get-started/checkout', {
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

                        const planLabels = {
                            trial: 'Try It Out — 60 Days Access',
                            monthly: 'Starter Monthly Plan',
                            yearly: 'Professional Annual Plan'
                        };

                        const options = {
                            "key": data.key,
                            "amount": data.amount,
                            "currency": "INR",
                            "name": "Velora",
                            "description": planLabels[plan],
                            "image": "{{ asset('images/logo.png') }}",
                            "order_id": data.order_id,
                            "handler": async (response) => {
                                const verifyResponse = await fetch('/get-started/verify', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                    },
                                    body: JSON.stringify({
                                        razorpay_payment_id: response.razorpay_payment_id,
                                        razorpay_order_id: response.razorpay_order_id,
                                        razorpay_signature: response.razorpay_signature,
                                        plan: plan
                                    })
                                });

                                const verifyData = await verifyResponse.json();
                                if (verifyData.success) {
                                    // Payment done! Redirect to registration
                                    window.location.href = "{{ route('register') }}?flow=onboarding&step=2";
                                } else {
                                    alert('Payment verification failed. Please contact support.');
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
