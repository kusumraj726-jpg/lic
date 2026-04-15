<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-slate-900 uppercase tracking-tight dark:text-slate-100">
            {{ __('Edit Query') }}: #{{ $query->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('queries.update', $query) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PATCH')
                        <div x-data="{ isNew: false }">
                            <x-input-label for="client_id" :value="__('Select Client (Optional)')" />
                            <select id="client_id" name="client_id" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" @change="isNew = $event.target.value === 'new'">
                                <option value="">-- General Query --</option>
                                <option value="new">+ Add New Client (Custom Entry)</option>
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}" {{ old('client_id', $query->client_id) == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
                                @endforeach
                            </select>
                            <div x-show="isNew" x-cloak class="mt-3 animate-fadeIn">
                                <x-input-label for="new_client_name" :value="__('New Client Name')" class="text-indigo-600" />
                                <x-text-input id="new_client_name" name="new_client_name" type="text" class="mt-1 block w-full border-indigo-200" :value="old('new_client_name')" placeholder="Enter custom client name..." />
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('client_id')" />
                            <x-input-error class="mt-2" :messages="$errors->get('new_client_name')" />
                        </div>

                        <div>
                            <x-input-label for="subject" :value="__('Subject')" />
                            <x-text-input id="subject" name="subject" type="text" class="mt-1 block w-full" :value="old('subject', $query->subject)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('subject')" />
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" rows="4" required>{{ old('description', $query->description) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="priority" :value="__('Priority')" />
                                <select id="priority" name="priority" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option value="low" {{ old('priority', $query->priority) == 'low' ? 'selected' : '' }}>Low</option>
                                    <option value="medium" {{ old('priority', $query->priority) == 'medium' ? 'selected' : '' }}>Medium</option>
                                    <option value="high" {{ old('priority', $query->priority) == 'high' ? 'selected' : '' }}>High</option>
                                </select>
                            </div>

                            <div>
                                <x-input-label for="status" :value="__('Status')" />
                                <select id="status" name="status" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option value="open" {{ old('status', $query->status) == 'open' ? 'selected' : '' }}>Open</option>
                                    <option value="in-progress" {{ old('status', $query->status) == 'in-progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="resolved" {{ old('status', $query->status) == 'resolved' ? 'selected' : '' }}>Resolved</option>
                                    <option value="closed" {{ old('status', $query->status) == 'closed' ? 'selected' : '' }}>Closed</option>
                                </select>
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit" class="premium-btn premium-btn-primary">
                                {{ __('Update Query') }}
                            </button>
                            <a href="{{ route('queries.index') }}" class="text-sm text-gray-600 hover:text-gray-900 dark:text-gray-300">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
