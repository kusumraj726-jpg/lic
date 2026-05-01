<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>nexorabyte | Paywall</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

    <!-- CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Inter', sans-serif; background-color: #020617; } /* slate-950 */
    </style>
</head>
<body class="bg-slate-950 text-slate-300 antialiased selection:bg-indigo-500 selection:text-white min-h-screen flex flex-col justify-center items-center py-12 px-4">

    <div class="mb-12 text-center">
        <h2 class="text-4xl md:text-5xl font-extrabold text-white tracking-tight uppercase mb-4">Choose Your Plan</h2>
        <p class="text-base text-slate-400">Your 7-day trial has expired. Subscribe to regain access to your workspace.</p>
    </div>

    <!-- Pricing Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 w-full max-w-5xl mx-auto" x-data="checkout()">
        
        <!-- Monthly Plan -->
        <div class="bg-slate-900 border border-slate-700 rounded-[2rem] p-8 lg:p-10 relative flex flex-col justify-between group hover:border-indigo-500 transition-colors">
            <div>
                <h3 class="text-2xl font-extrabold text-white uppercase tracking-widest mb-1">Starter</h3>
                <p class="text-slate-400 text-sm font-medium uppercase tracking-widest mb-8 border-b border-white/5 pb-2">Billed Monthly</p>
                <div class="flex items-baseline gap-1 mb-10 border-b border-slate-800 pb-8">
                    <span class="text-5xl font-extrabold text-white">₹999</span>
                    <span class="text-slate-500 text-sm font-bold uppercase tracking-widest dark:text-slate-400">/mo</span>
                </div>
                <ul class="space-y-5 mb-10">
                    <li class="flex items-center gap-4 text-sm text-slate-300 font-bold">
                        <span class="bg-indigo-500/20 p-1 rounded">
                            <svg class="h-5 w-5 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                        </span>
                        Unlimited Clients
                    </li>
                    <li class="flex items-center gap-4 text-sm text-slate-300 font-bold">
                        <span class="bg-indigo-500/20 p-1 rounded">
                            <svg class="h-5 w-5 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                        </span>
                        Unlimited Staff Accounts
                    </li>
                    <li class="flex items-center gap-4 text-sm text-slate-300 font-bold">
                        <span class="bg-indigo-500/20 p-1 rounded">
                            <svg class="h-5 w-5 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                        </span>
                        Priority Support
                    </li>
                </ul>
            </div>
            <button @click="pay('monthly')" :disabled="loadingPlan !== null" class="w-full bg-slate-800 hover:bg-indigo-600 text-white font-black py-4 rounded-xl border border-slate-700 hover:border-indigo-500 uppercase tracking-widest transition-all">
                <span x-show="loadingPlan !== 'monthly'">Subscribe Monthly</span>
                <span x-show="loadingPlan === 'monthly'" class="animate-pulse">Loading...</span>
            </button>
        </div>

        <!-- Yearly Plan (Recommended) -->
        <div class="bg-gradient-to-b from-indigo-600 to-indigo-900 border border-indigo-500 rounded-[2rem] p-8 lg:p-10 relative flex flex-col justify-between shadow-2xl">
            <div class="absolute -top-4 inset-x-0 mx-auto w-max bg-amber-500 text-amber-950 font-black text-[10px] uppercase tracking-widest px-4 py-1.5 rounded-full shadow-lg">
                Save 16% (2 Months Free)
            </div>
            <div>
                <h3 class="text-2xl font-extrabold text-white uppercase tracking-widest mb-1">Professional</h3>
                <p class="text-indigo-200 text-sm font-medium uppercase tracking-widest mb-8 border-b border-white/10 pb-2">Billed Annually</p>
                <div class="flex items-baseline gap-1 mb-10 border-b border-indigo-500/50 pb-8">
                    <span class="text-5xl font-extrabold text-white">₹9,990</span>
                    <span class="text-indigo-200 text-sm font-bold uppercase tracking-widest">/yr</span>
                </div>
                <ul class="space-y-5 mb-10">
                    <li class="flex items-center gap-4 text-sm text-white font-bold">
                        <span class="bg-indigo-400/30 p-1 rounded border border-indigo-400">
                            <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                        </span>
                        Everything in Starter
                    </li>
                    <li class="flex items-center gap-4 text-sm text-white font-bold">
                        <span class="bg-indigo-400/30 p-1 rounded border border-indigo-400">
                            <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                        </span>
                        Advanced API Access
                    </li>
                    <li class="flex items-center gap-4 text-sm text-white font-bold">
                        <span class="bg-indigo-400/30 p-1 rounded border border-indigo-400">
                            <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                        </span>
                        Dedicated Account Manager
                    </li>
                </ul>
            </div>
            <button @click="pay('yearly')" :disabled="loadingPlan !== null" class="w-full bg-indigo-950/50 hover:bg-white/10 text-white font-black py-4 rounded-xl border border-indigo-400 shadow-lg uppercase tracking-widest transition-all">
                <span x-show="loadingPlan !== 'yearly'">Subscribe Yearly</span>
                <span x-show="loadingPlan === 'yearly'" class="animate-pulse">Loading...</span>
            </button>
        </div>

    </div>

    <!-- Actions -->
    <div class="mt-12 text-center text-slate-500 text-sm dark:text-slate-400">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="hover:text-white underline transition-colors">Log Out Instead</button>
        </form>
    </div>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('checkout', () => ({
                loadingPlan: null,

                async pay(plan) {
                    this.loadingPlan = plan;
                    try {
                        // 1. Ask Backend to Generate a Razorpay Order
                        const response = await fetch('/billing/checkout', {
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

                        // 2. Open Razorpay Checkout Modal
                        const options = {
                            "key": data.key,
                            "amount": data.amount,
                            "currency": "INR",
                            "name": "nexorabyte",
                            "description": plan === 'yearly' ? "Professional Yearly Subscription" : "Starter Monthly Subscription",
                            "image": "{{ asset('images/logo.png') }}",
                            "order_id": data.order_id,
                            "handler": async function (response) {
                                // 3. Send successful payment tokens back to the server attached to our original generated order
                                const verifyResponse = await fetch('/billing/verify', {
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
                                    window.location.href = "{{ route('dashboard') }}";
                                } else {
                                    alert('Payment verification failed.');
                                }
                            },
                            "prefill": {
                                "name": "{{ auth()->user()->name }}",
                                "email": "{{ auth()->user()->email }}",
                            },
                            "theme": {
                                "color": "#4f46e5" // Indigo 600
                            },
                            "modal": {
                                "ondismiss": () => {
                                    this.loadingPlan = null;
                                }
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
