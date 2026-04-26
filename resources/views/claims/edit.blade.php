<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-slate-900 uppercase tracking-tight dark:text-slate-100">
            {{ __('Edit Claim') }}: {{ $claim->policy_number }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('claims.update', $claim) }}" method="POST" class="space-y-6" x-data="{ 
                        policyTypeMode: '{{ (old('policy_type', $claim->policy_type) && !in_array(old('policy_type', $claim->policy_type), ['Life Insurance', 'Health Insurance', 'Motor Insurance', 'General Insurance'])) ? 'custom' : old('policy_type', $claim->policy_type) }}',
                        clientPolicies: {{ json_encode($clientPolicies ?? [], JSON_FORCE_OBJECT) }},
                        selectedClient: '{{ old('client_id', $claim->client_id) }}',
                        policyNumberInput: '{{ old('policy_number', $claim->policy_number) }}',
                        get availablePolicies() {
                            return this.clientPolicies[String(this.selectedClient)] || [];
                        },
                        syncPolicyDetails() {
                            let policy = this.availablePolicies.find(p => p.number === this.policyNumberInput);
                            if (policy) {
                                let detectedType = policy.type;
                                let detectedCommission = policy.commission;
                                
                                if (['Life Insurance', 'Health Insurance', 'Motor Insurance', 'General Insurance'].includes(detectedType)) {
                                    this.policyTypeMode = detectedType;
                                } else {
                                    this.policyTypeMode = 'custom';
                                    this.$nextTick(() => {
                                        let customInput = document.querySelector('input[name=\'policy_type\']');
                                        if (customInput) customInput.value = detectedType;
                                    });
                                }
                            }
                        },
                        updatePolicyInput() {
                            let policies = this.availablePolicies;
                            if (policies.length === 1) {
                                this.policyNumberInput = policies[0].number;
                                this.syncPolicyDetails();
                            } else {
                                // Only clear if the current number isn't in the new client's list
                                let numbers = policies.map(p => p.number);
                                if (!numbers.includes(this.policyNumberInput)) {
                                    this.policyNumberInput = '';
                                }
                            }
                        }
                    }">
                        @csrf
                        @method('PATCH')
                        <div>
                            <x-input-label for="client_id" :value="__('Select Client')" />
                            <select id="client_id" name="client_id" x-model="selectedClient" @change="updatePolicyInput()" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}" {{ old('client_id', $claim->client_id) == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('client_id')" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div x-data="{ manualInput: false }">
                                <x-input-label for="policy_number" :value="__('Policy Number')" />
                                
                                <!-- Block 1: Dropdown (Only if policies exist) -->
                                <template x-if="availablePolicies.length > 0">
                                    <div class="space-y-3 mt-1">
                                        <select name="policy_number" x-model="policyNumberInput" 
                                                @change="syncPolicyDetails(); manualInput = (policyNumberInput === 'manual')"
                                                class="block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                            <option value="">-- Select Existing Policy --</option>
                                            <template x-for="policy in availablePolicies" :key="policy.number">
                                                <option :value="policy.number" x-text="policy.number + ' (' + policy.type + ')'"></option>
                                            </template>
                                            <option value="manual">+ Enter Different Policy Number</option>
                                        </select>

                                        <x-text-input x-show="manualInput || policyNumberInput === 'manual'" 
                                               id="policy_number_manual" name="policy_number_manual" type="text" 
                                               class="mt-1 block w-full" 
                                               placeholder="Type Policy Number Here" />
                                    </div>
                                </template>

                                <!-- Block 2: Text Input (If NO policies exist) -->
                                <template x-if="availablePolicies.length === 0">
                                    <x-text-input id="policy_number" name="policy_number" type="text" 
                                           class="mt-1 block w-full" x-model="policyNumberInput" 
                                           placeholder="Enter Policy Number" />
                                </template>
                            </div>
                            <div class="space-y-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <x-input-label for="policy_type_select" :value="__('Policy Type')" />
                                        <select id="policy_type_select" x-model="policyTypeMode" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" :name="['Life Insurance', 'Health Insurance', 'Motor Insurance', 'General Insurance'].includes(policyTypeMode) ? 'policy_type' : 'policy_type_preset'" required>
                                            <option value="">-- Select Type --</option>
                                            <option value="Life Insurance">Life Insurance</option>
                                            <option value="Health Insurance">Health Insurance</option>
                                            <option value="Motor Insurance">Motor Insurance</option>
                                            <option value="General Insurance">General Insurance</option>
                                            <option value="custom">Custom Policy Configurator</option>
                                        </select>
                                        <x-input-error class="mt-2" :messages="$errors->get('policy_type')" />
                                    </div>
                                    <div class="relative group/comm flex items-center">
                                        <div class="relative flex-1 mt-1">
                                            <input type="number" step="0.01" id="custom_commission_rate" name="custom_commission_rate" value="{{ old('custom_commission_rate', $claim->custom_commission_rate) }}" class="block w-full pl-4 pr-12 py-2 bg-white dark:bg-gray-900 rounded-md border-gray-300 dark:border-gray-700 text-sm font-bold focus:border-indigo-500 focus:ring-indigo-500 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none" placeholder="Enter %">
                                            <span class="absolute inset-y-0 right-0 pr-4 flex items-center justify-center text-sm font-black text-indigo-500 pointer-events-none tracking-tighter">%</span>
                                        </div>
                                        <button type="button" 
                                                @click="let p = availablePolicies.find(p => p.number === policyNumberInput); if(p) { $el.closest('div').querySelector('input').value = p.commission || '' }"
                                                class="ml-2 p-1.5 text-slate-300 hover:text-indigo-500 dark:text-slate-600 dark:hover:text-indigo-400 transition-all opacity-0 group-hover/comm:opacity-100 flex-shrink-0" 
                                                title="Reset to Client Default">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg>
                                        </button>
                                    </div>
                                    <p class="text-[9px] font-bold text-slate-400 dark:text-slate-500 mt-1 uppercase tracking-widest">Affects only this entry (Overrides Master Default).</p>
                                    </div>
                                </div>
                                <div x-show="policyTypeMode === 'custom'" x-collapse class="p-4 bg-gray-50 dark:bg-gray-800/50 rounded-lg border border-gray-100 dark:border-gray-700">
                                    <x-input-label for="custom_policy_type" :value="__('Custom Policy Name')" />
                                    <x-text-input id="custom_policy_type" :name="policyTypeMode === 'custom' ? 'policy_type' : ''" type="text" class="mt-1 block w-full" :value="old('policy_type', $claim->policy_type)" placeholder="e.g. Cyber Security" />
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="claim_amount" :value="__('Claim Amount (₹)')" />
                                <x-text-input id="claim_amount" name="claim_amount" type="number" step="0.01" class="mt-1 block w-full" :value="old('claim_amount', $claim->claim_amount)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('claim_amount')" />
                            </div>
                            <div>
                                <x-input-label for="incident_date" :value="__('Incident Date')" />
                                <x-text-input id="incident_date" name="incident_date" type="date" class="mt-1 block w-full" :value="old('incident_date', $claim->incident_date)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('incident_date')" />
                            </div>
                        </div>

                        <div>
                            <x-input-label for="status" :value="__('Status')" />
                            <select id="status" name="status" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option value="submitted" {{ old('status', $claim->status) == 'submitted' ? 'selected' : '' }}>Submitted</option>
                                <option value="pending" {{ old('status', $claim->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ old('status', $claim->status) == 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="rejected" {{ old('status', $claim->status) == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('Description / Notes')" />
                            <textarea id="description" name="description" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" rows="3">{{ old('description', $claim->description) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit" class="premium-btn premium-btn-primary">
                                {{ __('Update Claim') }}
                            </button>
                            <a href="{{ route('claims.index') }}" class="text-sm text-gray-600 hover:text-gray-900 dark:text-gray-300">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
