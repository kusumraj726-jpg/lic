<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Staff Member') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-4 mb-8">
                <a href="{{ route('staff.index') }}" class="p-2 hover:bg-white rounded-full transition-colors text-slate-400 hover:text-indigo-600">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                </a>
                <div>
                    <h2 class="text-3xl font-extrabold text-gray-900">New Staff Member</h2>
                    <p class="text-gray-500">Onboard a new member to your agency team.</p>
                </div>
            </div>

            <div class="premium-card border-none shadow-2xl overflow-hidden">
                <form action="{{ route('staff.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    
                    <div class="p-8 space-y-10">
                        <!-- 1. Profile Photo Section -->
                        <div class="flex flex-col md:flex-row items-center gap-8 bg-slate-50/50 p-6 rounded-[2rem] border border-slate-100">
                            <div class="relative group">
                                <div class="h-32 w-32 rounded-[2rem] bg-gradient-to-br from-indigo-500 to-purple-600 p-1 shadow-xl shadow-indigo-100 transition-transform group-hover:scale-105">
                                    <div class="h-full w-full rounded-[1.75rem] bg-white flex items-center justify-center overflow-hidden border-4 border-white">
                                        <div id="avatar-preview" class="h-full w-full flex items-center justify-center bg-slate-50 text-slate-300">
                                            <svg class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                        </div>
                                    </div>
                                </div>
                                <label for="avatar" class="absolute -bottom-2 -right-2 h-10 w-10 bg-white shadow-lg rounded-xl flex items-center justify-center text-slate-600 hover:text-indigo-600 cursor-pointer transition-all hover:scale-110 border border-slate-100">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                </label>
                                <input type="file" id="avatar" name="avatar" class="hidden" accept="image/*" onchange="previewImage(this)">
                            </div>
                            <div class="flex-1 text-center md:text-left">
                                <h3 class="text-lg font-black text-slate-900 uppercase tracking-tight">Staff Member Photo</h3>
                                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mt-1 mb-4">Upload a professional headshot (JPG, PNG - Max 2MB)</p>
                                @error('avatar') <p class="text-xs text-rose-500 font-bold uppercase tracking-tighter">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <!-- 2. Personal Information -->
                        <div>
                            <div class="flex items-center gap-3 mb-6">
                                <div class="h-1.5 w-1.5 rounded-full bg-indigo-600"></div>
                                <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em]">Contact Details</h3>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <x-form-input label="Full Name" name="staff_member_name_sec" placeholder="Enter Full Name" autocomplete="off" required />
                                <x-form-input label="Email Address" name="staff_member_email_sec" type="email" placeholder="official@agency.com" autocomplete="off" required />
                                <x-form-input label="Phone Number" name="staff_member_phone_sec" placeholder="9876543210" minlength="10" maxlength="10" pattern="[0-9]{10}" title="10-digit Phone Number" autocomplete="off" />
                                <x-form-input label="Designation" name="staff_member_designation_sec" placeholder="e.g. Senior Advisor" autocomplete="off" />
                            </div>
                        </div>

                        <!-- 3. Security & Account -->
                        <div class="pt-8 border-t border-slate-100">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="h-1.5 w-1.5 rounded-full bg-rose-600"></div>
                                <h3 class="text-xs font-black text-rose-400 uppercase tracking-[0.2em]">Security Details</h3>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <x-form-input label="Create Password" name="password" type="password" placeholder="••••••••" minlength="8" autocomplete="new-password" readonly onfocus="this.removeAttribute('readonly');" required />
                                <x-form-input label="Confirm Password" name="password_confirmation" type="password" placeholder="••••••••" minlength="8" autocomplete="new-password" readonly onfocus="this.removeAttribute('readonly');" required />
                            </div>

                        <!-- 4. Module Access Control -->
                        <div class="pt-8 border-t border-slate-100">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="h-1.5 w-1.5 rounded-full bg-emerald-600"></div>
                                <h3 class="text-xs font-black text-emerald-600 uppercase tracking-[0.2em]">Module Access Control</h3>
                            </div>
                            
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-6 ml-1">Select the modules this staff member can access:</p>

                            <div class="gap-4 grid grid-cols-1 md:grid-cols-2 mb-8">
                                <!-- Clients Module -->
                                <label class="flex items-center justify-between p-4 bg-white border border-slate-200 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors shadow-sm">
                                    <div class="flex items-center gap-4">
                                        <div class="h-10 w-10 rounded-lg bg-slate-100 flex items-center justify-center text-slate-500">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                                        </div>
                                        <div>
                                            <span class="block text-xs font-black text-slate-700 uppercase tracking-widest">Clients Manage</span>
                                        </div>
                                    </div>
                                    <div class="relative flex items-center">
                                        <input type="checkbox" name="access_clients" value="1" class="peer sr-only" checked>
                                        <div class="w-14 h-7 bg-red-500 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-blue-600 shadow-inner"></div>
                                    </div>
                                </label>

                                <!-- Queries Module -->
                                <label class="flex items-center justify-between p-4 bg-white border border-slate-200 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors shadow-sm">
                                    <div class="flex items-center gap-4">
                                        <div class="h-10 w-10 rounded-lg bg-slate-100 flex items-center justify-center text-slate-500">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" /></svg>
                                        </div>
                                        <div>
                                            <span class="block text-xs font-black text-slate-700 uppercase tracking-widest">Queries Access</span>
                                        </div>
                                    </div>
                                    <div class="relative flex items-center">
                                        <input type="checkbox" name="access_queries" value="1" class="peer sr-only" checked>
                                        <div class="w-14 h-7 bg-red-500 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-blue-600 shadow-inner"></div>
                                    </div>
                                </label>

                                <!-- Claims Module -->
                                <label class="flex items-center justify-between p-4 bg-white border border-slate-200 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors shadow-sm">
                                    <div class="flex items-center gap-4">
                                        <div class="h-10 w-10 rounded-lg bg-slate-100 flex items-center justify-center text-slate-500">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                                        </div>
                                        <div>
                                            <span class="block text-xs font-black text-slate-700 uppercase tracking-widest">Claims Handling</span>
                                        </div>
                                    </div>
                                    <div class="relative flex items-center">
                                        <input type="checkbox" name="access_claims" value="1" class="peer sr-only" checked>
                                        <div class="w-14 h-7 bg-red-500 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-blue-600 shadow-inner"></div>
                                    </div>
                                </label>

                                <!-- Renewals Module -->
                                <label class="flex items-center justify-between p-4 bg-white border border-slate-200 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors shadow-sm">
                                    <div class="flex items-center gap-4">
                                        <div class="h-10 w-10 rounded-lg bg-slate-100 flex items-center justify-center text-slate-500">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                        </div>
                                        <div>
                                            <span class="block text-xs font-black text-slate-700 uppercase tracking-widest">Renewals Control</span>
                                        </div>
                                    </div>
                                    <div class="relative flex items-center">
                                        <input type="checkbox" name="access_renewals" value="1" class="peer sr-only" checked>
                                        <div class="w-14 h-7 bg-red-500 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-blue-600 shadow-inner"></div>
                                    </div>
                                </label>
                            </div>

                            <div>
                                <label class="block text-[11px] font-black text-slate-500 uppercase tracking-[0.2em] mb-3 ml-1">Account Status</label>
                                <div class="flex gap-4">
                                    <label class="flex-1 cursor-pointer group">
                                        <input type="radio" name="status" value="active" class="peer hidden" checked>
                                        <div class="py-4 px-6 rounded-2xl border-2 border-slate-100 bg-slate-50 text-center font-black text-xs uppercase tracking-widest text-slate-400 transition-all peer-checked:border-indigo-600 peer-checked:bg-indigo-600 peer-checked:text-white peer-checked:shadow-lg peer-checked:shadow-indigo-100">
                                            ACTIVE
                                        </div>
                                    </label>
                                    <label class="flex-1 cursor-pointer group">
                                        <input type="radio" name="status" value="inactive" class="peer hidden">
                                        <div class="py-4 px-6 rounded-2xl border-2 border-slate-100 bg-slate-50 text-center font-black text-xs uppercase tracking-widest text-slate-400 transition-all peer-checked:border-slate-800 peer-checked:bg-slate-800 peer-checked:text-white peer-checked:shadow-lg">
                                            LOCKED
                                        </div>
                                    </label>
                                </div>
                                @error('status') <p class="mt-1 text-sm text-rose-500 font-bold">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="p-8 bg-slate-50 border-t border-slate-100 flex justify-end gap-4">
                        <a href="{{ route('staff.index') }}" class="px-8 py-4 text-sm font-black text-slate-500 uppercase tracking-widest hover:text-slate-900 transition-colors">Cancel</a>
                        <button type="submit" class="premium-btn premium-btn-primary px-12 py-4 text-sm shadow-xl shadow-indigo-200">
                            Complete Onboarding
                        </button>
                    </div>
                </form>
            </div>

            <script>
                function previewImage(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            document.getElementById('avatar-preview').innerHTML = '<img src="' + e.target.result + '" class="h-full w-full object-cover">';
                        }
                        reader.readAsDataURL(input.files[0]);
                    }
                }
            </script>
        </div>
    </div>
</x-app-layout>
