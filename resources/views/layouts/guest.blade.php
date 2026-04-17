<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
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
                font-family: 'Inter', sans-serif;
            }
            .glass-panel {
                background: rgba(15, 23, 42, 0.8);
                backdrop-filter: blur(12px);
                border: 1px solid rgba(255, 255, 255, 0.1);
            }
        </style>
    </head>
    <body class="antialiased text-slate-200">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[#020617] relative overflow-hidden">
            <!-- Simple Dark Theme Background without heavy blue gradients -->

            <div class="mb-6 text-center z-10 w-full flex justify-center">
                <a href="/" class="flex flex-col items-center justify-center gap-2">
                    <img src="{{ asset('images/logo.png') }}" alt="Company Logo" class="h-40 w-auto object-contain">
                    <span class="text-3xl font-extrabold text-white tracking-widest">Velora</span>
                </a>
            </div>

            <div class="w-full sm:max-w-md z-10 px-4">
                @if(request()->has('flow'))
                    @php
                        $currentStep = request()->input('step', 1);
                    @endphp
                    <!-- Onboarding Progress Bar -->
                    <div class="mb-10 flex justify-center items-center gap-3 text-[9px] uppercase font-black tracking-widest transition-all animate-in fade-in slide-in-from-top-4 duration-700">
                        <div class="flex items-center gap-2 {{ $currentStep >= 1 ? 'text-emerald-400' : 'text-slate-600' }}">
                            <span class="flex items-center justify-center w-5 h-5 rounded-full border-2 {{ $currentStep > 1 ? 'bg-emerald-500 border-emerald-500 text-slate-950' : 'border-emerald-500 ' }}">
                                {{ $currentStep > 1 ? '✓' : '1' }}
                            </span>
                            <span class="{{ $currentStep == 1 ? 'opacity-100' : 'opacity-60' }}">Pay</span>
                        </div>
                        <div class="w-6 h-[2px] rounded-full {{ $currentStep >= 2 ? 'bg-emerald-500' : 'bg-slate-800' }}"></div>
                        <div class="flex items-center gap-2 {{ $currentStep >= 2 ? 'text-indigo-400' : 'text-slate-600' }}">
                             <span class="flex items-center justify-center w-5 h-5 rounded-full border-2 {{ $currentStep == 2 ? 'border-indigo-400 ' : ($currentStep > 2 ? 'bg-indigo-400 border-indigo-400 text-slate-950' : 'border-slate-800') }}">
                                {{ $currentStep > 2 ? '✓' : '2' }}
                            </span>
                            <span class="{{ $currentStep == 2 ? 'opacity-100' : 'opacity-60' }}">Register</span>
                        </div>
                        <div class="w-6 h-[2px] rounded-full {{ $currentStep >= 3 ? 'bg-indigo-400' : 'bg-slate-800' }}"></div>
                        <div class="flex items-center gap-2 {{ $currentStep >= 3 ? 'text-indigo-400' : 'text-slate-600' }}">
                             <span class="flex items-center justify-center w-5 h-5 rounded-full border-2 {{ $currentStep == 3 ? 'border-indigo-400 ' : 'border-slate-800' }}">
                                3
                            </span>
                            <span class="{{ $currentStep == 3 ? 'opacity-100' : 'opacity-60' }}">Login</span>
                        </div>
                    </div>
                @endif

                <div class="bg-[#0f172a] px-8 py-8 shadow-2xl rounded-[1.5rem] relative border border-slate-800">
                    {{ $slot }}
                </div>
                
                <div class="mt-6 text-center">
                    <p class="text-slate-500 text-xs font-medium uppercase tracking-widest dark:text-slate-400">
                        Official Enterprise Resource Planning Portal
                    </p>
                </div>
            </div>
        </div>
        <!-- 🛡️ Velora Global Toast Hub (Guest Alignment) -->
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
