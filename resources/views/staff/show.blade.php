<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-6">
            <a href="{{ route('staff.index') }}" class="text-slate-400 hover:text-indigo-600 dark:hover:text-white transition-colors">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <div>
                <h2 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">Staff Member Profile</h2>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">Diagnostic view of personnel configuration.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto px-4">
            <div class="bg-white dark:bg-slate-900/50 border border-slate-100 dark:border-slate-800 rounded-[2.5rem] shadow-xl dark:shadow-2xl overflow-hidden p-10 transition-colors duration-300">
                
                <div class="space-y-12">
                    <!-- 1. Photo Section -->
                    <div class="p-8 rounded-[2rem] border border-slate-100 dark:border-slate-800 bg-slate-50 dark:bg-slate-800/20 flex flex-col md:flex-row items-center gap-10">
                        <div class="relative group">
                            <div class="h-32 w-32 rounded-[2rem] bg-gradient-to-tr from-indigo-500 via-purple-500 to-pink-500 p-1 shadow-2xl overflow-hidden">
                                <div class="h-full w-full rounded-[1.85rem] bg-white dark:bg-slate-900 flex items-center justify-center overflow-hidden border-4 border-white dark:border-slate-900">
                                    <div class="h-full w-full">
                                        @if($staff->staffUser && $staff->staffUser->avatar)
                                            <img src="{{ asset('storage/' . $staff->staffUser->avatar) }}" class="h-full w-full object-cover">
                                        @else
                                            <div class="h-full w-full flex items-center justify-center bg-slate-50 dark:bg-slate-800 text-slate-400 dark:text-slate-500">
                                                <svg class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center md:text-left">
                            <h3 class="text-lg font-black text-slate-900 dark:text-white uppercase tracking-tight">Staff Member Photo</h3>
                            <p class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest mt-1 leading-relaxed">Official identification photography</p>
                        </div>
                    </div>

                    <!-- 2. Contact Details -->
                    <div class="space-y-8">
                        <div class="flex items-center gap-3">
                            <div class="h-1.5 w-1.5 rounded-full bg-indigo-500"></div>
                            <h4 class="text-[10px] font-black text-indigo-500 dark:text-indigo-400 uppercase tracking-[0.2em]">Contact Details</h4>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-2.5">
                                <label class="text-[10px] font-black text-slate-900 dark:text-white uppercase tracking-widest ml-1">Full Name</label>
                                <div class="w-full bg-slate-50 dark:bg-slate-800/30 border border-slate-100 dark:border-slate-800/50 rounded-2xl px-6 py-4 text-sm font-bold text-slate-600 dark:text-slate-300">
                                    {{ $staff->name }}
                                </div>
                            </div>
                            <div class="space-y-2.5">
                                <label class="text-[10px] font-black text-slate-900 dark:text-white uppercase tracking-widest ml-1">Email Address</label>
                                <div class="w-full bg-slate-50 dark:bg-slate-800/30 border border-slate-100 dark:border-slate-800/50 rounded-2xl px-6 py-4 text-sm font-bold text-slate-600 dark:text-slate-300">
                                    {{ $staff->email }}
                                </div>
                            </div>
                            <div class="space-y-2.5">
                                <label class="text-[10px] font-black text-slate-900 dark:text-white uppercase tracking-widest ml-1">Phone Number</label>
                                <div class="w-full bg-slate-50 dark:bg-slate-800/30 border border-slate-100 dark:border-slate-800/50 rounded-2xl px-6 py-4 text-sm font-bold text-slate-600 dark:text-slate-300">
                                    {{ $staff->phone ?? 'Not Listed' }}
                                </div>
                            </div>
                            <div class="space-y-2.5">
                                <label class="text-[10px] font-black text-slate-900 dark:text-white uppercase tracking-widest ml-1">Designation</label>
                                <div class="w-full bg-slate-50 dark:bg-slate-800/30 border border-slate-100 dark:border-slate-800/50 rounded-2xl px-6 py-4 text-sm font-bold text-slate-600 dark:text-slate-300">
                                    {{ $staff->designation ?? 'Senior Advisor' }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Divider -->
                    <div class="h-px bg-slate-100 dark:bg-slate-800 w-full"></div>

                    <!-- 3. Security Credentials (Diagnostic) -->
                    <div class="space-y-8">
                        <div class="flex items-center gap-3">
                            <div class="h-1.5 w-1.5 rounded-full bg-rose-500"></div>
                            <h4 class="text-[10px] font-black text-rose-500 dark:text-rose-400 uppercase tracking-[0.2em]">Diagnostic Protocols</h4>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-2.5">
                                <label class="text-[10px] font-black text-slate-900 dark:text-white uppercase tracking-widest ml-1">Agency Advisor ID</label>
                                <div class="w-full bg-slate-50 dark:bg-slate-800/30 border border-slate-100 dark:border-slate-800/50 rounded-2xl px-6 py-4 text-sm font-bold text-slate-600 dark:text-slate-300">
                                    #{{ $staff->advisor_id }}
                                </div>
                            </div>
                            <div class="space-y-2.5">
                                <label class="text-[10px] font-black text-slate-900 dark:text-white uppercase tracking-widest ml-1">Onboarding Timestamp</label>
                                <div class="w-full bg-slate-50 dark:bg-slate-800/30 border border-slate-100 dark:border-slate-800/50 rounded-2xl px-6 py-4 text-sm font-bold text-slate-600 dark:text-slate-300 flex items-center justify-between">
                                    {{ $staff->created_at->format('d F, Y - H:i') }}
                                    <span class="text-[9px] font-black text-emerald-500 uppercase tracking-widest px-2 py-0.5 rounded bg-emerald-500/10 border border-emerald-500/20">Verified Access</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Divider -->
                    <div class="h-px bg-slate-100 dark:bg-slate-800 w-full"></div>

                    <!-- 4. Module Access -->
                    <div class="space-y-8">
                        <div class="flex items-center gap-3">
                            <div class="h-1.5 w-1.5 rounded-full bg-emerald-500"></div>
                            <h4 class="text-[10px] font-black text-emerald-600 dark:text-emerald-400 uppercase tracking-[0.2em]">Module Access Control</h4>
                        </div>
                        <p class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest -mt-4 ml-4">CURRENT AUTHORIZED ACCESS STATES:</p>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @php
                                $perms = [
                                    ['key' => 'access_clients', 'label' => 'CLIENTS MANAGE', 'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z'],
                                    ['key' => 'access_queries', 'label' => 'QUERIES ACCESS', 'icon' => 'M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z'],
                                    ['key' => 'access_claims', 'label' => 'CLAIMS HANDLING', 'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'],
                                    ['key' => 'access_renewals', 'label' => 'RENEWALS CONTROL', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                                ];
                            @endphp

                            @foreach($perms as $p)
                            <div class="flex items-center justify-between p-6 bg-white dark:bg-slate-800/30 border border-slate-100 dark:border-slate-800 rounded-2xl transition-all shadow-sm dark:shadow-none">
                                <div class="flex items-center gap-5">
                                    <div class="h-12 w-12 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-slate-700 flex items-center justify-center text-slate-400">
                                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $p['icon'] }}" /></svg>
                                    </div>
                                    <span class="text-[10px] font-black text-slate-900 dark:text-white uppercase tracking-widest">{{ $p['label'] }}</span>
                                </div>
                                <div class="relative inline-flex items-center opacity-70">
                                    <div class="w-11 h-6 rounded-full transition-all {{ $staff->{$p['key']} ? 'bg-indigo-600' : 'bg-rose-500' }}">
                                        <div class="absolute top-[2px] left-[2px] bg-white border border-gray-200 dark:border-gray-300 rounded-full h-5 w-5 transition-all {{ $staff->{$p['key']} ? 'translate-x-full' : '' }}"></div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- 5. Account Status -->
                    <div class="space-y-6 pt-4">
                        <label class="text-[10px] font-black text-slate-900 dark:text-white uppercase tracking-[0.2em] ml-1">Account Status</label>
                        <div class="flex gap-4 max-w-2xl">
                            <div class="flex-1 py-4 text-center text-xs font-black uppercase tracking-widest border border-slate-100 dark:border-slate-800 rounded-xl transition-all {{ $staff->status == 'active' ? 'bg-indigo-600 text-white shadow-xl' : 'text-slate-400 dark:text-slate-500 bg-slate-50 dark:bg-slate-900/50' }}">Active</div>
                            <div class="flex-1 py-4 text-center text-xs font-black uppercase tracking-widest border border-slate-100 dark:border-slate-800 rounded-xl transition-all {{ $staff->status == 'inactive' ? 'bg-white dark:bg-rose-500 text-slate-900 dark:text-white shadow-md' : 'text-slate-400 dark:text-slate-500 bg-slate-50 dark:bg-slate-900/50' }}">Locked</div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="pt-12 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between">
                        <form action="{{ route('staff.destroy', $staff) }}" method="POST" onsubmit="return confirm('Terminate this personnel record?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-[10px] font-black text-rose-500 uppercase tracking-[0.2em] hover:text-rose-600 transition-colors">Archive Record</button>
                        </form>
                        <a href="{{ route('staff.edit', $staff) }}" class="bg-indigo-600 hover:bg-indigo-700 px-10 py-5 rounded-2xl text-[10px] font-black text-white uppercase tracking-widest shadow-xl shadow-indigo-600/20 transition-all active:scale-95">Modify Information</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>