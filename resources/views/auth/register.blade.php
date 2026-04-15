<x-guest-layout>
    <div class="mb-4 text-center">
        <h2 class="text-3xl font-extrabold text-white tracking-tight">Admin Console</h2>
        <p class="text-sm text-slate-400 mt-2 uppercase tracking-widest font-bold">Register Primary Account</p>
    </div>


    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Company Name -->
        <div>
            <label for="company_name" class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Company / Organization Name</label>
            <input id="company_name" class="block w-full bg-slate-900 border-slate-700 text-white rounded-xl focus:ring-slate-500 focus:border-slate-500 transition-all py-2 px-3 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500" type="text" name="company_name" :value="old('company_name')" required autofocus autocomplete="organization" />
            <x-input-error :messages="$errors->get('company_name')" class="mt-1" />
        </div>

        <!-- Name -->
        <div>
            <label for="name" class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Member Full Name</label>
            <input id="name" class="block w-full bg-slate-900 border-slate-700 text-white rounded-xl focus:ring-slate-500 focus:border-slate-500 transition-all py-2 px-3 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500" type="text" name="name" :value="old('name')" required autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-1" />
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Official Email ID</label>
            <input id="email" class="block w-full bg-slate-900 border-slate-700 text-white rounded-xl focus:ring-slate-500 focus:border-slate-500 transition-all py-2 px-3 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Initialize Password</label>
            <input id="password" class="block w-full bg-slate-900 border-slate-700 text-white rounded-xl focus:ring-slate-500 focus:border-slate-500 transition-all py-2 px-3 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Verify Password</label>
            <input id="password_confirmation" class="block w-full bg-slate-900 border-slate-700 text-white rounded-xl focus:ring-slate-500 focus:border-slate-500 transition-all py-2 px-3 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
        </div>

        <div class="pt-2 flex flex-col gap-3">
            <button class="w-full bg-slate-800 hover:bg-slate-700 text-white font-black py-2.5 rounded-xl text-sm border border-slate-700 shadow-lg uppercase tracking-widest transition-all active:scale-95 transform">
                {{ __('Provision Account') }}
            </button>
            
            @if(!Auth::check() && !request()->has('flow'))
                <a class="text-center text-xs font-bold text-slate-500 hover:text-slate-300 uppercase tracking-widest transition-colors dark:text-slate-400" href="{{ route('login') }}">
                    {{ __('Back to Login') }}
                </a>
            @endif
        </div>
    </form>
</x-guest-layout>
