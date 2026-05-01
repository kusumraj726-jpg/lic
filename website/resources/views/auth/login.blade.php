<x-auth-split-layout title="Login">
    <div class="w-full max-w-5xl lg:min-h-[580px] bg-white/90 dark:bg-slate-900/90 backdrop-blur-2xl rounded-[2rem] lg:rounded-[2.5rem] flex flex-col lg:flex-row overflow-hidden shadow-2xl shadow-black/40 border border-white/20 transition-all duration-500" x-data="{ role: 'Admin' }">
        
        <!-- Left Side: Splash Hero (Hidden on Mobile) -->
        <div class="relative hidden lg:flex lg:w-[50%] min-h-[400px] lg:min-h-full overflow-hidden">
            <!-- Background Images (Admin) -->
            <div x-show="role === 'Admin'" 
                 x-transition:enter="transition ease-out duration-700" 
                 x-transition:enter-start="opacity-0 scale-110" 
                 x-transition:enter-end="opacity-100 scale-100"
                 class="absolute inset-0 bg-cover bg-center transition-transform duration-[2s]"
                 style="background-image: url('{{ asset('images/login-admin.webp') }}')">
                <div class="absolute inset-0 bg-gradient-to-br from-indigo-900/60 via-transparent to-slate-900/80"></div>
            </div>

            <!-- Background Images (Staff) -->
            <div x-show="role === 'Staff'" 
                 x-transition:enter="transition ease-out duration-700" 
                 x-transition:enter-start="opacity-0 scale-110" 
                 x-transition:enter-end="opacity-100 scale-100"
                 class="absolute inset-0 bg-cover bg-center transition-transform duration-[2s]"
                 style="background-image: url('{{ asset('images/login-advisor.webp') }}')">
                <div class="absolute inset-0 bg-gradient-to-br from-rose-900/60 via-transparent to-slate-900/80"></div>
            </div>

            <!-- Content Overlay -->
            <div class="relative z-10 w-full h-full p-10 flex flex-col justify-between">
                <div>
                    <!-- Logo moved to right side -->
                </div>

                <div class="space-y-4 max-w-sm">
                    <div class="space-y-2">
                        <h2 class="text-3xl lg:text-4xl font-black text-white leading-tight" x-text="role === 'Admin' ? 'System Control Center' : 'Professional Workspace'"></h2>
                        <p class="text-sm lg:text-base text-white/70 font-medium" x-text="role === 'Admin' ? 'Comprehensive management and oversight of your entire digital platform.' : 'Your centralized hub for efficient task management and daily productivity.'"></p>
                    </div>
                    
                    <div class="flex gap-2">
                        <div class="h-1 w-10 rounded-full transition-all duration-500" :class="role === 'Admin' ? 'bg-white' : 'bg-white/30'"></div>
                        <div class="h-1 w-10 rounded-full transition-all duration-500" :class="role === 'Staff' ? 'bg-white' : 'bg-white/30'"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side: Login Form -->
        <div class="flex-1 flex items-center justify-center p-6 lg:p-8 transition-colors duration-500">
            <div class="w-full max-w-sm space-y-4 lg:space-y-6">
                
                <!-- Header -->
                <div class="text-center space-y-1">
                    <div class="flex justify-center mb-4 items-center gap-3">
                        <img src="{{ asset('images/company_logo.jpg') }}" alt="nexorabyte" class="h-10 w-auto object-contain" style="filter: url(#chroma-key-black) contrast(1.1);">
                        <span class="text-2xl font-black text-slate-900 dark:text-white tracking-widest">nexorabyte</span>
                    </div>
                    <h1 class="text-2xl lg:text-3xl font-black text-slate-900 dark:text-white tracking-tight">Welcome Back, <span x-text="role" class="text-indigo-600"></span>!</h1>
                    <p class="text-[9px] text-slate-400 font-bold uppercase tracking-[0.2em]">Secure Authentication Access</p>
                </div>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <!-- Form -->
                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf
                    
                    <div class="space-y-3">
                        <!-- Email -->
                        <div class="space-y-1.5">
                            <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest ml-1">Corporate Email</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-4 w-4 text-slate-300 group-focus-within:text-indigo-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                    </svg>
                                </div>
                                <input type="email" name="email" value="{{ old('email') }}" required autofocus
                                    class="w-full pl-10 pr-4 py-3 bg-slate-50 dark:bg-slate-800 border-none rounded-xl text-slate-900 dark:text-white text-sm font-bold placeholder-slate-300 focus:ring-2 focus:ring-indigo-500 transition-all shadow-sm border border-transparent dark:border-slate-700"
                                    placeholder="name@nexorabyte.in">
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-1" />
                        </div>

                        <!-- Password -->
                        <div class="space-y-1.5" x-data="{ show: false }">
                            <div class="flex justify-between items-center ml-1">
                                <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Secure Password</label>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="text-[9px] font-black text-slate-500 hover:text-indigo-600 uppercase tracking-widest transition-colors">Recovery?</a>
                                @endif
                            </div>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-4 w-4 text-slate-300 group-focus-within:text-indigo-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                                <input :type="show ? 'text' : 'password'" name="password" required
                                    class="w-full pl-10 pr-10 py-3 bg-slate-50 dark:bg-slate-800 border-none rounded-xl text-slate-900 dark:text-white text-sm font-bold placeholder-slate-300 focus:ring-2 focus:ring-indigo-500 transition-all shadow-sm border border-transparent dark:border-slate-700"
                                    placeholder="••••••••">
                                <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-300 hover:text-indigo-500 transition-colors focus:outline-none flex-shrink-0">
                                    <!-- Eye Icon (Password Hidden) -->
                                    <svg x-show="!show" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.036 12.322a1.012 1.012 0 010-.644C3.752 8.202 7.5 5.25 12 5.25s8.248 2.952 9.964 6.428a1.012 1.012 0 010 .644C20.248 15.798 16.5 18.75 12 18.75s-8.248-2.952-9.964-6.428z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <!-- Eye-Off Icon (Password Visible) -->
                                    <svg x-show="show" x-cloak class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                                    </svg>
                                </button>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-1" />
                        </div>
                    </div>

                    <button type="submit" class="w-full py-3.5 bg-indigo-600 hover:bg-indigo-700 text-white text-[10px] font-black uppercase tracking-[0.2em] rounded-xl shadow-xl shadow-indigo-100 dark:shadow-none transition-all active:scale-[0.98]">
                        Initiate Secure Login
                    </button>
                </form>

                <!-- Role Selector -->
                <div class="space-y-3 pt-2 border-t border-slate-50 dark:border-slate-800">
                    <p class="text-center text-[8px] font-black text-slate-400 uppercase tracking-widest">Select Access Portal</p>
                    <div class="grid grid-cols-2 gap-2">
                        <button @click="role = 'Admin'" type="button" 
                            class="flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl text-[9px] font-black uppercase tracking-widest transition-all duration-300 border"
                            :class="role === 'Admin' ? 'bg-indigo-600 text-white border-indigo-600 shadow-lg shadow-indigo-100 dark:shadow-none' : 'bg-slate-50 dark:bg-slate-800 text-slate-500 border-slate-100 dark:border-slate-700 hover:bg-slate-100'">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                            Admin
                        </button>
                        <button @click="role = 'Staff'" type="button" 
                            class="flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl text-[9px] font-black uppercase tracking-widest transition-all duration-300 border"
                            :class="role === 'Staff' ? 'bg-indigo-600 text-white border-indigo-600 shadow-lg shadow-indigo-100 dark:shadow-none' : 'bg-slate-50 dark:bg-slate-800 text-slate-500 border-slate-100 dark:border-slate-700 hover:bg-slate-100'">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                            Staff
                        </button>
                    </div>
                </div>

                <div class="text-center">
                    <p class="text-[8px] font-bold text-slate-300 uppercase tracking-widest">NexoraByte Suite &bull; 2026</p>
                </div>

            </div>
        </div>
    </div>
</x-auth-split-layout>
