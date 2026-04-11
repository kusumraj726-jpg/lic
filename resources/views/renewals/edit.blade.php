<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-slate-900 uppercase tracking-tight">
            {{ __('Edit Renewal') }}: {{ $renewal->policy_number }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('renewals.update', $renewal) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PATCH')
                        <div>
                            <x-input-label for="client_id" :value="__('Select Client')" />
                            <select id="client_id" name="client_id" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}" {{ old('client_id', $renewal->client_id) == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('client_id')" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="policy_number" :value="__('Policy Number')" />
                                <x-text-input id="policy_number" name="policy_number" type="text" class="mt-1 block w-full" :value="old('policy_number', $renewal->policy_number)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('policy_number')" />
                            </div>
                            <div>
                                <x-input-label for="policy_type" :value="__('Policy Type')" />
                                <x-text-input id="policy_type" name="policy_type" type="text" class="mt-1 block w-full" :value="old('policy_type', $renewal->policy_type)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('policy_type')" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="premium_amount" :value="__('Premium Amount (₹)')" />
                                <x-text-input id="premium_amount" name="premium_amount" type="number" step="0.01" class="mt-1 block w-full" :value="old('premium_amount', $renewal->premium_amount)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('premium_amount')" />
                            </div>
                            <div>
                                <x-input-label for="expiry_date" :value="__('Expiry Date')" />
                                <x-text-input id="expiry_date" name="expiry_date" type="date" class="mt-1 block w-full" :value="old('expiry_date', $renewal->expiry_date)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('expiry_date')" />
                            </div>
                        </div>

                        <div>
                            <x-input-label for="status" :value="__('Status')" />
                            <select id="status" name="status" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option value="pending" {{ old('status', $renewal->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="notified" {{ old('status', $renewal->status) == 'notified' ? 'selected' : '' }}>Notified</option>
                                <option value="renewed" {{ old('status', $renewal->status) == 'renewed' ? 'selected' : '' }}>Renewed</option>
                                <option value="lapsed" {{ old('status', $renewal->status) == 'lapsed' ? 'selected' : '' }}>Lapsed</option>
                            </select>
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit" class="premium-btn premium-btn-primary">
                                {{ __('Update Renewal') }}
                            </button>
                            <a href="{{ route('renewals.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
