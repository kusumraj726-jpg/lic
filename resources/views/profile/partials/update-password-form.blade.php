    <header class="flex items-center gap-4 mb-6">
        <div class="h-10 w-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 00-2 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
        </div>
        <div>
            <h2 class="text-xl font-black text-slate-900 uppercase tracking-tight">
                {{ __('Update Password') }}
            </h2>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-0.5">
                {{ __('Ensure your account is using a long, random password.') }}
            </p>
        </div>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-8 space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="text-xs font-black text-slate-400 uppercase tracking-widest mb-1 block">Current Password</label>
            <input id="update_password_current_password" name="current_password" type="password" class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <label for="update_password_password" class="text-xs font-black text-slate-400 uppercase tracking-widest mb-1 block">New Password</label>
            <input id="update_password_password" name="password" type="password" class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <label for="update_password_password_confirmation" class="text-xs font-black text-slate-400 uppercase tracking-widest mb-1 block">Confirm Password</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="premium-btn premium-btn-primary !px-10 shadow-indigo-100 shadow-xl">
                {{ __('Update Security') }}
            </button>

            @if (session('status') === 'password-updated')
                <div
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="flex items-center gap-2 text-emerald-600"
                >
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                    <span class="text-xs font-black uppercase tracking-widest">{{ __('Security Updated') }}</span>
                </div>
            @endif
        </div>
    </form>
