<x-auth-split-layout>
    <div class="w-full max-w-6xl lg:min-h-[700px] bg-white dark:bg-slate-900 rounded-[2rem] lg:rounded-[2.5rem] flex flex-col lg:flex-row overflow-hidden shadow-2xl shadow-black/40 transition-all duration-500 my-8" x-data="{ role: 'Admin' }">
        
        <!-- Left Side: Splash Hero (Hidden on Mobile) -->
        <div class="relative hidden lg:flex lg:w-[55%] min-h-[400px] lg:min-h-full overflow-hidden">
            <!-- Background Images (Admin) -->
            <div x-show="role === 'Admin'" 
                 x-transition:enter="transition ease-out duration-700" 
                 x-transition:enter-start="opacity-0 scale-110" 
                 x-transition:enter-end="opacity-100 scale-100"
                 class="absolute inset-0 bg-cover bg-center transition-transform duration-[2s]"
                 style="background-image: url('{{ asset('images/login-admin.png') }}')">
                <div class="absolute inset-0 bg-gradient-to-br from-indigo-900/60 via-transparent to-slate-900/80"></div>
            </div>

            <!-- Background Images (Staff) -->
            <div x-show="role === 'Staff'" 
                 x-transition:enter="transition ease-out duration-700" 
                 x-transition:enter-start="opacity-0 scale-110" 
                 x-transition:enter-end="opacity-100 scale-100"
                 class="absolute inset-0 bg-cover bg-center transition-transform duration-[2s]"
                 style="background-image: url('{{ asset('images/login-advisor.png') }}')">
                <div class="absolute inset-0 bg-gradient-to-br from-rose-900/60 via-transparent to-slate-900/80"></div>
            </div>

            <!-- Content Overlay -->
            <div class="relative z-10 w-full h-full p-12 flex flex-col justify-between">
                <div>
                    <div class="flex items-center gap-3">
                        <div class="h-10 w-10 rounded-xl bg-white/20 backdrop-blur-md flex items-center justify-center border border-white/30">
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <span class="text-2xl font-black text-white tracking-widest uppercase">NexoraByte</span>
                    </div>
                </div>

                <div class="space-y-6 max-w-lg">
                    <div class="space-y-2">
                        <h2 class="text-4xl lg:text-5xl font-black text-white leading-tight" x-text="role === 'Admin' ? 'Nexus Command & Workspace Control' : 'Empowering Professional Workflow'"></h2>
                        <p class="text-base lg:text-lg text-white/70 font-medium" x-text="role === 'Admin' ? 'The ultimate dashboard for managing your business ecosystem and tenant operations.' : 'Access your personalized workspace and manage your daily operations with precision.'"></p>
                    </div>
                    
                    <div class="flex gap-2">
                        <div class="h-1 w-12 rounded-full transition-all duration-500" :class="role === 'Admin' ? 'bg-white' : 'bg-white/30'"></div>
                        <div class="h-1 w-12 rounded-full transition-all duration-500" :class="role === 'Staff' ? 'bg-white' : 'bg-white/30'"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side: Login Form -->
        <div class="flex-1 bg-white dark:bg-slate-900 flex items-center justify-center p-8 lg:p-12 transition-colors duration-500">
            <div class="w-full max-w-md space-y-8 lg:space-y-10">
                
                <!-- Header -->
                <div class="text-center space-y-3">
                    <div class="lg:hidden flex justify-center mb-6">
                        <span class="text-2xl font-black text-slate-900 dark:text-white tracking-widest uppercase">NexoraByte</span>
                    </div>
                    <h1 class="text-2xl lg:text-3xl font-black text-slate-900 dark:text-white tracking-tight">Welcome Back, <span x-text="role" class="text-indigo-600"></span>!</h1>
                    <p class="text-[9px] text-slate-400 font-bold uppercase tracking-[0.2em]">Secure Authentication Access</p>
                </div>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <!-- Form -->
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf
                    
                    <div class="space-y-4 lg:space-y-5">
                        <!-- Email -->
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Corporate Email</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-slate-300 group-focus-within:text-indigo-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                    </svg>
                                </div>
                                <input type="email" name="email" :value="old('email')" required autofocus
                                    class="w-full pl-12 pr-4 py-3 lg:py-4 bg-slate-50 dark:bg-slate-800 border-none rounded-2xl text-slate-900 dark:text-white text-sm font-bold placeholder-slate-300 focus:ring-2 focus:ring-indigo-500 transition-all shadow-sm"
                                    placeholder="name@nexorabyte.in">
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="space-y-2" x-data="{ show: false }">
                            <div class="flex justify-between items-center ml-1">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Secure Password</label>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="text-[10px] font-black text-slate-300 hover:text-indigo-600 uppercase tracking-widest transition-colors">Recovery?</a>
                                @endif
                            </div>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-slate-300 group-focus-within:text-indigo-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                                <input :type="show ? 'text' : 'password'" name="password" required
                                    class="w-full pl-12 pr-12 py-3 lg:py-4 bg-slate-50 dark:bg-slate-800 border-none rounded-2xl text-slate-900 dark:text-white text-sm font-bold placeholder-slate-300 focus:ring-2 focus:ring-indigo-500 transition-all shadow-sm"
                                    placeholder="••••••••">
                                <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-300 hover:text-slate-500 transition-colors">
                                    <svg x-show="!show" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                    <svg x-show="show" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.076m10.893 3.427A3.378 3.378 0 0112 15a3.375 3.375 0 01-2.943-1.687m4.633-4.633a3.375 3.375 0 00-4.633 4.633m0 0l-4.633-4.633m4.633 4.633L21 21" /></svg>
                                </button>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                    </div>

                    <button type="submit" class="w-full py-4 bg-indigo-600 hover:bg-indigo-700 text-white text-[10px] font-black uppercase tracking-[0.2em] rounded-2xl shadow-xl shadow-indigo-100 dark:shadow-none transition-all active:scale-[0.98]">
                        Initiate Secure Login
                    </button>
                </form>

                <!-- Role Selector -->
                <div class="space-y-4 pt-4 border-t border-slate-50 dark:border-slate-800">
                    <p class="text-center text-[9px] font-black text-slate-400 uppercase tracking-widest">Select Access Portal</p>
                    <div class="grid grid-cols-2 gap-3">
                        <button @click="role = 'Admin'" type="button" 
                            class="flex items-center justify-center gap-2 py-3 px-4 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all duration-300 border"
                            :class="role === 'Admin' ? 'bg-indigo-600 text-white border-indigo-600 shadow-lg shadow-indigo-100 dark:shadow-none' : 'bg-white dark:bg-slate-800 text-slate-500 border-slate-100 dark:border-slate-700 hover:bg-slate-50'">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                            Admin
                        </button>
                        <button @click="role = 'Staff'" type="button" 
                            class="flex items-center justify-center gap-2 py-3 px-4 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all duration-300 border"
                            :class="role === 'Staff' ? 'bg-indigo-600 text-white border-indigo-600 shadow-lg shadow-indigo-100 dark:shadow-none' : 'bg-white dark:bg-slate-800 text-slate-500 border-slate-100 dark:border-slate-700 hover:bg-slate-50'">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                            Staff
                        </button>
                    </div>
                </div>

                <div class="text-center">
                    <p class="text-[9px] font-bold text-slate-300 uppercase tracking-widest">NexoraByte Intelligence Suite &bull; 2026</p>
                </div>

            </div>
        </div>
    </div>
</x-auth-split-layout>
