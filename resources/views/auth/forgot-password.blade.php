<x-guest-layout>
    <div class="mb-8 text-center">
        <h2 class="text-4xl font-extrabold text-slate-900 tracking-tight">Recover Access</h2>
        <p class="text-[10px] text-slate-400 mt-2 uppercase tracking-[0.3em] font-black">Secure Intelligence Restoration</p>
    </div>

    <div class="mb-8 text-[11px] font-medium text-slate-600 leading-relaxed text-center px-4">
        {{ __('Input your credentials. Our core engine will dispatch a secure restoration link to your official email ID instantly.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6 text-left">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Official Email ID</label>
            <input id="email" class="block w-full bg-white/60 border-slate-200 text-slate-900 rounded-2xl focus:ring-rose-500 focus:border-rose-500 transition-all py-3 px-4 placeholder-slate-400 font-medium" type="email" name="email" :value="old('email')" required autofocus placeholder="name@company.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="pt-4 flex flex-col gap-4">
            <button class="w-full bg-rose-600 hover:bg-rose-500 text-white font-black py-4 rounded-2xl text-[10px] shadow-lg shadow-rose-200 uppercase tracking-[0.2em] transition-all active:scale-95 transform">
                {{ __('Dispatch Restoration Link') }}
            </button>
            
            <a class="text-center text-[10px] font-black text-slate-400 hover:text-rose-600 uppercase tracking-widest transition-colors" href="{{ route('login') }}">
                {{ __('Back to Login') }}
            </a>
        </div>
    </form>
</x-guest-layout>
