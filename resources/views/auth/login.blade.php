<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-4 text-center">
        <h2 class="text-3xl font-extrabold text-white tracking-tight">Access Portal</h2>
        <p class="text-sm text-slate-400 mt-2">Enter credentials to securely access your workspace.</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-1.5">Corporate Email</label>
            <input id="email" class="block w-full bg-slate-900 border-slate-700 text-white rounded-xl focus:ring-slate-500 focus:border-slate-500 transition-all py-2.5 px-4" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-1.5">Secure Password</label>
            <input id="password" class="block w-full bg-slate-900 border-slate-700 text-white rounded-xl focus:ring-slate-500 focus:border-slate-500 transition-all py-2.5 px-4"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center group cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded bg-slate-900 border-slate-700 text-slate-500 shadow-sm focus:ring-slate-500 focus:ring-offset-slate-900" name="remember">
                <span class="ms-2 text-sm text-slate-400 group-hover:text-slate-300 transition-colors">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-xs font-bold text-slate-400 hover:text-white uppercase tracking-widest transition-colors" href="{{ route('password.request') }}">
                    {{ __('Recovery?') }}
                </a>
            @endif
        </div>

        <div class="pt-2">
            <button class="w-full bg-slate-800 hover:bg-slate-700 text-white font-black py-3 rounded-xl border border-slate-700 shadow-lg uppercase tracking-widest transition-all active:scale-95 transform">
                {{ __('Initiate Login') }}
            </button>
        </div>
    </form>
</x-guest-layout>
