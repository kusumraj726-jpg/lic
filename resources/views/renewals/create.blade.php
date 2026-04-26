<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-slate-900 uppercase tracking-tight dark:text-slate-100">
            {{ __('New Policy Renewal') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="premium-card">
                <div class="border-b border-gray-100 pb-6 mb-8">
                    <h3 class="text-2xl font-extrabold text-gray-900 dark:text-gray-100">New Policy Renewal</h3>
                    <p class="text-gray-500 mt-1 dark:text-slate-400">Schedule a policy renewal reminder for a client.</p>
                </div>

                <form action="{{ route('renewals.store') }}" method="POST" class="space-y-8" x-data="{ 
                    policyTypeMode: '{{ old('custom_commission_rate') ? 'custom' : (old('policy_type') && !in_array(old('policy_type'), ['Life Insurance', 'Health Insurance', 'Motor Insurance', 'General Insurance']) ? 'custom' : old('policy_type', '')) }}',
                    clientPolicies: {{ json_encode($clientPolicies ?? [], JSON_FORCE_OBJECT) }},
                    selectedClient: '{{ old('client_id') }}',
                    policyNumberInput: '{{ old('policy_number') }}',
                    get availablePolicies() {
                        return this.clientPolicies[String(this.selectedClient)] || [];
                    },
                    syncPolicyDetails() {
                        let policy = this.availablePolicies.find(p => p.number === this.policyNumberInput);
                        if (policy) {
                            let detectedType = policy.type;
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
                        <div class="form-group">
                            <label for="policy_number">Policy Number <span class="text-rose-500">*</span></label>
                            
                            <!-- Dynamic Selector -->
                            <template x-if="availablePolicies.length > 0">
                                <select name="policy_number" x-model="policyNumberInput" @change="syncPolicyDetails()" class="form-control dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100" required>
                                    <option value="">-- Select Policy --</option>
                                    <template x-for="policy in availablePolicies" :key="policy.number">
                                        <option :value="policy.number" x-text="policy.number"></option>
                                    </template>
                                </select>
                            </template>
                            
                            <template x-if="availablePolicies.length === 0">
                                <input type="text" name="policy_number" x-model="policyNumberInput" class="form-control dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100" placeholder="Type Policy Number" required>
                            </template>
                            
                            <x-input-error class="mt-2" :messages="$errors->get('policy_number')" />
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
                            </div>

                            <div x-show="policyTypeMode === 'custom'" x-collapse class="p-5 bg-slate-50 dark:bg-slate-800/50 rounded-2xl border border-slate-100 dark:border-slate-700/50">
                                <label class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest block mb-2">Custom Policy Name <span class="text-rose-500">*</span></label>
                                <input type="text" :name="policyTypeMode === 'custom' ? 'policy_type' : ''" value="{{ old('policy_type') }}" class="w-full px-4 py-2 bg-white dark:bg-[#0f172a] rounded-xl border border-slate-200 dark:border-slate-700 text-sm font-bold focus:ring-2 focus:ring-indigo-500/20 text-slate-900 dark:text-slate-100" placeholder="e.g. Cyber Security">
                            </div>
                        </div>
                        <x-form-input label="Premium Amount (₹)" name="premium_amount" type="number" step="0.01" required />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <x-form-input label="Expiry Date" name="expiry_date" type="date" required />
                        <div class="form-group">
                            <label for="status">Renewal Status</label>
                            <select id="status" name="status" class="form-control dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500">
                                <option value="pending" selected>Pending Notification</option>
                                <option value="notified">Client Notified</option>
                                <option value="renewed">Renewed Successfully</option>
                                <option value="lapsed">Policy Lapsed</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-50">
                        <a href="{{ route('renewals.index') }}" class="text-sm font-bold text-gray-400 hover:text-gray-600 transition-colors">Discard</a>
                        <button type="submit" class="premium-btn premium-btn-primary px-10 shadow-lg">
                            Schedule Renewal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
