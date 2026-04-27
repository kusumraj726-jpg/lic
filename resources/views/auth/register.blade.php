<x-auth-split-layout>
    <div class="w-full max-w-6xl lg:min-h-[750px] bg-white/90 dark:bg-slate-900/90 backdrop-blur-2xl rounded-[2rem] lg:rounded-[3rem] flex flex-col lg:flex-row overflow-hidden shadow-2xl shadow-black/40 border border-white/20 transition-all duration-500 my-8">
        
        <!-- Left Side: Splash Hero (Hidden on Mobile) -->
        <div class="relative hidden lg:flex lg:w-[50%] min-h-[400px] lg:min-h-full overflow-hidden">
            <div class="absolute inset-0 bg-cover bg-center transition-transform duration-[2s]"
                 style="background-image: url('{{ asset('images/login-admin.png') }}')">
                <div class="absolute inset-0 bg-gradient-to-br from-indigo-900/60 via-transparent to-slate-900/80"></div>
            </div>

            <!-- Content Overlay -->
            <div class="relative z-10 w-full h-full p-12 flex flex-col justify-between text-white">
                <div>
                    <div class="flex items-center gap-3">
                        <div class="h-10 w-10 rounded-xl bg-white/20 backdrop-blur-md flex items-center justify-center border border-white/30 shadow-lg">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <span class="text-2xl font-black tracking-widest uppercase">NexoraByte</span>
                    </div>
                </div>

                <div class="space-y-6 max-w-lg">
                    <div class="space-y-2">
                        <h2 class="text-5xl font-black leading-tight">Begin Your Enterprise Journey.</h2>
                        <p class="text-lg text-white/70 font-medium">Provision your workspace and join the elite network of professional insurance intelligence.</p>
                    </div>
                    
                    <div class="flex gap-2">
                        <div class="h-1 w-12 rounded-full bg-white"></div>
                        <div class="h-1 w-12 rounded-full bg-white/30"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side: Register Form -->
        <div class="flex-1 flex flex-col p-8 lg:p-12 transition-colors duration-500 overflow-y-auto max-h-[85vh] lg:max-h-full">
            <div class="w-full max-w-md mx-auto space-y-8">
                
                <!-- Onboarding Progress Bar (Preserved Logic) -->
                @if(request()->has('flow'))
                    @php $currentStep = request()->input('step', 1); @endphp
                    <div class="flex justify-center items-center gap-3 mb-8">
                        <div class="flex items-center gap-2 {{ $currentStep >= 1 ? 'text-indigo-600 dark:text-indigo-400' : 'text-slate-400' }}">
                            <span class="flex items-center justify-center w-6 h-6 rounded-full border-2 {{ $currentStep > 1 ? 'bg-indigo-600 border-indigo-600 text-white' : 'border-indigo-600' }} text-[10px] font-black">
                                {{ $currentStep > 1 ? '✓' : '1' }}
                            </span>
                            <span class="text-[9px] uppercase font-black tracking-widest">Pay</span>
                        </div>
                        <div class="w-8 h-px {{ $currentStep >= 2 ? 'bg-indigo-500' : 'bg-slate-200 dark:bg-slate-800' }}"></div>
                        <div class="flex items-center gap-2 {{ $currentStep >= 2 ? 'text-indigo-600 dark:text-indigo-400' : 'text-slate-400' }}">
                            <span class="flex items-center justify-center w-6 h-6 rounded-full border-2 {{ $currentStep == 2 ? 'border-indigo-600 text-indigo-600' : ($currentStep > 2 ? 'bg-indigo-600 border-indigo-600 text-white' : 'border-slate-300 dark:border-slate-700') }} text-[10px] font-black">
                                {{ $currentStep > 2 ? '✓' : '2' }}
                            </span>
                            <span class="text-[9px] uppercase font-black tracking-widest">Register</span>
                        </div>
                        <div class="w-8 h-px {{ $currentStep >= 3 ? 'bg-indigo-500' : 'bg-slate-200 dark:bg-slate-800' }}"></div>
                        <div class="flex items-center gap-2 {{ $currentStep >= 3 ? 'text-indigo-600 dark:text-indigo-400' : 'text-slate-400' }}">
                             <span class="flex items-center justify-center w-6 h-6 rounded-full border-2 {{ $currentStep == 3 ? 'border-indigo-600 text-indigo-600' : 'border-slate-300 dark:border-slate-700' }} text-[10px] font-black">3</span>
                            <span class="text-[9px] uppercase font-black tracking-widest">Login</span>
                        </div>
                    </div>
                @endif

                <div class="text-center space-y-3">
                    <div class="lg:hidden flex justify-center mb-6">
                        <span class="text-2xl font-black text-slate-900 dark:text-white tracking-widest uppercase">NexoraByte</span>
                    </div>
                    <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">Create Workspace</h1>
                    <p class="text-[9px] text-slate-400 font-bold uppercase tracking-[0.2em]">Provision your primary admin console</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf
                    
                    <div class="grid grid-cols-1 gap-4">
                        <!-- Company Name -->
                        <div class="space-y-1.5">
                            <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest ml-1">Company / Organization</label>
                            <input type="text" name="company_name" :value="old('company_name')" required autofocus
                                class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border-none rounded-2xl text-slate-900 dark:text-white text-sm font-bold placeholder-slate-300 focus:ring-2 focus:ring-indigo-500 transition-all shadow-sm"
                                placeholder="e.g. Nexus Insurance Group">
                            <x-input-error :messages="$errors->get('company_name')" class="mt-1" />
                        </div>

                        <!-- Name -->
                        <div class="space-y-1.5">
                            <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest ml-1">Admin Full Name</label>
                            <input type="text" name="name" :value="old('name')" required
                                class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border-none rounded-2xl text-slate-900 dark:text-white text-sm font-bold placeholder-slate-300 focus:ring-2 focus:ring-indigo-500 transition-all shadow-sm"
                                placeholder="John Doe">
                            <x-input-error :messages="$errors->get('name')" class="mt-1" />
                        </div>

                        <!-- Email -->
                        <div class="space-y-1.5">
                            <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest ml-1">Official Email ID</label>
                            <input type="email" name="email" :value="old('email')" required
                                class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border-none rounded-2xl text-slate-900 dark:text-white text-sm font-bold placeholder-slate-300 focus:ring-2 focus:ring-indigo-500 transition-all shadow-sm"
                                placeholder="name@company.com">
                            <x-input-error :messages="$errors->get('email')" class="mt-1" />
                        </div>

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                            <!-- Password -->
                            <div class="space-y-1.5">
                                <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest ml-1">Password</label>
                                <input type="password" name="password" required
                                    class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border-none rounded-2xl text-slate-900 dark:text-white text-sm font-bold placeholder-slate-300 focus:ring-2 focus:ring-indigo-500 transition-all shadow-sm"
                                    placeholder="••••••••">
                                <x-input-error :messages="$errors->get('password')" class="mt-1" />
                            </div>

                            <!-- Confirm Password -->
                            <div class="space-y-1.5">
                                <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest ml-1">Confirm</label>
                                <input type="password" name="password_confirmation" required
                                    class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border-none rounded-2xl text-slate-900 dark:text-white text-sm font-bold placeholder-slate-300 focus:ring-2 focus:ring-indigo-500 transition-all shadow-sm"
                                    placeholder="••••••••">
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                            </div>
                        </div>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full py-4 bg-indigo-600 hover:bg-indigo-700 text-white text-[10px] font-black uppercase tracking-[0.2em] rounded-2xl shadow-xl shadow-indigo-100 dark:shadow-none transition-all active:scale-[0.98]">
                            Provision Elite Account
                        </button>
                    </div>

                    @if(!Auth::check() && !request()->has('flow'))
                        <div class="text-center">
                            <a href="{{ route('login') }}" class="text-[9px] font-black text-slate-400 hover:text-indigo-600 uppercase tracking-widest transition-colors">
                                Already have an account? Login
                            </a>
                        </div>
                    @endif
                </form>

                <div class="text-center pt-4">
                    <p class="text-[9px] font-bold text-slate-300 uppercase tracking-widest">NexoraByte Intelligence &bull; Verified Provisioning</p>
                </div>
            </div>
        </div>
    </div>
</x-auth-split-layout>
