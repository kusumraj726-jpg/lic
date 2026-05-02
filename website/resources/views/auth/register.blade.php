<!-- Build Trigger: 2026-04-27 22:30 -->
<x-auth-split-layout title="Register">
    <div class="w-full max-w-5xl bg-white/90 dark:bg-slate-900/90 backdrop-blur-2xl rounded-[2rem] lg:rounded-[2.5rem] flex flex-col lg:flex-row overflow-hidden shadow-2xl shadow-black/40 border border-white/20 transition-all duration-500 my-auto">
        
        <!-- Left Side: Splash Hero (Hidden on Mobile) -->
        <div class="relative hidden lg:flex lg:w-[45%] min-h-[400px] lg:min-h-full overflow-hidden">
            <div class="absolute inset-0 bg-cover bg-center transition-transform duration-[2s]"
                 style="background-image: url('{{ asset('images/login-admin.webp') }}')">
                <div class="absolute inset-0 bg-gradient-to-br from-indigo-900/60 via-transparent to-slate-900/80"></div>
            </div>

            <!-- Content Overlay -->
            <div class="relative z-10 w-full h-full p-10 flex flex-col justify-between text-white">
                <div>
                    <!-- Logo moved to right side -->
                </div>

                <div class="space-y-4 max-w-sm">
                    <div class="space-y-2">
                        <h2 class="text-3xl lg:text-4xl font-black leading-tight">Start Your Journey.</h2>
                        <p class="text-sm lg:text-base text-white/70 font-medium">Provision your workspace and join the elite network of professional insurance intelligence.</p>
                    </div>
                    
                    <div class="flex gap-2">
                        <div class="h-1 w-10 rounded-full bg-white"></div>
                        <div class="h-1 w-10 rounded-full bg-white/30"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side: Register Form -->
        <div class="flex-1 flex flex-col p-8 lg:p-10 transition-colors duration-500 overflow-y-auto lg:max-h-full">
            <div class="w-full max-w-md mx-auto space-y-4">
                
                <!-- Onboarding Progress Bar -->
                @if(request()->has('flow'))
                    @php $currentStep = request()->input('step', 1); @endphp
                    <div class="flex justify-center items-center gap-3 mb-4">
                        <div class="flex items-center gap-2 {{ $currentStep >= 1 ? 'text-indigo-600 dark:text-indigo-400' : 'text-slate-400' }}">
                            <span class="flex items-center justify-center w-5 h-5 rounded-full border-2 {{ $currentStep > 1 ? 'bg-indigo-600 border-indigo-600 text-white' : 'border-indigo-600' }} text-[9px] font-black">
                                {{ $currentStep > 1 ? '✓' : '1' }}
                            </span>
                            <span class="text-[8px] uppercase font-black tracking-widest">Pay</span>
                        </div>
                        <div class="w-6 h-px {{ $currentStep >= 2 ? 'bg-indigo-500' : 'bg-slate-200 dark:bg-slate-800' }}"></div>
                        <div class="flex items-center gap-2 {{ $currentStep >= 2 ? 'text-indigo-600 dark:text-indigo-400' : 'text-slate-400' }}">
                            <span class="flex items-center justify-center w-5 h-5 rounded-full border-2 {{ $currentStep == 2 ? 'border-indigo-600 text-indigo-600' : ($currentStep > 2 ? 'bg-indigo-600 border-indigo-600 text-white' : 'border-slate-300 dark:border-slate-700') }} text-[9px] font-black">
                                {{ $currentStep > 2 ? '✓' : '2' }}
                            </span>
                            <span class="text-[8px] uppercase font-black tracking-widest">Register</span>
                        </div>
                        <div class="w-6 h-px {{ $currentStep >= 3 ? 'bg-indigo-500' : 'bg-slate-200 dark:bg-slate-800' }}"></div>
                        <div class="flex items-center gap-2 {{ $currentStep >= 3 ? 'text-indigo-600 dark:text-indigo-400' : 'text-slate-400' }}">
                             <span class="flex items-center justify-center w-5 h-5 rounded-full border-2 {{ $currentStep == 3 ? 'border-indigo-600 text-indigo-600' : 'border-slate-300 dark:border-slate-700' }} text-[9px] font-black">3</span>
                            <span class="text-[8px] uppercase font-black tracking-widest">Login</span>
                        </div>
                    </div>
                @endif

                <!-- Header -->
                <div class="text-center space-y-1">
                    <div class="flex justify-center mb-4 items-center gap-3">
                        <img src="{{ asset('images/company_logo.jpg') }}" alt="nexorabyte" class="h-10 w-auto object-contain" style="filter: url(#chroma-key-black) contrast(1.1);">
                        <span class="text-2xl font-black text-slate-900 dark:text-white tracking-widest">nexorabyte</span>
                    </div>
                    <h1 class="text-2xl lg:text-3xl font-black text-slate-900 dark:text-white tracking-tight">Create Workspace</h1>
                    <p class="text-[9px] text-slate-400 font-bold uppercase tracking-[0.2em]">Provision your primary admin console</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf
                    
                    <div class="grid grid-cols-1 gap-3">
                        <!-- Company Name -->
                        <div class="space-y-1">
                            <label class="text-[9px] font-black text-slate-600 uppercase tracking-widest ml-1">Company / Organization</label>
                            <input type="text" name="company_name" value="{{ old('company_name') }}" required autofocus
                                class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border-none rounded-xl text-slate-900 dark:text-white text-sm font-bold placeholder-slate-300 focus:ring-2 focus:ring-indigo-500 transition-all shadow-sm border border-transparent dark:border-slate-700"
                                placeholder="e.g. Nexus Insurance Group">
                            <x-input-error :messages="$errors->get('company_name')" class="mt-1" />
                        </div>

                        <!-- Name -->
                        <div class="space-y-1">
                            <label class="text-[9px] font-black text-slate-600 uppercase tracking-widest ml-1">Admin Full Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" required
                                class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border-none rounded-xl text-slate-900 dark:text-white text-sm font-bold placeholder-slate-300 focus:ring-2 focus:ring-indigo-500 transition-all shadow-sm border border-transparent dark:border-slate-700"
                                placeholder="John Doe">
                            <x-input-error :messages="$errors->get('name')" class="mt-1" />
                        </div>

                        <!-- Email -->
                        <div class="space-y-1">
                            <label class="text-[9px] font-black text-slate-600 uppercase tracking-widest ml-1">Official Email ID</label>
                            <input type="email" name="email" value="{{ old('email') }}" required
                                class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border-none rounded-xl text-slate-900 dark:text-white text-sm font-bold placeholder-slate-300 focus:ring-2 focus:ring-indigo-500 transition-all shadow-sm border border-transparent dark:border-slate-700"
                                placeholder="name@company.com">
                            <x-input-error :messages="$errors->get('email')" class="mt-1" />
                        </div>

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-3">
                            <!-- Password -->
                            <div class="space-y-1" x-data="{ show: false }">
                                <label class="text-[9px] font-black text-slate-600 uppercase tracking-widest ml-1">Password</label>
                                <div class="relative group">
                                    <input :type="show ? 'text' : 'password'" name="password" required
                                        class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border-none rounded-xl text-slate-900 dark:text-white text-sm font-bold placeholder-slate-300 focus:ring-2 focus:ring-indigo-500 transition-all shadow-sm border border-transparent dark:border-slate-700"
                                        placeholder="••••••••">
                                    <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-300 hover:text-slate-500 transition-colors">
                                        <svg x-show="!show" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                        <svg x-show="show" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.076m10.893 3.427A3.378 3.378 0 0112 15a3.375 3.375 0 01-2.943-1.687m4.633-4.633a3.375 3.375 0 00-4.633 4.633m0 0l-4.633-4.633m4.633 4.633L21 21" /></svg>
                                    </button>
                                </div>
                                <x-input-error :messages="$errors->get('password')" class="mt-1" />
                            </div>

                            <!-- Confirm Password -->
                            <div class="space-y-1" x-data="{ show: false }">
                                <label class="text-[9px] font-black text-slate-600 uppercase tracking-widest ml-1">Confirm</label>
                                <div class="relative group">
                                    <input :type="show ? 'text' : 'password'" name="password_confirmation" required
                                        class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border-none rounded-xl text-slate-900 dark:text-white text-sm font-bold placeholder-slate-300 focus:ring-2 focus:ring-indigo-500 transition-all shadow-sm border border-transparent dark:border-slate-700"
                                        placeholder="••••••••">
                                    <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-300 hover:text-slate-500 transition-colors">
                                        <svg x-show="!show" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                        <svg x-show="show" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.076m10.893 3.427A3.378 3.378 0 0112 15a3.375 3.375 0 01-2.943-1.687m4.633-4.633a3.375 3.375 0 00-4.633 4.633m0 0l-4.633-4.633m4.633 4.633L21 21" /></svg>
                                    </button>
                                </div>
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                            </div>
                        </div>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full py-3.5 bg-indigo-600 hover:bg-indigo-700 text-white text-[10px] font-black uppercase tracking-[0.2em] rounded-xl shadow-xl shadow-indigo-100 dark:shadow-none transition-all active:scale-[0.98]">
                            Provision elite account
                        </button>
                    </div>


                </form>

                <div class="text-center pt-6 pb-4">
                    <p class="text-[7px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-widest leading-relaxed max-w-xs mx-auto">IMPORTANT: Registration is a one-time architectural protocol. <br> Please verify all details carefully before provisioning your workspace.</p>
                </div>
            </div>
        </div>
    </div>
</x-auth-split-layout>
