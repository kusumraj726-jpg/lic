<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-slate-900 uppercase tracking-tight">
            {{ __('New Insurance Claim') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="premium-card">
                <div class="border-b border-gray-100 pb-6 mb-8">
                    <h3 class="text-2xl font-extrabold text-gray-900">New Insurance Claim</h3>
                    <p class="text-gray-500 mt-1">Register a new policy claim for a client.</p>
                </div>

                <form action="{{ route('claims.store') }}" method="POST" class="space-y-8">
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
                        <x-form-input label="Policy Type (e.g. Life, Health)" name="policy_type" required />
                        <x-form-input label="Claim Amount (₹)" name="claim_amount" type="number" step="0.01" required />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <x-form-input label="Incident Date" name="incident_date" type="date" required />
                        <div class="form-group">
                            <label for="status">Current Status</label>
                            <select id="status" name="status" class="form-control">
                                <option value="submitted" selected>Submitted</option>
                                <option value="pending">Pending</option>
                                <option value="approved">Approved</option>
                                <option value="rejected">Rejected</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description">Incident Details / Notes</label>
                        <textarea id="description" name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>

                    <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-50">
                        <a href="{{ route('claims.index') }}" class="text-sm font-bold text-gray-400 hover:text-gray-600 transition-colors">Discard</a>
                        <button type="submit" class="premium-btn premium-btn-primary px-10 shadow-indigo-200 shadow-lg">
                            Register Claim
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
