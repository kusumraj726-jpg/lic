<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-slate-900 uppercase tracking-tight">
            {{ __('Add New Client') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="premium-card">
                <div class="border-b border-gray-100 pb-6 mb-8">
                    <h3 class="text-2xl font-extrabold text-gray-900">Client Information</h3>
                    <p class="text-gray-500 mt-1">Register a new client in the ERP system.</p>
                </div>

                <form action="{{ route('clients.store') }}" method="POST" class="space-y-8">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <x-form-input label="Full Name" name="name" required autofocus />
                        <x-form-input label="Email Address" name="email" type="email" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <x-form-input label="Date of Birth" name="dob" type="date" />
                        <div class="form-group flex-1">
                            <label for="gender" class="block text-sm font-medium text-slate-700">Gender</label>
                            <select id="gender" name="gender" class="form-control mt-1 block w-full rounded-xl border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Select Gender</option>
                                <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('gender')" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <x-form-input label="Phone Number" name="phone" placeholder="+1 234 567 890" minlength="10" maxlength="10" pattern="[0-9]{10}" title="10-digit Phone Number" />
                        <div class="form-group flex-1">
                            <label for="address">Residential Address</label>
                            <textarea id="address" name="address" class="form-control" rows="3">{{ old('address') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('address')" />
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-50">
                        <a href="{{ route('clients.index') }}" class="text-sm font-bold text-gray-400 hover:text-gray-600 transition-colors">Discard Changes</a>
                        <button type="submit" class="premium-btn premium-btn-primary px-10 shadow-indigo-200 shadow-lg">
                            Register Client
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
