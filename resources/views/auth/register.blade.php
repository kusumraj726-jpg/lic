<x-guest-layout>
    <div class="mb-8 text-center">
        <h2 class="text-4xl font-extrabold text-slate-900 tracking-tight">Admin Console</h2>
        <p class="text-[10px] text-slate-400 mt-2 uppercase tracking-[0.3em] font-black">Register Primary Account</p>
        
        <div class="mt-6 p-4 rounded-2xl bg-amber-50 border border-amber-200 flex items-start gap-3">
            <svg class="w-5 h-5 text-amber-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
            <p class="text-[11px] font-bold text-amber-800 leading-relaxed text-left">
                <span class="uppercase tracking-wider block mb-1">Security Protocol:</span>
                This portal is for one-time provisioning only. Ensure all data is accurate before submitting.
            </p>
        </div>
    </div>


    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Company Name -->
        <div>
            <label for="company_name" class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Company / Organization Name</label>
            <input id="company_name" class="block w-full bg-white/60 border-slate-200 text-slate-900 rounded-2xl focus:ring-rose-500 focus:border-rose-500 transition-all py-3 px-4 placeholder-slate-400 font-medium" type="text" name="company_name" :value="old('company_name')" required autofocus placeholder="e.g. Global Tech Solutions" />
            <x-input-error :messages="$errors->get('company_name')" class="mt-1" />
        </div>

        <!-- Name -->
        <div>
            <label for="name" class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Member Full Name</label>
            <input id="name" class="block w-full bg-white/60 border-slate-200 text-slate-900 rounded-2xl focus:ring-rose-500 focus:border-rose-500 transition-all py-3 px-4 placeholder-slate-400 font-medium" type="text" name="name" :value="old('name')" required placeholder="e.g. John Doe" />
            <x-input-error :messages="$errors->get('name')" class="mt-1" />
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Official Email ID</label>
            <input id="email" class="block w-full bg-white/60 border-slate-200 text-slate-900 rounded-2xl focus:ring-rose-500 focus:border-rose-500 transition-all py-3 px-4 placeholder-slate-400 font-medium" type="email" name="email" :value="old('email')" required placeholder="john@company.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex justify-between items-center mb-2">
                <label for="password" class="block text-[10px] font-black text-slate-500 uppercase tracking-widest">Initialize Password</label>
                <span class="text-[9px] font-bold text-rose-500 uppercase tracking-tighter">Min. 8 Characters</span>
            </div>
            <input id="password" class="block w-full bg-white/60 border-slate-200 text-slate-900 rounded-2xl focus:ring-rose-500 focus:border-rose-500 transition-all py-3 px-4 placeholder-slate-400 font-medium"
                            type="password"
                            name="password"
                            required placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Verify Password</label>
            <input id="password_confirmation" class="block w-full bg-white/60 border-slate-200 text-slate-900 rounded-2xl focus:ring-rose-500 focus:border-rose-500 transition-all py-3 px-4 placeholder-slate-400 font-medium"
                            type="password"
                            name="password_confirmation" required placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
        </div>

        <div class="pt-4 flex flex-col gap-4">
            <button class="w-full bg-rose-600 hover:bg-rose-500 text-white font-black py-4 rounded-2xl text-[10px] shadow-lg shadow-rose-200 dark:shadow-none uppercase tracking-[0.2em] transition-all active:scale-95 transform">
                {{ __('Provision Account') }}
            </button>
            
            @if(!Auth::check() && !request()->has('flow'))
                <a class="text-center text-[10px] font-black text-slate-400 hover:text-rose-600 uppercase tracking-widest transition-colors" href="{{ route('login') }}">
                    {{ __('Back to Login') }}
                </a>
            @endif
        </div>
    </form>
</x-guest-layout>
