    <header class="flex items-center gap-4 mb-6">
        <div class="h-10 w-10 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
        </div>
        <div>
            <h2 class="text-xl font-black text-rose-600 uppercase tracking-tight">
                {{ __('Danger Zone') }}
            </h2>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-0.5">
                {{ __('Account deletion is permanent and cannot be undone.') }}
            </p>
        </div>
    </header>

    <div class="p-6 rounded-2xl bg-rose-50/50 border border-rose-100/50">
        <p class="text-sm font-bold text-rose-800 mb-6 leading-relaxed">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please download any data or information that you wish to retain before proceeding.') }}
        </p>

        <button 
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
            class="px-6 py-3 rounded-xl bg-rose-600 text-white font-black text-xs uppercase tracking-widest hover:bg-rose-700 shadow-xl shadow-rose-200 transition-all"
        >
            {{ __('Initiate Deletion') }}
        </button>
    </div>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-10">
            @csrf
            @method('delete')

            <h2 class="text-2xl font-black text-slate-900 uppercase tracking-tight mb-2">
                {{ __('Confirm Account Deletion') }}
            </h2>

            <p class="text-sm font-bold text-slate-500 mb-8">
                {{ __('To proceed with account deletion, please enter your password. This action is irreversible.') }}
            </p>

            <div class="space-y-2">
                <label for="password" class="text-xs font-black text-slate-400 uppercase tracking-widest block">{{ __('Account Password') }}</label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    class="w-full rounded-xl border-slate-200 focus:border-rose-500 focus:ring-rose-500 shadow-sm"
                    placeholder="{{ __('Verify your identity') }}"
                />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-10 flex justify-end gap-3">
                <button type="button" x-on:click="$dispatch('close')" class="px-6 py-3 rounded-xl text-xs font-black uppercase text-slate-400 hover:text-slate-600 hover:bg-slate-50 transition-all">
                    {{ __('Cancel Action') }}
                </button>

                <button type="submit" class="px-6 py-3 rounded-xl bg-rose-600 text-white font-black text-xs uppercase tracking-widest hover:bg-rose-700 shadow-xl shadow-rose-200 transition-all">
                    {{ __('Confirm Delete') }}
                </button>
            </div>
        </form>
    </x-modal>
