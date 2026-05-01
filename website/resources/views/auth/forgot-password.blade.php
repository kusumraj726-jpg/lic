<x-auth-split-layout title="Recover Access">
    <div class="w-full max-w-5xl lg:min-h-[600px] bg-white/90 dark:bg-slate-900/90 backdrop-blur-2xl rounded-[2rem] lg:rounded-[2.5rem] flex flex-col lg:flex-row overflow-hidden shadow-2xl shadow-black/40 border border-white/20 transition-all duration-500 my-8">
        
        <!-- Left Side: Splash Hero (Hidden on Mobile) -->
        <div class="relative hidden lg:flex lg:w-[50%] min-h-[400px] lg:min-h-full overflow-hidden">
            <div class="absolute inset-0 bg-cover bg-center transition-transform duration-[2s]"
                 style="background-image: url('{{ asset('images/login-recovery.webp') }}')">
                <div class="absolute inset-0 bg-gradient-to-br from-indigo-900/60 via-transparent to-slate-900/80"></div>
            </div>

            <!-- Content Overlay -->
            <div class="relative z-10 w-full h-full p-10 flex flex-col justify-between text-white">
                <div>
                    <!-- Logo moved to right side -->
                </div>

                <div class="space-y-4 max-w-sm">
                    <div class="space-y-2">
                        <h2 class="text-3xl lg:text-4xl font-black leading-tight">Secure Access Restoration.</h2>
                        <p class="text-sm lg:text-base text-white/70 font-medium">Re-establishing your encrypted connection to the core intelligence network.</p>
                    </div>
                    
                    <div class="flex gap-2">
                        <div class="h-1 w-10 rounded-full bg-white/30"></div>
                        <div class="h-1 w-10 rounded-full bg-white"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side: Recovery Form -->
        <div class="flex-1 flex flex-col items-center justify-start p-8 lg:p-10 lg:pt-16 transition-colors duration-500">
            <div class="w-full max-w-sm space-y-8">
                
                <!-- Header -->
                <div class="text-center space-y-1">
                    <div class="flex justify-center mb-4 items-center gap-3">
                        <img src="{{ asset('images/company_logo.jpg') }}" alt="nexorabyte" class="h-10 w-auto object-contain" style="filter: url(#chroma-key-black) contrast(1.1);">
                        <span class="text-2xl font-black text-slate-900 dark:text-white tracking-widest">nexorabyte</span>
                    </div>
                    <h1 class="text-2xl lg:text-3xl font-black text-slate-900 dark:text-white tracking-tight">Recover Access</h1>
                    <p class="text-[9px] text-slate-400 font-bold uppercase tracking-[0.2em]">Secure Intelligence Restoration</p>
                </div>

                <div class="text-[11px] font-medium text-slate-500 dark:text-slate-400 leading-relaxed text-center">
                    {{ __('Input your credentials. Our core engine will dispatch a secure restoration link to your official email ID instantly.') }}
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                    @csrf
                    
                    <!-- Email -->
                    <div class="space-y-1.5">
                        <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest ml-1">Official Email ID</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-4 w-4 text-slate-300 group-focus-within:text-indigo-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                </svg>
                            </div>
                            <input type="email" name="email" value="{{ old('email') }}" required autofocus
                                class="w-full pl-10 pr-4 py-3 bg-slate-50 dark:bg-slate-800 border-none rounded-xl text-slate-900 dark:text-white text-sm font-bold placeholder-slate-300 focus:ring-2 focus:ring-indigo-500 transition-all shadow-sm border border-transparent dark:border-slate-700"
                                placeholder="name@company.com">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>

                    <div class="space-y-4">
                        <button type="submit" class="w-full py-3.5 bg-indigo-600 hover:bg-indigo-700 text-white text-[10px] font-black uppercase tracking-[0.2em] rounded-xl shadow-xl shadow-indigo-100 dark:shadow-none transition-all active:scale-[0.98]">
                            Dispatch Restoration Link
                        </button>
                        
                        <div class="text-center">
                            <a href="{{ route('login') }}" class="text-[9px] font-black text-slate-400 hover:text-indigo-600 uppercase tracking-widest transition-colors">
                                Remembered your access? Back to Login
                            </a>
                        </div>
                    </div>
                </form>

                <div class="text-center pt-4">
                    <p class="text-[8px] font-bold text-slate-300 uppercase tracking-widest">NexoraByte Suite &bull; Verified Access Only</p>
                </div>
            </div>
        </div>
    </div>
</x-auth-split-layout>
