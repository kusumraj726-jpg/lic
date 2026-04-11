<x-guest-layout>
    <div class="mb-4 text-center">
        <h2 class="text-3xl font-extrabold text-white tracking-tight">Admin Console</h2>
        <p class="text-sm text-slate-400 mt-2 uppercase tracking-widest font-bold">Register Primary Account</p>
    </div>

    @if (session('success'))
        <div class="mb-4 p-3 bg-green-500/20 border border-green-500/50 rounded-xl text-green-400 text-sm font-bold flex items-center gap-3">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Company Name -->
        <div>
            <label for="company_name" class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Company / Organization Name</label>
            <input id="company_name" class="block w-full bg-slate-900 border-slate-700 text-white rounded-xl focus:ring-slate-500 focus:border-slate-500 transition-all py-2 px-3" type="text" name="company_name" :value="old('company_name')" required autofocus autocomplete="organization" />
            <x-input-error :messages="$errors->get('company_name')" class="mt-1" />
        </div>

        <!-- Name -->
        <div>
            <label for="name" class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Member Full Name</label>
            <input id="name" class="block w-full bg-slate-900 border-slate-700 text-white rounded-xl focus:ring-slate-500 focus:border-slate-500 transition-all py-2 px-3" type="text" name="name" :value="old('name')" required autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-1" />
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Official Email ID</label>
            <input id="email" class="block w-full bg-slate-900 border-slate-700 text-white rounded-xl focus:ring-slate-500 focus:border-slate-500 transition-all py-2 px-3" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Initialize Password</label>
            <input id="password" class="block w-full bg-slate-900 border-slate-700 text-white rounded-xl focus:ring-slate-500 focus:border-slate-500 transition-all py-2 px-3"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Verify Password</label>
            <input id="password_confirmation" class="block w-full bg-slate-900 border-slate-700 text-white rounded-xl focus:ring-slate-500 focus:border-slate-500 transition-all py-2 px-3"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
        </div>

        <div class="pt-2 flex flex-col gap-3">
            <button class="w-full bg-slate-800 hover:bg-slate-700 text-white font-black py-2.5 rounded-xl text-sm border border-slate-700 shadow-lg uppercase tracking-widest transition-all active:scale-95 transform">
                {{ __('Provision Account') }}
            </button>
            
            @if(!Auth::check())
                <a class="text-center text-xs font-bold text-slate-500 hover:text-slate-300 uppercase tracking-widest transition-colors" href="{{ route('login') }}">
                    {{ __('Back to Control Portal') }}
                </a>
            @endif
        </div>
    </form>
</x-guest-layout>
