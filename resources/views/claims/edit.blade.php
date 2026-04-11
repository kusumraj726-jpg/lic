<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-slate-900 uppercase tracking-tight">
            {{ __('Edit Claim') }}: {{ $claim->policy_number }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('claims.update', $claim) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PATCH')
                        <div>
                            <x-input-label for="client_id" :value="__('Select Client')" />
                            <select id="client_id" name="client_id" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}" {{ old('client_id', $claim->client_id) == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('client_id')" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="policy_number" :value="__('Policy Number')" />
                                <x-text-input id="policy_number" name="policy_number" type="text" class="mt-1 block w-full" :value="old('policy_number', $claim->policy_number)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('policy_number')" />
                            </div>
                            <div>
                                <x-input-label for="policy_type" :value="__('Policy Type')" />
                                <x-text-input id="policy_type" name="policy_type" type="text" class="mt-1 block w-full" :value="old('policy_type', $claim->policy_type)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('policy_type')" />
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
                            <a href="{{ route('claims.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
