<section>
    <header class="flex items-center gap-4 mb-10">
        <div class="h-12 w-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center shadow-sm">
            <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 00-2 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
        </div>
        <div>
            <h2 class="text-2xl font-black text-slate-900 uppercase tracking-tight dark:text-slate-100">
                {{ __('Security & Password') }}
            </h2>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mt-0.5">
                {{ __('Ensure your account is using a long, random password.') }}
            </p>
        </div>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-8 space-y-6">
        @csrf
        @method('put')

        <div class="grid grid-cols-1 gap-6">
            <div>
                <label for="update_password_current_password" class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] ml-1 mb-2 block">Current Password</label>
                <input id="update_password_current_password" name="current_password" type="password" class="w-full px-6 py-4 bg-slate-50 dark:bg-[#0f172a] rounded-[1.5rem] border border-slate-100 dark:border-slate-700 focus:border-indigo-500 text-slate-900 dark:text-white font-black text-lg focus:bg-white dark:focus:bg-[#1e293b] focus:ring-4 focus:ring-indigo-500/10 transition-all placeholder:text-slate-300 dark:placeholder:text-slate-600" autocomplete="current-password" />
                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
            </div>

            <div>
                <label for="update_password_password" class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] ml-1 mb-2 block">New Password</label>
                <input id="update_password_password" name="password" type="password" class="w-full px-6 py-4 bg-slate-50 dark:bg-[#0f172a] rounded-[1.5rem] border border-slate-100 dark:border-slate-700 focus:border-indigo-500 text-slate-900 dark:text-white font-black text-lg focus:bg-white dark:focus:bg-[#1e293b] focus:ring-4 focus:ring-indigo-500/10 transition-all placeholder:text-slate-300 dark:placeholder:text-slate-600" autocomplete="new-password" />
                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
            </div>

            <div>
                <label for="update_password_password_confirmation" class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] ml-1 mb-2 block">Confirm Password</label>
                <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="w-full px-6 py-4 bg-slate-50 dark:bg-[#0f172a] rounded-[1.5rem] border border-slate-100 dark:border-slate-700 focus:border-indigo-500 text-slate-900 dark:text-white font-black text-lg focus:bg-white dark:focus:bg-[#1e293b] focus:ring-4 focus:ring-indigo-500/10 transition-all placeholder:text-slate-300 dark:placeholder:text-slate-600" autocomplete="new-password" />
                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <div class="flex items-center gap-4 pt-8 border-t border-slate-50 dark:border-slate-700/50 justify-start">
            @if (session('status') === 'password-updated')
                <div
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2500)"
                    class="flex items-center gap-2 text-emerald-600 bg-emerald-50 px-4 py-2 flex-1 max-w-[200px] rounded-[1rem]"
                >
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                    <span class="text-[10px] font-black uppercase tracking-[0.1em]">{{ __('Security Updated') }}</span>
                </div>
            @endif

            <button type="submit" class="inline-flex items-center gap-2 px-8 py-4 rounded-2xl bg-indigo-600 text-xs font-black text-white hover:bg-indigo-700 hover:shadow-lg hover: transition-all uppercase tracking-widest w-full justify-center md:w-auto">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 00-2 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                {{ __('Update Security') }}
            </button>
        </div>
    </form>
</section>
