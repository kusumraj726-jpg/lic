<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact Us | nexorabyte Digital Engineering</title>
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

        .form-input {
            width: 100%;
            background: rgba(255, 255, 255, 0.8);
            border: 1px solid rgba(226, 232, 240, 0.8);
            border-radius: 1.25rem;
            padding: 1rem 1.25rem;
            font-size: 0.875rem;
            font-weight: 600;
            color: #0f172a;
            transition: all 0.3s ease;
        }

        .form-input:focus {
            background: white;
            border-color: #f43f5e;
            outline: none;
            box-shadow: 0 0 0 4px rgba(244, 63, 94, 0.1);
        }

        .form-label {
            display: block;
            font-size: 0.6875rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            color: #64748b;
            margin-bottom: 0.75rem;
            margin-left: 0.25rem;
        }

        .submit-btn {
            width: 100%;
            background: #0f172a;
            color: white;
            padding: 1.25rem;
            border-radius: 1.25rem;
            font-size: 0.75rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.2em;
            transition: all 0.3s ease;
            box-shadow: 0 10px 20px -10px rgba(15, 23, 42, 0.3);
        }

        .submit-btn:hover:not(:disabled) {
            background: #f43f5e;
            transform: translateY(-2px);
            box-shadow: 0 15px 30px -12px rgba(244, 63, 94, 0.4);
        }

        .submit-btn:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }
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
                    <img src="{{ asset('images/company_logo.jpg') }}" alt="nexorabyte" class="h-11 w-auto object-contain" style="filter: url(#chroma-key-black) contrast(1.1);">
                    <span style="font-size:1rem;font-weight:900;color:#0f172a;letter-spacing:0.15em;">nexorabyte</span>
                </a>
                <a href="/" class="hidden md:flex items-center gap-2 text-[10px] font-black uppercase tracking-[0.3em] text-slate-400 hover:text-rose-500 transition-colors" style="text-decoration:none;">
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"/></svg>
                    BACK TO HOME
                </a>
            </div>
            <div class="hidden md:flex items-center gap-6">
                <a href="{{ route('services') }}" style="font-size:0.6875rem;font-weight:600;text-transform:uppercase;letter-spacing:0.1em;color:#374151;text-decoration:none;">Services</a>
                @auth
                    <a href="https://erp.nexorabyte.in/dashboard" style="background:#0f172a;color:white;font-size:0.6875rem;font-weight:700;padding:0.625rem 1.5rem;border-radius:9999px;text-transform:uppercase;letter-spacing:0.1em;text-decoration:none;">Dashboard</a>
                @else
                    <a href="{{ route('force-login') }}" style="background:#0f172a;color:white;font-size:0.6875rem;font-weight:700;padding:0.625rem 1.5rem;border-radius:9999px;text-transform:uppercase;letter-spacing:0.1em;text-decoration:none;">Sign In</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="pt-44 pb-24 px-8" x-data="{
        loading: false,
        success: false,
        formData: {
            name: '',
            email: '',
            service: 'Insurance ERP Systems',
            message: ''
        },
        async submitForm() {
            this.loading = true;
            try {
                const response = await fetch('{{ route('consultation.store') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(this.formData)
                });
                const data = await response.json();
                if (data.success) {
                    this.success = true;
                    this.formData = { name: '', email: '', service: 'Insurance ERP Systems', message: '' };
                }
            } catch (error) {
                alert('Submission failed. Please try again.');
            } finally {
                this.loading = false;
            }
        }
    }">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="mb-20 animate-fade-in-up text-center">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-rose-500/10 border border-rose-500/20 text-rose-600 text-[10px] font-black uppercase tracking-[0.3em] mb-8">
                    Direct Channel • Studio Consultation
                </div>
                <h1 class="text-5xl md:text-7xl font-extrabold text-slate-900 mb-8 tracking-tighter leading-tight">
                    Connect With <span class="text-transparent bg-clip-text bg-gradient-to-r from-rose-600 to-pink-600">Us.</span>
                </h1>
                <p class="text-lg text-slate-700 font-medium leading-relaxed max-w-2xl mx-auto">
                    Drop us a line and our architects will get back to you shortly to discuss your digital infrastructure.
                </p>
            </div>

            <!-- Form Card -->
            <div class="max-w-2xl mx-auto crystal-card p-12 md:p-16 rounded-[3.5rem] animate-fade-in-up delay-100">
                <div x-show="!success">
                    <form @submit.prevent="submitForm" class="space-y-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <label class="form-label">Full Name</label>
                                <input type="text" x-model="formData.name" required class="form-input" placeholder="e.g. Rahul Sharma">
                            </div>
                            <div>
                                <label class="form-label">Email Address</label>
                                <input type="email" x-model="formData.email" required class="form-input" placeholder="rahul@example.com">
                            </div>
                        </div>

                        <div>
                            <label class="form-label">Service Interest</label>
                            <select x-model="formData.service" class="form-input cursor-pointer">
                                <option>Insurance ERP Systems</option>
                                <option>Customized Websites</option>
                                <option>API & Cloud Infrastructure</option>
                                <option>Other Consultation</option>
                            </select>
                        </div>

                        <div>
                            <label class="form-label">Your Vision / Message</label>
                            <textarea x-model="formData.message" rows="5" class="form-input resize-none" placeholder="Tell us about your requirements..."></textarea>
                        </div>

                        <button type="submit" :disabled="loading" class="submit-btn flex items-center justify-center gap-3">
                            <span x-show="!loading">Initialize Transmission</span>
                            <div x-show="loading" class="flex items-center gap-2">
                                <svg class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <span>Architecting...</span>
                            </div>
                        </button>
                    </form>
                </div>

                <!-- Success State -->
                <div x-show="success" class="text-center py-8 animate-fade-in">
                    <div class="w-20 h-20 bg-emerald-50 rounded-full flex items-center justify-center mx-auto mb-8 border border-emerald-100">
                        <svg class="w-10 h-10 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <h3 class="text-3xl font-black text-slate-900 mb-4 uppercase tracking-tight">Transmission Sent</h3>
                    <p class="text-slate-600 font-medium leading-relaxed">Our architects have received your message. <br/> Expect a briefing within 24 hours.</p>
                    <div class="mt-10">
                        <a href="/" class="text-[10px] font-black uppercase tracking-widest text-rose-600 hover:text-rose-500 transition-colors border-b-2 border-rose-100 pb-1">Back to HQ</a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer x-data="{}" class="py-20 border-t border-white/5 bg-[#0f111a] relative overflow-hidden">
        <!-- Footer Aurora Glow -->
        <div class="absolute -bottom-48 left-1/2 -translate-x-1/2 w-full h-96 bg-rose-500/10 blur-[120px] rounded-full">
        </div>

        <div class="max-w-7xl mx-auto px-8 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 lg:gap-8 mb-16">
                <div class="md:col-span-2">
                    <div class="flex items-center gap-4 mb-6">
                        <img src="{{ asset('images/company_logo.jpg') }}" alt="nexorabyte"
                            class="h-10 w-auto object-contain"
                            style="filter: url(#chroma-key-black) contrast(1.1) brightness(1.2);">
                        <span class="text-xl font-black text-white tracking-[0.2em]">nexorabyte</span>
                    </div>
                    <p class="text-slate-400 text-sm leading-relaxed max-w-sm mb-8 font-medium">
                        Architecting the digital backbone of the modern enterprise through bespoke ERP logic, elite
                        engineering, and immutable security.
                    </p>
                </div>

                <div>
                    <h5 class="text-white font-black tracking-[0.3em] uppercase text-[10px] mb-6">Our Services</h5>
                    <ul class="space-y-4">
                        <li><a href="{{ route('services.web-development') }}"
                                class="text-slate-500 text-sm hover:text-rose-500 transition-all hover:pl-2">Customized
                                Websites</a></li>
                        <li><a href="{{ route('services.insurance-erp') }}"
                                class="text-slate-500 text-sm hover:text-rose-500 transition-all hover:pl-2">Insurance
                                ERP Systems</a></li>
                    </ul>
                </div>

                <div>
                    <h5 class="text-white font-black tracking-[0.3em] uppercase text-[10px] mb-6">Studio</h5>
                    <ul class="space-y-4">
                        <li><a href="{{ route('about') }}"
                                class="text-slate-500 text-sm hover:text-rose-500 transition-all hover:pl-2">About
                                Us</a></li>
                        <li><a href="{{ route('lifecycle') }}"
                                class="text-slate-500 text-sm hover:text-rose-500 transition-all hover:pl-2">Our
                                Lifecycle</a></li>
                        <li><a href="{{ route('contact') }}"
                                class="text-slate-500 text-sm hover:text-rose-500 transition-all hover:pl-2 underline decoration-rose-500/30 underline-offset-4">Contact
                                Us</a></li>
                    </ul>
                </div>
            </div>

            <div class="pt-8 border-t border-white/5 flex flex-col md:flex-row items-center justify-between gap-6">
                <p class="text-[9px] font-black tracking-[0.3em] text-slate-600 uppercase">&copy; {{ date('Y') }}
                    nexorabyte. ARCHITECTING EXCELLENCE.</p>
                <div class="flex gap-8">
                    <a href="{{ route('terms') }}"
                        class="text-[9px] font-black uppercase tracking-[0.3em] text-slate-600 hover:text-white transition-colors">Terms & conditions</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
