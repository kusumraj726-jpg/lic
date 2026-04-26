<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-slate-900 uppercase tracking-tight dark:text-slate-100">
            {{ __('Submit New Query') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="premium-card">
                <div class="border-b border-gray-100 pb-6 mb-8">
                    <h3 class="text-2xl font-extrabold text-gray-900 dark:text-gray-100">New Query Request</h3>
                    <p class="text-gray-500 mt-1 dark:text-slate-400">Submit a new inquiry or support request for a client.</p>
                </div>

                <form action="{{ route('queries.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8" 
                        x-data="{ 
                            submitting: false,
                            clientPolicies: {!! empty($clientPolicies) ? '{}' : json_encode($clientPolicies) !!},
                            selectedClient: '{{ old('client_id') }}',
                            policyNumberInput: '{{ old('policy_number') }}',
                            manualInput: false,
                            get availablePolicies() {
                                return this.clientPolicies[String(this.selectedClient)] || [];
                            },
                            updatePolicyInput() {
                                let policies = this.availablePolicies;
                                if (policies.length === 1) {
                                    this.policyNumberInput = policies[0].number;
                                } else {
                                    this.policyNumberInput = '';
                                }
                                this.manualInput = false;
                            },
                            isNew: '{{ old('client_id') }}' === 'new'
                        }" @submit="submitting = true">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="form-group">
                            <label for="client_id">Associate Client</label>
                            <select id="client_id" name="client_id" x-model="selectedClient" class="form-control dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500" @change="isNew = ($event.target.value === 'new'); updatePolicyInput()">
                                <option value="">-- General Query --</option>
                                <option value="new" {{ old('client_id') == 'new' ? 'selected' : '' }}>+ Add New Client (Custom Entry)</option>
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
                                @endforeach
                            </select>
                            <div x-show="isNew" x-cloak class="mt-4 animate-fadeIn">
                                <label for="new_client_name" class="text-xs font-bold text-indigo-600 uppercase">New Client Name</label>
                                <input type="text" id="new_client_name" name="new_client_name" value="{{ old('new_client_name') }}" placeholder="Enter custom client name..." class="form-control border-indigo-200 focus:border-indigo-500 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500">
                                <p class="text-[10px] text-gray-400 mt-1 italic">Selecting this will create a new client record automatically.</p>
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('client_id')" />
                            <x-input-error class="mt-2" :messages="$errors->get('new_client_name')" />
                        </div>
                        <div class="form-group">
                            <label for="policy_number">Policy Number</label>
                            
                            <div class="relative min-h-[42px]">
                                <!-- Fallback Input: ALWAYS visible if Alpine hasn't decided yet or if no policies exist -->
                                <div x-show="!(availablePolicies && availablePolicies.length > 0) || manualInput || policyNumberInput === 'manual'">
                                    <input type="text" name="policy_number_manual" x-model="policyNumberInput" 
                                           class="form-control dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100" 
                                           placeholder="Enter Policy Number">
                                </div>

                                <!-- Dropdown: Only shows if policies exist AND we aren't in manual mode -->
                                <div x-show="availablePolicies && availablePolicies.length > 0 && !manualInput && policyNumberInput !== 'manual'" x-cloak>
                                    <select name="policy_number_select" x-model="policyNumberInput" 
                                            @change="manualInput = (policyNumberInput === 'manual')"
                                            class="form-control dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100">
                                        <option value="">-- Select Existing Policy --</option>
                                        <template x-for="policy in (availablePolicies || [])" :key="policy.number">
                                            <option :value="policy.number" x-text="policy.number + ' (' + policy.type + ')'"></option>
                                        </template>
                                        <option value="manual">+ Enter Different Policy Number</option>
                                    </select>
                                </div>
                                
                                <!-- Safety Hidden Field to ensure 'policy_number' is always sent -->
                                <input type="hidden" name="policy_number" :value="policyNumberInput === 'manual' ? '' : policyNumberInput">
                            </div>
                            
                            <x-input-error class="mt-2" :messages="$errors->get('policy_number')" />
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-1 gap-8">
                        <x-form-input label="Inquiry Subject" name="subject" required />
                    </div>

                    <div class="form-group">
                        <label for="description">Detailed Description</label>
                        <textarea id="description" name="description" class="form-control dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500" rows="4" required>{{ old('description') }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="form-group">
                            <label for="priority">Priority Level</label>
                            <select id="priority" name="priority" class="form-control dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500">
                                <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low Priority</option>
                                <option value="medium" {{ old('priority') == 'medium' ? 'selected' : 'selected' }}>Medium Priority</option>
                                <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High Priority</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status">Initial Status</label>
                            <select id="status" name="status" class="form-control dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500">
                                <option value="pending" {{ old('status') == 'pending' ? 'selected' : 'selected' }}>Pending</option>
                                <option value="approved" {{ old('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="rejected" {{ old('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="document">Attachment / Supporting Document</label>
                        <input type="file" id="document" name="document" class="form-control border-dashed border-2 border-indigo-100 hover:border-indigo-300 transition-colors p-4 bg-slate-50/50 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500">
                        <p class="text-[10px] text-gray-400 mt-1 italic">Optional: Upload PDF, JPEG, or DOCX (Max 5MB).</p>
                        <x-input-error class="mt-2" :messages="$errors->get('document')" />
                    </div>

                    <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-50">
                        <a href="{{ route('queries.index') }}" class="text-sm font-bold text-gray-400 hover:text-gray-600 transition-colors">Discard</a>
                        <button type="submit" class="premium-btn premium-btn-primary px-10 shadow-lg flex items-center gap-2" :disabled="submitting">
                            <svg x-show="submitting" class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span x-text="submitting ? 'Submitting...' : 'Submit Inquiry'"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
