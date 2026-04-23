<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-8 text-center">
        <h2 class="text-4xl font-extrabold text-slate-900 tracking-tight">Access Portal</h2>
        <p class="text-[10px] text-slate-400 mt-2 uppercase tracking-[0.3em] font-black">Enter credentials to securely access your workspace.</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Corporate Email</label>
            <input id="email" class="block w-full bg-white/60 border-slate-200 text-slate-900 rounded-2xl focus:ring-rose-500 focus:border-rose-500 transition-all py-3 px-4 placeholder-slate-400 font-medium" type="email" name="email" :value="old('email')" required autofocus placeholder="name@company.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Secure Password</label>
            <input id="password" class="block w-full bg-white/60 border-slate-200 text-slate-900 rounded-2xl focus:ring-rose-500 focus:border-rose-500 transition-all py-3 px-4 placeholder-slate-400 font-medium"
                            type="password"
                            name="password"
                            required placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Forget Password / Recovery -->
        <div class="flex items-center justify-end">
            @if (Route::has('password.request'))
                <a class="text-[10px] font-black text-slate-400 hover:text-rose-600 uppercase tracking-widest transition-colors" href="{{ route('password.request') }}">
                    {{ __('Recovery?') }}
                </a>
            @endif
        </div>

        <div class="pt-4">
            <button class="w-full bg-rose-600 hover:bg-rose-500 text-white font-black py-4 rounded-2xl text-[10px] shadow-lg shadow-rose-200 uppercase tracking-[0.2em] transition-all active:scale-95 transform">
                {{ __('Initiate Login') }}
            </button>
        </div>
    </form>
</x-guest-layout>
