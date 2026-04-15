<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-slate-900 uppercase tracking-tight dark:text-slate-100">
            {{ __('New Insurance Claim') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="premium-card">
                <div class="border-b border-gray-100 pb-6 mb-8">
                    <h3 class="text-2xl font-extrabold text-gray-900 dark:text-gray-100">New Insurance Claim</h3>
                    <p class="text-gray-500 mt-1 dark:text-slate-400">Register a new policy claim for a client.</p>
                </div>

                <form action="{{ route('claims.store') }}" method="POST" class="space-y-8" x-data="{ 
                    policyTypeMode: '{{ old('policy_type') && !in_array(old('policy_type'), ['Life Insurance', 'Health Insurance', 'Motor Insurance', 'General Insurance']) ? 'custom' : old('policy_type', '') }}',
                    clientPolicies: {{ json_encode($clientPolicies ?? [], JSON_FORCE_OBJECT) }},
                    selectedClient: '{{ old('client_id') }}',
                    policyNumberInput: '{{ old('policy_number') }}',
                    get availablePolicies() {
                        return this.clientPolicies[String(this.selectedClient)] || [];
                    },
                    updatePolicyInput() {
                        let policies = this.availablePolicies;
                        let numbers = policies.map(p => p.number);
                        
                        if (policies.length === 1) {
                            this.policyNumberInput = policies[0].number;
                            let detectedType = policies[0].type;
                            let detectedCommission = policies[0].commission;
                            if (['Life Insurance', 'Health Insurance', 'Motor Insurance', 'General Insurance'].includes(detectedType)) {
                                this.policyTypeMode = detectedType;
                            } else {
                                this.policyTypeMode = 'custom';
                                this.$nextTick(() => {
                                    let customInput = document.querySelector('input[name=\'policy_type\']');
                                    let commissionInput = document.querySelector('input[name=\'custom_commission_rate\']');
                                    if (customInput) customInput.value = detectedType;
                                    if (commissionInput) commissionInput.value = detectedCommission;
                                });
                            }
                        } else if (!numbers.includes(this.policyNumberInput)) {
                            this.policyNumberInput = '';
                        }
                    }
                }">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="form-group">
                            <label for="client_id">Policy Holder</label>
                            <select id="client_id" name="client_id" x-model="selectedClient" @change="updatePolicyInput()" class="form-control dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500" required>
                                <option value="">-- Choose Client --</option>
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('client_id')" />
                        </div>
                        <div class="relative">
                            <x-form-input label="Policy Number" name="policy_number" required x-model="policyNumberInput" list="policy_list_data_claims" autocomplete="one-time-code" />
                            <datalist id="policy_list_data_claims">
                                <template x-for="policy in availablePolicies" :key="policy.number">
                                    <option :value="policy.number" x-text="policy.number"></option>
                                </template>
                            </datalist>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
                        <div class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="form-group">
                                    <label for="policy_type_select">Policy Type <span class="text-rose-500">*</span></label>
                                    <select id="policy_type_select" x-model="policyTypeMode" class="form-control hover:border-indigo-500 transition-colors dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100" :name="['Life Insurance', 'Health Insurance', 'Motor Insurance', 'General Insurance'].includes(policyTypeMode) ? 'policy_type' : 'policy_type_preset'" required>
                                        <option value="">-- Select Type --</option>
                                        <option value="Life Insurance">Life Insurance</option>
                                        <option value="Health Insurance">Health Insurance</option>
                                        <option value="Motor Insurance">Motor Insurance</option>
                                        <option value="General Insurance">General Insurance</option>
                                        <option value="custom">Custom Policy Configurator</option>
                                    </select>
                                    <x-input-error class="mt-2" :messages="$errors->get('policy_type')" />
                                </div>
                                <div class="form-group">
                                    <label class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest block mb-2">Commission (%)</label>
                                    <div class="relative group/comm flex items-center">
                                        <div class="relative flex-1">
                                            <input type="number" step="0.01" id="custom_commission_rate" name="custom_commission_rate" value="{{ old('custom_commission_rate') }}" class="w-full pl-4 pr-12 py-2 bg-white dark:bg-[#0f172a] rounded-xl border border-slate-200 dark:border-slate-700 text-sm font-bold focus:ring-2 focus:ring-indigo-500/20 text-slate-900 dark:text-slate-100 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none" placeholder="Enter %">
                                            <span class="absolute inset-y-0 right-0 pr-4 flex items-center justify-center text-sm font-black text-indigo-500 pointer-events-none tracking-tighter">%</span>
                                        </div>
                                        <button type="button" 
                                                @click="let p = availablePolicies.find(p => p.number === policyNumberInput); if(p) { $el.closest('.form-group').querySelector('input').value = p.commission || '' }"
                                                class="ml-2 p-1.5 text-slate-300 hover:text-indigo-500 dark:text-slate-600 dark:hover:text-indigo-400 transition-all opacity-0 group-hover/comm:opacity-100 flex-shrink-0" 
                                                title="Reset to Client Default">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg>
                                        </button>
                                    </div>
                                    <p class="text-[9px] font-bold text-slate-400 dark:text-slate-500 mt-1 uppercase tracking-widest">Affects only this entry (Overrides Master Default).</p>
                                </div>
                            </div>

                            <div x-show="policyTypeMode === 'custom'" x-collapse class="p-5 bg-slate-50 dark:bg-slate-800/50 rounded-2xl border border-slate-100 dark:border-slate-700/50">
                                <label class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest block mb-2">Custom Policy Name <span class="text-rose-500">*</span></label>
                                <input type="text" :name="policyTypeMode === 'custom' ? 'policy_type' : ''" value="{{ old('policy_type') }}" class="w-full px-4 py-2 bg-white dark:bg-[#0f172a] rounded-xl border border-slate-200 dark:border-slate-700 text-sm font-bold focus:ring-2 focus:ring-indigo-500/20 text-slate-900 dark:text-slate-100" placeholder="e.g. Cyber Security">
                            </div>
                        </div>
                        <x-form-input label="Claim Amount (₹)" name="claim_amount" type="number" step="0.01" required />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <x-form-input label="Incident Date" name="incident_date" type="date" required />
                        <div class="form-group">
                            <label for="status">Current Status</label>
                            <select id="status" name="status" class="form-control dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500">
                                <option value="submitted" selected>Submitted</option>
                                <option value="pending">Pending</option>
                                <option value="approved">Approved</option>
                                <option value="rejected">Rejected</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description">Incident Details / Notes</label>
                        <textarea id="description" name="description" class="form-control dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500" rows="3">{{ old('description') }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>

                    <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-50">
                        <a href="{{ route('claims.index') }}" class="text-sm font-bold text-gray-400 hover:text-gray-600 transition-colors">Discard</a>
                        <button type="submit" class="premium-btn premium-btn-primary px-10 shadow-lg">
                            Register Claim
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
