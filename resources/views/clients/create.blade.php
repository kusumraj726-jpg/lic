<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-slate-900 uppercase tracking-tight dark:text-slate-100">
            {{ __('Add New Client') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="premium-card">
                <div class="border-b border-gray-100 pb-6 mb-8">
                    <h3 class="text-2xl font-extrabold text-gray-900 dark:text-gray-100">Client Information</h3>
                    <p class="text-gray-500 mt-1 dark:text-slate-400">Register a new client in the ERP system.</p>
                </div>

                <form action="{{ route('clients.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8" 
                    x-data="{ 
                        policies: [{ number: '', type: 'Life Insurance', premium: '', expiry: '', custom_type: '' }],
                        addPolicy() {
                            this.policies.push({ number: '', type: 'Life Insurance', premium: '', expiry: '', custom_type: '' });
                        },
                        removePolicy(index) {
                            if (this.policies.length > 1) {
                                this.policies.splice(index, 1);
                            }
                        }
                    }">
                    @csrf
                    
                    <!-- Profile Photo Section -->
                    <div class="flex flex-col md:flex-row items-center gap-8 bg-slate-50/50 dark:bg-slate-800/50 p-6 rounded-[2rem] border border-slate-100 dark:border-slate-700 mb-8">
                        <div class="relative group">
                            <div class="h-32 w-32 rounded-[2rem] bg-gradient-to-br from-indigo-500 to-purple-600 p-1 shadow-xl transition-transform group-hover:scale-105">
                                <div class="h-full w-full rounded-[1.75rem] bg-white dark:bg-slate-900 flex items-center justify-center overflow-hidden border-4 border-white dark:border-slate-800">
                                    <div id="photo-preview" class="h-full w-full flex items-center justify-center bg-slate-50 dark:bg-slate-800/50 text-slate-300 dark:text-slate-500">
                                        <svg class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                    </div>
                                </div>
                            </div>
                            <label for="photo" class="absolute -bottom-2 -right-2 h-10 w-10 bg-white dark:bg-slate-800 shadow-lg rounded-xl flex items-center justify-center text-slate-600 dark:text-slate-300 hover:text-indigo-600 dark:hover:text-indigo-400 cursor-pointer transition-all hover:scale-110 border border-slate-100 dark:border-slate-700">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                            </label>
                            <input type="file" id="photo" name="photo" class="hidden dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500" accept="image/*" onchange="previewImage(this)">
                        </div>
                        <div class="flex-1 text-center md:text-left">
                            <h3 class="text-lg font-black text-slate-900 uppercase tracking-tight dark:text-slate-100">Client Photo</h3>
                            <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mt-1 mb-2">Upload a profile picture (JPG, PNG - Max 2MB)</p>
                            @error('photo') <p class="text-xs text-rose-500 font-bold uppercase tracking-tighter">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <x-form-input label="Full Name" name="name" required autofocus />
                        <x-form-input label="Email Address" name="email" type="email" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <x-form-input label="Date of Birth" name="dob" type="date" />
                        <div class="form-group flex-1">
                            <label for="gender" class="block text-[11px] font-black text-slate-600 dark:text-slate-400 uppercase tracking-widest mb-2">Gender</label>
                            <select id="gender" name="gender" class="form-control mt-1 block w-full rounded-xl border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500">
                                <option value="">Select Gender</option>
                                <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('gender')" />
                        </div>
                        <x-form-input label="Phone Number" name="phone" placeholder="10-digit number" minlength="10" maxlength="10" pattern="[0-9]{10}" />
                    </div>

                    <div class="grid grid-cols-1 gap-8">
                        <div class="form-group flex-1">
                            <label for="address">Residential Address</label>
                            <textarea id="address" name="address" class="form-control dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500" rows="2">{{ old('address') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('address')" />
                        </div>
                    </div>

                    <!-- Policy Portfolio Section -->
                    <div class="space-y-6 pt-6 border-t border-slate-100 dark:border-slate-800">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-black text-slate-900 uppercase tracking-tight dark:text-slate-100">Insurance Portfolio</h3>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Register multiple policies for this client at once.</p>
                            </div>
                            <button type="button" @click="addPolicy()" class="flex items-center gap-2 px-4 py-2 bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-indigo-100 transition-colors">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                                Add Another Policy
                            </button>
                        </div>

                        <div class="space-y-4">
                            <template x-for="(policy, index) in policies" :key="index">
                                <div class="p-6 bg-slate-50 dark:bg-slate-800/50 rounded-[2rem] border border-slate-100 dark:border-slate-700 relative animate-fadeIn">
                                    <button type="button" @click="removePolicy(index)" x-show="policies.length > 1" class="absolute top-4 right-4 text-slate-300 hover:text-rose-500 transition-colors">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    </button>

                                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                                        <div class="form-group">
                                            <label class="text-[10px] font-black text-slate-400 uppercase mb-2 block">Policy Number</label>
                                            <input type="text" :name="`policies[${index}][policy_number]`" x-model="policy.number" class="form-control dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100" required placeholder="e.g. 123456789">
                                        </div>
                                        <div class="form-group">
                                            <label class="text-[10px] font-black text-slate-400 uppercase mb-2 block">Policy Type</label>
                                            <select :name="`policies[${index}][policy_type]`" x-model="policy.type" class="form-control dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100">
                                                <option value="Life Insurance">Life Insurance</option>
                                                <option value="Health Insurance">Health Insurance</option>
                                                <option value="Motor Insurance">Motor Insurance</option>
                                                <option value="General Insurance">General Insurance</option>
                                                <option value="Custom">Custom Policy</option>
                                            </select>
                                        </div>
                                        <div class="form-group" x-show="policy.type === 'Custom'">
                                            <label class="text-[10px] font-black text-slate-400 uppercase mb-2 block">Custom Name</label>
                                            <input type="text" :name="`policies[${index}][custom_type]`" x-model="policy.custom_type" class="form-control dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100" placeholder="e.g. Cyber Security">
                                        </div>
                                        <div class="form-group">
                                            <label class="text-[10px] font-black text-slate-400 uppercase mb-2 block">Premium (₹)</label>
                                            <input type="number" step="0.01" :name="`policies[${index}][premium_amount]`" x-model="policy.premium" class="form-control dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100" required placeholder="0.00">
                                        </div>
                                        <div class="form-group">
                                            <label class="text-[10px] font-black text-slate-400 uppercase mb-2 block">Expiry Date</label>
                                            <input type="date" :name="`policies[${index}][expiry_date]`" x-model="policy.expiry" class="form-control dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100" required>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>


                    <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-50">
                        <a href="{{ route('clients.index') }}" class="text-sm font-bold text-gray-400 hover:text-gray-600 transition-colors">Discard Changes</a>
                        <button type="submit" class="premium-btn premium-btn-primary px-10 shadow-lg">
                            Register Client
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('photo-preview').innerHTML = '<img src="' + e.target.result + '" class="h-full w-full object-cover">';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</x-app-layout>
