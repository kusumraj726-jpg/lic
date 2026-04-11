<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-slate-900 uppercase tracking-tight">
            {{ __('New Policy Renewal') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="premium-card">
                <div class="border-b border-gray-100 pb-6 mb-8">
                    <h3 class="text-2xl font-extrabold text-gray-900">New Policy Renewal</h3>
                    <p class="text-gray-500 mt-1">Schedule a policy renewal reminder for a client.</p>
                </div>

                <form action="{{ route('renewals.store') }}" method="POST" class="space-y-8">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="form-group">
                            <label for="client_id">Policy Holder</label>
                            <select id="client_id" name="client_id" class="form-control" required>
                                <option value="">-- Choose Client --</option>
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('client_id')" />
                        </div>
                        <x-form-input label="Policy Number" name="policy_number" required />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <x-form-input label="Policy Type" name="policy_type" required />
                        <x-form-input label="Premium Amount (₹)" name="premium_amount" type="number" step="0.01" required />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <x-form-input label="Expiry Date" name="expiry_date" type="date" required />
                        <div class="form-group">
                            <label for="status">Renewal Status</label>
                            <select id="status" name="status" class="form-control">
                                <option value="pending" selected>Pending Notification</option>
                                <option value="notified">Client Notified</option>
                                <option value="renewed">Renewed Successfully</option>
                                <option value="lapsed">Policy Lapsed</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-50">
                        <a href="{{ route('renewals.index') }}" class="text-sm font-bold text-gray-400 hover:text-gray-600 transition-colors">Discard</a>
                        <button type="submit" class="premium-btn premium-btn-primary px-10 shadow-indigo-200 shadow-lg">
                            Schedule Renewal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
