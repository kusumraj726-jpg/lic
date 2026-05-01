<section class="space-y-6">
    <header class="flex items-center gap-4 mb-10">
        <div class="h-12 w-12 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center shadow-sm">
            <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
        </div>
        <div>
            <h2 class="text-2xl font-black text-rose-600 uppercase tracking-tight">
                {{ __('Danger Zone') }}
            </h2>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mt-0.5">
                {{ __('Account deletion is permanent and cannot be undone.') }}
            </p>
        </div>
    </header>

    <div class="p-8 rounded-[1.5rem] bg-rose-50/50 border border-rose-100/50 flex flex-col md:flex-row items-center justify-between gap-6">
        <p class="text-xs font-bold text-rose-800 leading-relaxed max-w-lg">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please download any data or information that you wish to retain before proceeding.') }}
        </p>

        <button 
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
            class="shrink-0 inline-flex items-center gap-2 px-8 py-4 rounded-2xl bg-rose-600 text-white font-black text-xs uppercase tracking-widest hover:bg-rose-700 shadow-xl transition-all w-full justify-center md:w-auto"
        >
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
            {{ __('Initiate Deletion') }}
        </button>
    </div>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-10">
            @csrf
            @method('delete')

            <div class="flex items-center gap-4 mb-6">
                <div class="h-12 w-12 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center">
                    <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                </div>
                <div>
                    <h2 class="text-2xl font-black text-slate-900 uppercase tracking-tight mb-1 dark:text-slate-100">
                        {{ __('Confirm Account Deletion') }}
                    </h2>
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">
                        {{ __('This action is permanent and irreversible.') }}
                    </p>
                </div>
            </div>

            <p class="text-sm font-bold text-slate-500 mb-8 border-l-4 border-rose-500 pl-4 bg-slate-50 py-3 pr-4 rounded-r-xl dark:text-slate-400 dark:bg-slate-800/50">
                {{ __('To proceed with account deletion, please enter your password to verify your identity.') }}
            </p>

            <div class="space-y-4">
                <label for="password" class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1 mb-2 block">{{ __('Account Password') }}</label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    class="w-full px-6 py-4 bg-slate-50 rounded-[1.5rem] border border-slate-100 focus:border-rose-500 text-slate-900 font-black text-lg focus:bg-white focus:ring-4 focus:ring-rose-500/10 transition-all placeholder:text-slate-300 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500"
                    placeholder="{{ __('Verify your identity') }}"
                />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-10 flex flex-col md:flex-row justify-end gap-4">
                <button type="button" x-on:click="$dispatch('close')" class="inline-flex items-center gap-2 px-8 py-4 rounded-2xl bg-white border-2 border-slate-100 text-xs font-black text-slate-600 hover:border-slate-300 hover:bg-slate-50 transition-all uppercase tracking-widest justify-center dark:text-slate-300 dark:hover:bg-slate-800/50">
                    {{ __('Cancel Action') }}
                </button>

                <button type="submit" class="inline-flex items-center gap-2 px-8 py-4 rounded-2xl bg-rose-600 text-xs font-black text-white hover:bg-rose-700 hover:shadow-lg hover: transition-all uppercase tracking-widest justify-center">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                    {{ __('Confirm Delete') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>
