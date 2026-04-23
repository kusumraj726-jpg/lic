<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'NexoraByte') }}</title>

        <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                font-family: 'Cambria', Georgia, serif;
            }
            .glass-panel {
                background: rgba(15, 23, 42, 0.8);
                backdrop-filter: blur(12px);
                border: 1px solid rgba(255, 255, 255, 0.1);
            }
            @media (max-width: 768px) {
                input, select, textarea {
                    font-size: 16px !important;
                }
            }
        </style>
        
        <script>
            // 🛡️ NexoraByte Anti-History-Hijack Security
            // Prevents users from using the back button to reach sensitive forms (like registration) 
            // after the session has been cleared or the flow is complete.
            (function() {
                window.addEventListener('pageshow', function(event) {
                    if (event.persisted || (window.performance && window.performance.navigation.type === 2)) {
                        // If page reached via back button, force a reload to let the server-side middleware 
                        // check the current session state and redirect if necessary.
                        window.location.reload();
                    }
                });
            })();
        </script>
    </head>
    <body class="antialiased text-slate-900 selection:bg-rose-500 selection:text-white">
        <!-- Premium Background Layers -->
        <div class="fixed inset-0 z-[-1] bg-gradient-to-br from-white via-rose-50 to-white overflow-hidden">
            <div class="absolute top-[-10%] left-[-10%] w-[60%] h-[60%] bg-radial-gradient(circle, rgba(251, 113, 133, 0.4) 0%, transparent 70%) animate-aura"></div>
            <div class="absolute bottom-[-10%] right-[-10%] w-[80%] h-[80%] bg-radial-gradient(circle, rgba(251, 113, 133, 0.45) 0%, transparent 70%) animate-aura-reverse"></div>
            <div class="absolute top-[30%] left-[50%] w-[50%] h-[50%] bg-radial-gradient(circle, rgba(244, 114, 182, 0.5) 0%, transparent 70%) animate-aura" style="filter: blur(120px);"></div>
            
            <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg viewBox=\"0 0 250 250\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cfilter id=\"noiseFilter\"%3E%3CfeTurbulence type=\"fractalNoise\" baseFrequency=\"0.8\" numOctaves=\"3\" stitchTiles=\"stitch\"/%3E%3C/filter%3E%3Crect width=\"100%25\" height=\"100%25\" filter=\"url(%23noiseFilter)\"/%3E%3C/svg%3E')] opacity-[0.03] mix-blend-multiply"></div>
            <div class="absolute inset-0" style="background-image: linear-gradient(rgba(0, 0, 0, 0.03) 1px, transparent 1px), linear-gradient(90deg, rgba(0, 0, 0, 0.03) 1px, transparent 1px); background-size: 60px 60px; mask-image: radial-gradient(circle at center, black, transparent 90%);"></div>
        </div>

        <!-- SVG Filter for Logo Transparency -->
        <svg style="position: absolute; width: 0; height: 0;" aria-hidden="true">
            <filter id="chroma-key-black"><feColorMatrix type="matrix" values="1 0 0 0 0 0 1 0 0 0 0 0 1 0 0 1 1 1 0 -0.1" /></filter>
        </svg>

        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative px-4">
            <div class="mb-12 text-center z-10 w-full animate-fade-in-up">
                <a href="/" class="flex flex-col items-center justify-center gap-4 group">
                    <div class="relative">
                        <img src="{{ asset('images/company_logo.jpg') }}" alt="nexorabyte" class="h-20 w-auto object-contain transition-transform group-hover:scale-110 duration-500 shadow-2xl rounded-2xl" style="filter: url(#chroma-key-black) contrast(1.1);">
                    </div>
                    <span class="text-4xl font-black text-slate-900 tracking-[0.2em]">nexorabyte</span>
                </a>
            </div>

            <div class="w-full sm:max-w-md z-10">
                @if(request()->has('flow'))
                    @php
                        $currentStep = request()->input('step', 1);
                    @endphp
                    <!-- Onboarding Progress Bar -->
                    <div class="mb-10 flex justify-center items-center gap-3 text-[9px] uppercase font-black tracking-[0.4em] text-slate-400">
                        <div class="flex items-center gap-2 {{ $currentStep >= 1 ? 'text-rose-600' : '' }}">
                            <span class="flex items-center justify-center w-6 h-6 rounded-full border-2 {{ $currentStep > 1 ? 'bg-rose-600 border-rose-600 text-white' : 'border-rose-600' }}">
                                {{ $currentStep > 1 ? '✓' : '1' }}
                            </span>
                            <span class="{{ $currentStep == 1 ? 'text-slate-900 font-black' : '' }}">Pay</span>
                        </div>
                        <div class="w-12 h-px {{ $currentStep >= 2 ? 'bg-rose-500' : 'bg-slate-200' }}"></div>
                        <div class="flex items-center gap-2 {{ $currentStep >= 2 ? 'text-rose-600' : '' }}">
                             <span class="flex items-center justify-center w-6 h-6 rounded-full border-2 {{ $currentStep == 2 ? 'border-rose-600 text-rose-600' : ($currentStep > 2 ? 'bg-rose-600 border-rose-600 text-white' : 'border-slate-300') }}">
                                {{ $currentStep > 2 ? '✓' : '2' }}
                            </span>
                            <span class="{{ $currentStep == 2 ? 'text-slate-900 font-black' : '' }}">Register</span>
                        </div>
                        <div class="w-12 h-px {{ $currentStep >= 3 ? 'bg-rose-500' : 'bg-slate-200' }}"></div>
                        <div class="flex items-center gap-2 {{ $currentStep >= 3 ? 'text-rose-600' : '' }}">
                             <span class="flex items-center justify-center w-6 h-6 rounded-full border-2 {{ $currentStep == 3 ? 'border-rose-600 text-rose-600' : 'border-slate-300' }}">
                                3
                            </span>
                            <span class="{{ $currentStep == 3 ? 'text-slate-900 font-black' : '' }}">Login</span>
                        </div>
                    </div>
                @endif

                <div class="bg-white/40 backdrop-blur-3xl border border-white/80 px-10 py-12 shadow-2xl rounded-[3rem] relative animate-fade-in-up delay-100">
                    {{ $slot }}
                </div>
                
                <div class="mt-10 text-center animate-fade-in-up delay-200">
                    <p class="text-slate-400 text-[10px] font-black uppercase tracking-[0.4em]">
                        Elite Command Center &bull; Verified Access Only
                    </p>
                </div>
            </div>
        </div>
        <!-- 🛡️ NexoraByte Global Toast Hub (Guest Alignment) -->
        <div x-data="{ 
                show: false, 
                type: 'success', 
                message: '',
                init() {
                    @if(session('success'))
                        this.trigger('success', '{{ session('success') }}');
                    @elseif(session('error'))
                        this.trigger('error', '{{ session('error') }}');
                    @elseif(session('status'))
                        this.trigger('info', '{{ session('status') }}');
                    @endif
                },
                trigger(type, message) {
                    this.type = type;
                    this.message = message;
                    this.show = true;
                    setTimeout(() => this.show = false, 4000);
                }
             }"
             x-show="show"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-x-8"
             x-transition:enter-end="opacity-100 translate-x-0"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100 translate-x-0"
             x-transition:leave-end="opacity-0 translate-x-8"
             class="fixed top-8 right-8 z-[110] w-80"
             style="display: none;">
            
            <div class="bg-slate-900 border rounded-3xl shadow-2xl p-5 flex items-start gap-4 border-slate-700">
                <div class="h-10 w-10 shrink-0 rounded-2xl flex items-center justify-center bg-slate-800"
                     :class="{ 'text-emerald-400': type === 'success', 'text-rose-400': type === 'error', 'text-indigo-400': type === 'info' }">
                    <template x-if="type === 'success'">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </template>
                    <template x-if="type === 'error'">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </template>
                    <template x-if="type === 'info'">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </template>
                </div>

                <div class="flex-auto">
                    <h4 class="text-[10px] font-black uppercase tracking-[0.2em] mb-1"
                        :class="{ 'text-emerald-400': type === 'success', 'text-rose-400': type === 'error', 'text-indigo-400': type === 'info' }" x-text="type === 'success' ? 'Provisioning Success' : (type === 'error' ? 'Security Alert' : 'Onboarding Info')"></h4>
                    <p class="text-xs font-bold text-slate-300 leading-relaxed" x-text="message"></p>
                </div>

                <button @click="show = false" class="text-slate-600 hover:text-slate-400 transition-colors dark:text-slate-300">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
        </div>
    </body>
</html>
