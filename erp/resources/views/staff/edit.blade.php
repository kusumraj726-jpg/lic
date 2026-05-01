<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-6">
            <a href="{{ route('staff.index') }}"
                class="text-slate-400 hover:text-indigo-600 dark:hover:text-white transition-colors">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <div>
                <h2 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">New Staff Member</h2>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">Onboard a new member to your
                    agency team.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto px-4">
            <div
                class="bg-white dark:bg-slate-900/50 border border-slate-100 dark:border-slate-800 rounded-[2.5rem] shadow-xl dark:shadow-2xl overflow-hidden p-10 transition-colors duration-300">
                <form action="{{ route('staff.update', $staff) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')

                    <div class="space-y-12">
                        <!-- 1. Photo Section -->
                        <div
                            class="p-8 rounded-[2rem] border border-slate-100 dark:border-slate-800 bg-slate-50 dark:bg-slate-800/20 flex flex-col md:flex-row items-center gap-10">
                            <div class="relative group">
                                <div
                                    class="h-32 w-32 rounded-[2rem] bg-gradient-to-tr from-indigo-500 via-purple-500 to-pink-500 p-1 shadow-2xl overflow-hidden">
                                    <div
                                        class="h-full w-full rounded-[1.85rem] bg-white dark:bg-slate-900 flex items-center justify-center overflow-hidden border-4 border-white dark:border-slate-900">
                                        <div id="avatar-preview" class="h-full w-full">
                                            @if($staff->staffUser && $staff->staffUser->avatar)
                                                <img src="{{ $staff->staffUser->avatar_url }}"
                                                    class="h-full w-full object-cover">
                                            @else
                                                <div
                                                    class="h-full w-full flex items-center justify-center bg-slate-50 dark:bg-slate-800 text-slate-400 dark:text-slate-500">
                                                    <svg class="h-10 w-10" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <label for="avatar"
                                    class="absolute -bottom-2 -right-2 h-10 w-10 bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 shadow-xl rounded-xl flex items-center justify-center text-slate-400 hover:text-indigo-600 dark:hover:text-white cursor-pointer transition-all">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </label>
                                <input type="file" id="avatar" name="avatar" class="hidden" accept="image/*"
                                    onchange="previewImage(this)">
                            </div>
                            <div class="text-center md:text-left">
                                <h3 class="text-lg font-black text-slate-900 dark:text-white uppercase tracking-tight">
                                    Staff Member Photo</h3>
                                <p
                                    class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest mt-1 leading-relaxed">
                                    Upload a professional headshot (JPG, PNG - Max 2MB)</p>
                            </div>
                        </div>

                        <!-- 2. Contact Details -->
                        <div class="space-y-8">
                            <div class="flex items-center gap-3">
                                <div class="h-1.5 w-1.5 rounded-full bg-indigo-500"></div>
                                <h4
                                    class="text-[10px] font-black text-indigo-500 dark:text-indigo-400 uppercase tracking-[0.2em]">
                                    Contact Details</h4>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="space-y-2.5">
                                    <label
                                        class="text-[11px] font-black text-slate-900 dark:text-white uppercase tracking-widest ml-1">Full
                                        Name <span class="text-rose-500">*</span></label>
                                    <input type="text" name="staff_member_name_sec"
                                        value="{{ old('staff_member_name_sec', $staff->name) }}"
                                        placeholder="Enter Full Name"
                                        class="w-full bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-800 rounded-2xl px-6 py-4 text-sm text-slate-600 dark:text-slate-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all outline-none">
                                    @error('staff_member_name_sec') <p
                                        class="text-[10px] text-rose-500 font-bold mt-1 px-1 uppercase tracking-widest">
                                    {{ $message }}</p> @enderror
                                </div>
                                <div class="space-y-2.5">
                                    <label
                                        class="text-[11px] font-black text-slate-900 dark:text-white uppercase tracking-widest ml-1">Email
                                        Address <span class="text-rose-500">*</span></label>
                                    <input type="email" name="staff_member_email_sec"
                                        value="{{ old('staff_member_email_sec', $staff->email) }}"
                                        placeholder="official@agency.com"
                                        class="w-full bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-800 rounded-2xl px-6 py-4 text-sm text-slate-600 dark:text-slate-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all outline-none">
                                    @error('staff_member_email_sec') <p
                                        class="text-[10px] text-rose-500 font-bold mt-1 px-1 uppercase tracking-widest">
                                    {{ $message }}</p> @enderror
                                </div>
                                <div class="space-y-2.5">
                                    <label
                                        class="text-[11px] font-black text-slate-900 dark:text-white uppercase tracking-widest ml-1">Phone
                                        Number</label>
                                    <input type="text" name="staff_member_phone_sec"
                                        value="{{ old('staff_member_phone_sec', $staff->phone) }}"
                                        placeholder="9876543210"
                                        class="w-full bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-800 rounded-2xl px-6 py-4 text-sm text-slate-600 dark:text-slate-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all outline-none">
                                    @error('staff_member_phone_sec') <p
                                        class="text-[10px] text-rose-500 font-bold mt-1 px-1 uppercase tracking-widest">
                                    {{ $message }}</p> @enderror
                                </div>
                                <div class="space-y-2.5">
                                    <label
                                        class="text-[11px] font-black text-slate-900 dark:text-white uppercase tracking-widest ml-1">Designation</label>
                                    <input type="text" name="staff_member_designation_sec"
                                        value="{{ old('staff_member_designation_sec', $staff->designation) }}"
                                        placeholder="e.g. Senior Advisor"
                                        class="w-full bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-800 rounded-2xl px-6 py-4 text-sm text-slate-600 dark:text-slate-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all outline-none">
                                    @error('staff_member_designation_sec') <p
                                        class="text-[10px] text-rose-500 font-bold mt-1 px-1 uppercase tracking-widest">
                                    {{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Divider -->
                        <div class="h-px bg-slate-100 dark:bg-slate-800 w-full"></div>

                        <!-- 3. Security Details -->
                        <div class="space-y-8">
                            <div class="flex items-center gap-3">
                                <div class="h-1.5 w-1.5 rounded-full bg-rose-500"></div>
                                <h4
                                    class="text-[10px] font-black text-rose-500 dark:text-rose-400 uppercase tracking-[0.2em]">
                                    Security Details</h4>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="space-y-2.5">
                                    <label
                                        class="text-[11px] font-black text-slate-900 dark:text-white uppercase tracking-widest ml-1">Create
                                        Password <span class="text-rose-500">*</span></label>
                                    <input type="password" name="password" placeholder="••••••••"
                                        class="w-full bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-800 rounded-2xl px-6 py-4 text-sm text-slate-600 dark:text-slate-300 focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition-all outline-none">
                                    @error('password') <p
                                        class="text-[10px] text-rose-500 font-bold mt-1 px-1 uppercase tracking-widest">
                                    {{ $message }}</p> @enderror
                                </div>
                                <div class="space-y-2.5">
                                    <label
                                        class="text-[11px] font-black text-slate-900 dark:text-white uppercase tracking-widest ml-1">Confirm
                                        Password <span class="text-rose-500">*</span></label>
                                    <input type="password" name="password_confirmation" placeholder="••••••••"
                                        class="w-full bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-800 rounded-2xl px-6 py-4 text-sm text-slate-600 dark:text-slate-300 focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition-all outline-none">
                                </div>
                            </div>
                        </div>

                        <!-- Divider -->
                        <div class="h-px bg-slate-100 dark:bg-slate-800 w-full"></div>

                        <!-- 4. Module Access -->
                        <div class="space-y-8">
                            <div class="flex items-center gap-3">
                                <div class="h-1.5 w-1.5 rounded-full bg-emerald-500"></div>
                                <h4
                                    class="text-[10px] font-black text-emerald-600 dark:text-emerald-500 uppercase tracking-[0.2em]">
                                    Module Access Control</h4>
                            </div>
                            <p
                                class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest -mt-4 ml-4">
                                SELECT THE MODULES THIS STAFF MEMBER CAN ACCESS:</p>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                @php
                                    $perms = [
                                        ['key' => 'access_clients', 'label' => 'CLIENTS MANAGE', 'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z'],
                                        ['key' => 'access_queries', 'label' => 'QUERIES ACCESS', 'icon' => 'M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z'],
                                        ['key' => 'access_claims', 'label' => 'CLAIMS HANDLING', 'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'],
                                        ['key' => 'access_renewals', 'label' => 'RENEWALS CONTROL', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                                        ['key' => 'access_commissions', 'label' => 'COMMISSIONS ACCESS', 'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                                        ['key' => 'access_trash', 'label' => 'TRASH BIN ACCESS', 'icon' => 'M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16'],
                                        ['key' => 'access_dashboard', 'label' => 'DASHBOARD INTEL', 'icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z'],
                                    ];
                                @endphp

                                @foreach($perms as $p)
                                    <label
                                        class="flex items-center justify-between p-6 bg-white dark:bg-slate-800/30 border border-slate-100 dark:border-slate-800 rounded-2xl cursor-pointer hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-all group shadow-sm dark:shadow-none">
                                        <div class="flex items-center gap-5">
                                            <div
                                                class="h-12 w-12 rounded-xl bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-slate-700 flex items-center justify-center text-slate-400 group-hover:text-emerald-500 group-hover:bg-emerald-500/10 transition-all uppercase">
                                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="{{ $p['icon'] }}" />
                                                </svg>
                                            </div>
                                            <span
                                                class="text-[10px] font-black text-slate-700 dark:text-white uppercase tracking-widest">{{ $p['label'] }}</span>
                                        </div>
                                        <div class="relative inline-flex items-center cursor-pointer">
                                            <input type="checkbox" name="{{ $p['key'] }}" value="1" class="sr-only peer" {{ $staff->{$p['key']} ? 'checked' : '' }}>
                                            <div
                                                class="w-11 h-6 bg-rose-500 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-200 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600 shadow-inner">
                                            </div>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- 5. Account Status -->
                        <div class="space-y-6 pt-4">
                            <label
                                class="text-[11px] font-black text-slate-900 dark:text-white uppercase tracking-[0.2em] ml-1">Account
                                Status</label>
                            <div
                                class="flex bg-slate-50 dark:bg-slate-800/50 p-1.5 rounded-2xl border border-slate-100 dark:border-slate-800 max-w-2xl shadow-inner dark:shadow-none">
                                <label class="flex-1 cursor-pointer">
                                    <input type="radio" name="status" value="active" class="hidden peer" {{ $staff->status == 'active' ? 'checked' : '' }}>
                                    <div
                                        class="py-4 text-center text-xs font-black uppercase tracking-widest text-slate-400 dark:text-slate-500 rounded-xl transition-all peer-checked:bg-indigo-600 peer-checked:text-white peer-checked:shadow-xl">
                                        Active</div>
                                </label>
                                <label class="flex-1 cursor-pointer">
                                    <input type="radio" name="status" value="inactive" class="hidden peer" {{ $staff->status == 'inactive' ? 'checked' : '' }}>
                                    <div
                                        class="py-4 text-center text-xs font-black uppercase tracking-widest text-slate-400 dark:text-slate-500 rounded-xl transition-all peer-checked:bg-white dark:peer-checked:bg-slate-700 peer-checked:text-slate-900 dark:peer-checked:text-white peer-checked:shadow-md">
                                        Locked</div>
                                </label>
                            </div>
                        </div>

                        <!-- Footer -->
                        <div
                            class="pt-12 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between">
                            <a href="{{ route('staff.index') }}"
                                class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] hover:text-indigo-600 dark:hover:text-white transition-colors">Cancel</a>
                            <button type="submit"
                                class="bg-indigo-600 hover:bg-indigo-700 px-10 py-5 rounded-2xl text-[10px] font-black text-white uppercase tracking-widest shadow-xl shadow-indigo-600/20 transition-all active:scale-95">Complete
                                Onboarding</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('avatar-preview').innerHTML = '<img src="' + e.target.result + '" class="h-full w-full object-cover">';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</x-app-layout>