<section>
    <header class="flex items-center gap-4 mb-10">
        <div class="h-12 w-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center shadow-sm">
            <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
        </div>
        <div>
            <h2 class="text-2xl font-black text-slate-900 uppercase tracking-tight dark:text-slate-100">
                {{ __('Profile Identity') }}
            </h2>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mt-0.5">
                {{ __("Manage your personal presence and contact info") }}
            </p>
        </div>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-8" enctype="multipart/form-data" x-data="{ 
        photoName: null, 
        photoPreview: null,
        updatePreview() {
            const reader = new FileReader();
            reader.onload = (e) => {
                this.photoPreview = e.target.result;
            };
            reader.readAsDataURL(this.$refs.photo.files[0]);
        }
    }">
        @csrf
        @method('patch')

        <!-- Profile Photo -->
        <div class="flex items-center gap-8 p-6 rounded-2xl bg-slate-50/50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-700">
            <div class="relative group">
                <input type="file" name="avatar" class="hidden dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500" x-ref="photo" @change="updatePreview()">
                
                <div class="h-24 w-24 rounded-3xl p-1 bg-gradient-to-br from-indigo-500 to-purple-600 shadow-xl group-hover: transition-all cursor-pointer overflow-hidden" @click="$refs.photo.click()">
                    <!-- Current Photo -->
                    <div class="h-full w-full rounded-[20px] bg-white flex items-center justify-center overflow-hidden" x-show="!photoPreview">
                        @if($user->avatar)
                            @php
                                $disk = config('filesystems.disks.s3.key') ? 's3' : config('filesystems.default');
                                $avatarUrl = $disk === 's3' 
                                    ? Storage::disk($disk)->temporaryUrl($user->avatar, now()->addMinutes(60))
                                    : Storage::disk($disk)->url($user->avatar);
                            @endphp
                            <img src="{{ $avatarUrl }}" class="h-full w-full object-cover">
                        @else
                            <span class="text-3xl font-black text-indigo-600 uppercase">{{ substr($user->name, 0, 1) }}</span>
                        @endif
                    </div>
                    <!-- New Photo Preview -->
                    <div class="h-full w-full rounded-[20px] bg-white flex items-center justify-center overflow-hidden" x-show="photoPreview" style="display: none;">
                        <img :src="photoPreview" class="h-full w-full object-cover">
                    </div>

                    <!-- Hover Overlay -->
                    <div class="absolute inset-0 bg-indigo-600/60 rounded-3xl flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                        <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                    </div>
                </div>
            </div>

            <div>
                <h3 class="text-sm font-black text-slate-800 uppercase tracking-wider mb-1 dark:text-slate-200">Profile Picture</h3>
                <p class="text-xs font-bold text-slate-400 mb-4 leading-relaxed max-w-[200px]">Update your photo to make your account more recognizable.</p>
                <button type="button" @click="$refs.photo.click()" class="text-xs font-black uppercase text-indigo-600 hover:text-indigo-800 transition-colors">
                    Click to Upload
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 pt-4 items-start">
            <div>
                <label for="name" class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] ml-1 mb-2 block">Full Legal Name</label>
                <input id="name" name="name" type="text" class="w-full px-6 py-4 bg-slate-50 dark:bg-[#0f172a] rounded-[1.5rem] border {{ $errors->has('name') ? 'border-rose-300' : 'border-slate-100 dark:border-slate-700 focus:border-indigo-500' }} text-slate-900 dark:text-white font-black text-lg focus:bg-white dark:focus:bg-[#1e293b] focus:ring-4 focus:ring-indigo-500/10 transition-all placeholder:text-slate-300 dark:placeholder:text-slate-600" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <label for="email" class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] ml-1 mb-2 block">Verified Email</label>
                <input id="email" name="email" type="email" class="w-full px-6 py-4 bg-slate-50 dark:bg-[#0f172a] rounded-[1.5rem] border {{ $errors->has('email') ? 'border-rose-300' : 'border-slate-100 dark:border-slate-700 focus:border-indigo-500' }} text-slate-900 dark:text-white font-black text-lg focus:bg-white dark:focus:bg-[#1e293b] focus:ring-4 focus:ring-indigo-500/10 transition-all placeholder:text-slate-300 dark:placeholder:text-slate-600" value="{{ old('email', $user->email) }}" required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="mt-4 p-4 bg-amber-50 rounded-xl border border-amber-100 flex items-center justify-between">
                        <p class="text-[11px] font-bold text-amber-800">
                            {{ __('Your email is unverified.') }}
                        </p>
                        <button form="send-verification" class="text-[10px] font-black uppercase text-amber-700 hover:text-amber-900">
                            {{ __('Resend Link') }}
                        </button>
                    </div>
                @endif
            </div>
        </div>

        <div class="flex items-center gap-4 pt-8 border-t border-slate-50 dark:border-slate-700/50 justify-start">
            @if (session('status') === 'profile-updated')
                <div
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2500)"
                    class="flex items-center gap-2 text-emerald-600 bg-emerald-50 px-4 py-2 flex-1 max-w-[200px] rounded-[1rem]"
                >
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                    <span class="text-[10px] font-black uppercase tracking-[0.1em]">{{ __('Identity Sync Complete') }}</span>
                </div>
            @endif

            <button type="submit" class="inline-flex items-center gap-2 px-8 py-4 rounded-2xl bg-indigo-600 text-xs font-black text-white hover:bg-indigo-700 hover:shadow-lg hover: transition-all uppercase tracking-widest w-full justify-center md:w-auto">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                {{ __('Update Profile Identity') }}
            </button>
        </div>
    </form>
</section>
