<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-slate-900 uppercase tracking-tight dark:text-slate-100">
            {{ __('Edit Client') }}: {{ $client->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('clients.update', $client) }}" method="POST" enctype="multipart/form-data" class="space-y-6" x-data="{ policyTypeMode: '{{ old('custom_commission_rate', $latestPolicy?->custom_commission_rate) ? 'custom' : (in_array(old('policy_type', $latestPolicy?->policy_type), ['Life Insurance', 'Health Insurance', 'Motor Insurance', 'General Insurance']) ? old('policy_type', $latestPolicy?->policy_type) : (old('policy_type', $latestPolicy?->policy_type) ? 'custom' : '')) }}' }">
                        @csrf
                        @method('PATCH')

                        <!-- Profile Photo Section -->
                        <div class="flex flex-col md:flex-row items-center gap-8 bg-slate-50/50 dark:bg-slate-800/50 p-6 rounded-[2rem] border border-slate-100 dark:border-slate-700 mb-8">
                            <div class="relative group">
                                <div class="h-24 w-24 rounded-[2rem] bg-gradient-to-br from-indigo-500 to-purple-600 p-1 shadow-xl transition-transform group-hover:scale-105">
                                    <div class="h-full w-full rounded-[1.75rem] bg-white dark:bg-slate-900 flex items-center justify-center overflow-hidden border-4 border-white dark:border-slate-800">
                                        <div id="photo-preview" class="h-full w-full flex items-center justify-center bg-slate-50 dark:bg-slate-800/50 text-slate-300 dark:text-slate-500">
                                            @if($client->photo)
                                                <img src="{{ Storage::url($client->photo) }}" class="h-full w-full object-cover">
                                            @else
                                                <svg class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <label for="photo" class="absolute -bottom-1 -right-1 h-8 w-8 bg-white dark:bg-slate-800 shadow-lg rounded-lg flex items-center justify-center text-slate-600 dark:text-slate-300 hover:text-indigo-600 dark:hover:text-indigo-400 cursor-pointer transition-all hover:scale-110 border border-slate-100 dark:border-slate-700">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                </label>
                                <input type="file" id="photo" name="photo" class="hidden dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500" accept="image/*" onchange="previewImage(this)">
                            </div>
                            <div class="flex-1 text-left">
                                <h3 class="text-sm font-black text-slate-900 uppercase tracking-tight dark:text-slate-100">Client Photo</h3>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-0.5">Change profile picture (Max 2MB)</p>
                                @error('photo') <p class="text-xs text-rose-500 font-bold uppercase tracking-tighter">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div>
                            <x-input-label for="name" :value="__('Full Name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $client->name)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div>
                            <x-input-label for="email" :value="__('Email Address')" />
                            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $client->email)" />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>

                        <div>
                            <x-input-label for="dob" :value="__('Date of Birth')" />
                            <x-text-input id="dob" name="dob" type="date" class="mt-1 block w-full" :value="old('dob', $client->dob)" />
                            <x-input-error class="mt-2" :messages="$errors->get('dob')" />
                        </div>

                        <div>
                            <x-input-label for="marriage_anniversary" :value="__('Marriage Anniversary')" />
                            <x-text-input id="marriage_anniversary" name="marriage_anniversary" type="date" class="mt-1 block w-full" :value="old('marriage_anniversary', $client->marriage_anniversary)" />
                            <x-input-error class="mt-2" :messages="$errors->get('marriage_anniversary')" />
                        </div>

                        <div>
                            <x-input-label for="gender" :value="__('Gender')" />
                            <select id="gender" name="gender" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option value="">Select Gender</option>
                                <option value="Male" {{ old('gender', $client->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ old('gender', $client->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                                <option value="Other" {{ old('gender', $client->gender) == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('gender')" />
                        </div>

                        <div>
                            <x-input-label for="phone" :value="__('Phone Number')" />
                            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $client->phone)" minlength="10" maxlength="10" pattern="[0-9]{10}" title="10-digit Phone Number" />
                            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                        </div>

                        <div>
                            <x-input-label for="address" :value="__('Address')" />
                            <textarea id="address" name="address" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" rows="3">{{ old('address', $client->address) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('address')" />
                        </div>

                        <!-- Policy Essentials Section -->
                        <div class="bg-indigo-50/50 dark:bg-indigo-900/10 p-6 rounded-2xl border border-indigo-100 dark:border-indigo-800 space-y-4">
                            <div class="flex items-center gap-3">
                                <div class="h-8 w-8 rounded-lg bg-indigo-500 flex items-center justify-center text-white">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                                </div>
                                <h3 class="text-xs font-black text-slate-900 uppercase tracking-widest dark:text-slate-100">Policy Master Record</h3>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <x-input-label for="policy_number" :value="__('Primary Policy Number')" />
                                    <x-text-input id="policy_number" name="policy_number" type="text" class="mt-1 block w-full" :value="old('policy_number', $latestPolicy?->policy_number)" placeholder="Enter number" />
                                </div>
                                <div>
                                    <x-input-label for="policy_type_select" :value="__('Policy Type')" />
                                    <select id="policy_type_select" x-model="policyTypeMode" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" :name="policyTypeMode === 'custom' ? 'policy_type_preset' : 'policy_type'">
                                        <option value="">-- Choose Type --</option>
                                        <option value="Life Insurance">Life Insurance</option>
                                        <option value="Health Insurance">Health Insurance</option>
                                        <option value="Motor Insurance">Motor Insurance</option>
                                        <option value="General Insurance">General Insurance</option>
                                        <option value="custom">Custom Policy Configurator</option>
                                    </select>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="form-group flex-1">
                                    <x-input-label for="custom_commission_rate" :value="__('Commission (%)')" />
                                    <div class="relative group/edit-comm flex items-center">
                                        <div class="relative flex-1">
                                            <input type="number" step="0.01" id="custom_commission_rate" name="custom_commission_rate" value="{{ old('custom_commission_rate', $latestPolicy?->custom_commission_rate) }}" class="mt-1 block w-full pl-4 pr-12 bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-700 text-sm font-bold focus:ring-4 focus:ring-indigo-500/10 text-slate-900 dark:text-slate-100 transition-all [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none" placeholder="Enter %">
                                            <span class="absolute inset-y-0 right-0 pr-4 flex items-center justify-center text-sm font-black text-indigo-500 pointer-events-none tracking-tighter">%</span>
                                        </div>
                                        <button type="button" 
                                                @click="document.getElementById('custom_commission_rate').value = 15"
                                                class="ml-2 p-2 text-slate-300 hover:text-indigo-500 dark:text-slate-600 dark:hover:text-indigo-400 transition-all opacity-0 group-hover/edit-comm:opacity-100 flex-shrink-0" 
                                                title="Restore to Company Default">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg>
                                        </button>
                                    </div>
                                    <p class="text-[9px] font-bold text-indigo-600 dark:text-indigo-400 mt-2 uppercase tracking-widest leading-none">Updates the Master Default for future entries.</p>
                                </div>
                                </div>
                                <div>
                                    <x-input-label for="premium_amount" :value="__('Premium Amount (₹)')" />
                                    <x-text-input id="premium_amount" name="premium_amount" type="number" step="0.01" class="mt-1 block w-full" :value="old('premium_amount', $latestPolicy?->premium_amount)" />
                                </div>
                            </div>

                            <div x-show="policyTypeMode === 'custom'" x-collapse class="p-4 bg-slate-50 dark:bg-slate-900/50 rounded-xl border border-slate-100 dark:border-slate-800">
                                <x-input-label for="custom_policy_name" :value="__('Custom Policy Name')" />
                                <x-text-input id="custom_policy_name" :name="policyTypeMode === 'custom' ? 'policy_type' : ''" type="text" class="mt-1 block w-full" :value="old('policy_type', $latestPolicy?->policy_type)" placeholder="e.g. Cyber Security" />
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit" class="premium-btn premium-btn-primary">
                                {{ __('Update Client') }}
                            </button>
                            <a href="{{ route('clients.index') }}" class="text-sm text-gray-600 hover:text-gray-900 dark:text-gray-300">Cancel</a>
                        </div>
                    </form>
                </div>
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
