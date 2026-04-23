<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-slate-900 uppercase tracking-tight dark:text-slate-100">
            {{ __('Settings Console') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-8 items-start">
                
                <!-- Advanced Navigation Sidebar -->
                <div class="w-full lg:w-80 shrink-0 sticky top-24">
                    <div class="mb-6">
                        <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">Console</h1>
                        <p class="text-slate-500 text-xs font-bold uppercase tracking-widest mt-1 dark:text-slate-400">Workspace Control</p>
                    </div>

                    <div class="space-y-1.5 p-1.5 bg-slate-100/50 dark:bg-slate-800/50 rounded-[2rem] border border-slate-200/50 dark:border-slate-700/50 backdrop-blur-sm">
                        <x-settings-nav-link :href="route('settings.index')" :active="request()->routeIs('settings.index')">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                            General Workspace
                        </x-settings-nav-link>

                        <x-settings-nav-link :href="route('settings.logs', ['type' => 'staff'])" :active="request()->get('type') === 'staff'">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                            Staff Intel logs
                        </x-settings-nav-link>

                        <x-settings-nav-link :href="route('settings.logs', ['type' => 'admin'])" :active="request()->get('type') === 'admin'">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                            Admin Authority Logs
                        </x-settings-nav-link>

                        <div class="mt-4 pt-4 border-t border-slate-200 dark:border-slate-700/50 mx-2">
                             <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-xs font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest hover:bg-white dark:hover:bg-slate-700 hover:text-indigo-600 dark:hover:text-indigo-400 transition-all">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                My User Profile
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Settings Content Hub -->
                <div class="flex-1 min-w-0 space-y-8">
                    <!-- General Settings Card -->
                    <div class="premium-card bg-white dark:bg-[#1e293b] border-none shadow-2xl relative overflow-hidden group !p-10">
                        <div class="absolute top-0 right-0 w-64 h-64 bg-indigo-500/5 dark:bg-indigo-500/10 rounded-full blur-3xl -mr-32 -mt-32 transition-transform duration-1000 group-hover:scale-150"></div>
                        
                        <div class="relative">
                            <div class="flex items-center justify-between mb-10">
                                <div>
                                    <h3 class="text-2xl font-black text-slate-900 dark:text-white tracking-tight">Branding & Identity</h3>
                                    <p class="text-slate-400 dark:text-slate-400 text-[10px] font-black uppercase tracking-[0.2em] mt-1">Primary Workspace Details</p>
                                </div>
                                <div class="h-12 w-12 rounded-2xl bg-indigo-50 dark:bg-indigo-500/10 flex items-center justify-center text-indigo-600 dark:text-indigo-400">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                                </div>
                            </div>

                            <form action="{{ route('settings.branding.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8" x-data="{ logoPreview: null }">
                                @csrf
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-start">
                                    <div class="space-y-4">
                                        <div>
                                             <label class="text-[11px] font-black text-slate-900 dark:text-white uppercase tracking-[0.2em] ml-1 mb-2 block">Company Entity</label>
                                            <input type="text" name="company_name" value="{{ old('company_name', $context->company_name) }}" class="w-full px-6 py-4 bg-slate-50 dark:bg-[#0f172a] rounded-[1.5rem] border {{ $errors->has('company_name') ? 'border-rose-300' : 'border-slate-100 dark:border-slate-700 focus:border-indigo-500' }} text-slate-900 dark:text-white font-black text-lg focus:bg-white dark:focus:bg-[#1e293b] focus:ring-4 focus:ring-indigo-500/10 transition-all placeholder:text-slate-300 dark:placeholder:text-slate-600" placeholder="e.g. Sharma Insurance" required>
                                            @error('company_name')
                                                <p class="text-[10px] font-bold text-rose-500 mt-2 uppercase tracking-widest">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                             <label class="block text-[11px] font-black text-slate-900 dark:text-white uppercase tracking-[0.2em] ml-1 mb-2">Workspace Logo</label>
                                            <div class="flex items-center gap-6">
                                                <div class="h-24 w-24 rounded-3xl bg-slate-50 dark:bg-[#0f172a] border-2 border-dashed border-slate-200 dark:border-slate-700 flex items-center justify-center overflow-hidden shrink-0 shadow-inner group-hover/card:bg-white transition-colors relative">
                                                    @if($context->brand_logo)
                                                        <img :src="logoPreview ? logoPreview : '{{ Storage::disk('public')->url($context->brand_logo) }}'" class="h-full w-full object-contain p-2 z-10 bg-white dark:bg-slate-800">
                                                    @else
                                                        <div x-show="!logoPreview" class="text-slate-300 dark:text-slate-600 flex flex-col items-center">
                                                            <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                                        </div>
                                                        <img x-show="logoPreview" :src="logoPreview" class="absolute inset-0 h-full w-full object-contain p-2 z-10 bg-white dark:bg-slate-800" style="display: none;">
                                                    @endif
                                                </div>
                                                <div class="flex-1">
                                                    <input type="file" name="brand_logo" id="brand_logo" accept="image/*" class="hidden dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500" @change="logoPreview = URL.createObjectURL($event.target.files[0])">
                                                    <label for="brand_logo" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-2xl bg-white dark:bg-slate-800 border-2 border-slate-100 dark:border-slate-700 text-xs font-black text-slate-600 dark:text-slate-300 hover:border-indigo-600 dark:hover:border-indigo-500 hover:text-indigo-600 dark:hover:text-indigo-400 cursor-pointer transition-all shadow-sm">
                                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" /></svg>
                                                        Upload Emblem
                                                    </label>
                                                    <p class="text-[9px] font-bold text-slate-400 mt-2 uppercase tracking-widest">Recommended: Square PNG/JPG (Max 2MB)</p>
                                                    @error('brand_logo')
                                                        <p class="text-[10px] font-bold text-rose-500 mt-2 uppercase tracking-widest">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="space-y-4">
                                        <div>
                                             <label class="text-[11px] font-black text-slate-900 dark:text-white uppercase tracking-[0.2em] ml-1 mb-2 block">Global Workspace ID</label>
                                            <div class="w-full px-6 py-4 bg-slate-50/50 dark:bg-[#0f172a] rounded-[1.5rem] border border-slate-100 dark:border-slate-700 font-mono text-slate-400 dark:text-slate-500 font-black text-lg uppercase tracking-widest cursor-not-allowed select-all flex items-center justify-between">
                                                {{ $context->unique_id ?? 'SIC-2024-001' }}
                                                <svg class="h-5 w-5 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                                            </div>
                                            <p class="text-[9px] text-slate-400 dark:text-slate-600 mt-2 font-bold ml-1 flex items-center gap-1">
                                                Workspace ID is locked for security. Contact support to change.
                                            </p>
                                        </div>
                                        <div class="pt-4 flex justify-end">
                                            <button type="submit" class="inline-flex items-center gap-2 px-8 py-4 rounded-2xl bg-indigo-600 text-xs font-black text-white hover:bg-indigo-700 hover:shadow-lg hover: transition-all uppercase tracking-widest w-full justify-center md:w-auto">
                                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                                Save Branding Identity
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <div class="mt-12 pt-12 border-t border-slate-100 dark:border-slate-800 grid grid-cols-1 sm:grid-cols-3 gap-6">
                                <div class="p-6 rounded-3xl bg-indigo-50/30 dark:bg-indigo-500/10 border border-indigo-100/50 dark:border-indigo-500/20 hover:shadow-lg transition-all duration-300">
                                    <div class="text-[9px] font-black text-indigo-400 uppercase tracking-[0.2em] mb-2">Workspace status</div>
                                    <div class="flex items-center gap-2">
                                        <div class="h-2 w-2 rounded-full bg-indigo-600 dark:bg-indigo-400 animate-pulse"></div>
                                        <div class="text-[11px] font-black text-slate-700 dark:text-slate-300 uppercase tracking-widest">{{ $context->subscription_status ?? 'Active' }}</div>
                                    </div>
                                </div>
                                <div class="p-6 rounded-3xl bg-emerald-50/30 dark:bg-emerald-500/10 border border-emerald-100/50 dark:border-emerald-500/20 hover:shadow-lg transition-all duration-300">
                                    <div class="text-[9px] font-black text-emerald-400 uppercase tracking-[0.2em] mb-2">Authority Level</div>
                                    <div class="text-[11px] font-black text-slate-700 dark:text-slate-300 uppercase tracking-widest">{{ $context->subscription_plan ?? 'Elite Pro' }}</div>
                                </div>
                                <div class="p-6 rounded-3xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-700/50 hover:shadow-lg transition-all duration-300">
                                    <div class="text-[9px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-2">Next Audit Cycle</div>
                                    <div class="text-[11px] font-black text-slate-700 dark:text-slate-300 uppercase tracking-widest">{{ $context->subscription_ends_at ? $context->subscription_ends_at->format('M d, Y') : 'Lifetime' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Intelligence Portal Snapshots -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                         <div class="premium-card bg-slate-900 border-none shadow-2xl p-10 text-white relative overflow-hidden group">
                            <div class="absolute top-0 right-0 w-48 h-48 bg-indigo-500/20 rounded-full blur-3xl -mr-24 -mt-24 group-hover:scale-150 transition-transform duration-1000"></div>
                            <div class="relative">
                                <h4 class="text-[10px] font-black text-indigo-300 uppercase tracking-[0.25em] mb-8">Staff Performance Log</h4>
                                <div class="flex items-end gap-3 mb-2">
                                    <div class="text-6xl font-black tracking-tight leading-none">{{ \App\Models\ActivityLog::forTenant($context->id)->staffLogs()->count() }}</div>
                                    <div class="text-indigo-400 font-bold text-xs mb-1 uppercase tracking-widest">Pulses</div>
                                </div>
                                <p class="text-xs font-bold text-slate-500 uppercase tracking-widest dark:text-slate-400">Total Staff Operations Tracked</p>
                                <a href="{{ route('settings.logs', ['type' => 'staff']) }}" class="mt-10 inline-flex items-center gap-3 px-6 py-3 rounded-2xl bg-indigo-600 text-[10px] font-black text-white hover:bg-white hover:text-slate-900 transition-all uppercase tracking-widest shadow-xl">
                                    Open Intelligence Portal
                                    <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                                </a>
                            </div>
                         </div>
                         <div class="premium-card bg-white dark:bg-[#1e293b] border-none shadow-2xl p-10 relative overflow-hidden group">
                            <div class="absolute top-0 right-0 w-48 h-48 bg-amber-500/10 rounded-full blur-3xl -mr-24 -mt-24 group-hover:scale-150 transition-transform duration-1000"></div>
                            <div class="relative">
                                <h4 class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.25em] mb-8">Admin Sovereignty Log</h4>
                                <div class="flex items-end gap-3 mb-2">
                                    <div class="text-6xl font-black text-slate-900 dark:text-white tracking-tight leading-none">{{ \App\Models\ActivityLog::forTenant($context->id)->adminLogs()->count() }}</div>
                                    <div class="text-slate-400 dark:text-slate-500 font-bold text-xs mb-1 uppercase tracking-widest">Audits</div>
                                </div>
                                <p class="text-xs font-bold text-slate-400 dark:text-slate-600 uppercase tracking-widest">Sensitive Authority Actions</p>
                                <a href="{{ route('settings.logs', ['type' => 'admin']) }}" class="mt-10 inline-flex items-center gap-3 px-6 py-3 rounded-2xl bg-amber-500 text-[10px] font-black text-white hover:bg-slate-900 transition-all uppercase tracking-widest shadow-xl">
                                    Audit Secure Feeds
                                    <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                                </a>
                            </div>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Layout Helper Components -->
    @once
    @php
    if (!function_exists('renderSettingsNavLink')) {
        function renderSettingsNavLink($href, $active, $slot) {
            $classes = $active 
                ? 'flex items-center gap-4 px-6 py-4 rounded-[1.5rem] bg-white dark:bg-slate-700/50 shadow-xl dark:shadow-none text-indigo-600 dark:text-indigo-400 font-black border border-indigo-50 dark:border-indigo-500/20 transition-all duration-300 group'
                : 'flex items-center gap-4 px-6 py-4 rounded-[1.5rem] text-slate-500 dark:text-slate-400 font-bold hover:bg-white dark:hover:bg-slate-700/50 hover:text-slate-900 dark:hover:text-white hover:shadow-lg dark:hover:shadow-none transition-all duration-300 group';
            
            return "<a href=\"{$href}\" class=\"{$classes}\">{$slot}</a>";
        }
    }
    @endphp
    @endonce
</x-app-layout>

