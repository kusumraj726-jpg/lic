<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-slate-900 uppercase tracking-tight">
            {{ __('Manage Clients') }}
        </h2>
    </x-slot>

    <div class="py-6" x-data="{ 
        openModal: false, 
        mode: 'view', 
        submitting: false,
        client: {
            id: '',
            name: '',
            email: '',
            phone: '',
            address: '',
            dob: '',
            gender: '',
            marriage_anniversary: ''
        },
        openView(c) {
            this.client = c;
            this.mode = 'view';
            this.openModal = true;
        },
        openEdit(c) {
            this.client = {...c};
            this.mode = 'edit';
            this.openModal = true;
        },
        async submitForm() {
            this.submitting = true;
            try {
                const form = this.$refs.editForm;
                const formData = new FormData(form);
                const response = await fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });
                if (response.ok) {
                    this.openModal = false;
                    window.location.reload();
                } else {
                    const data = await response.json();
                    alert(data.message || 'Update failed');
                }
            } catch (e) {
                console.error(e);
                alert('An error occurred during submission.');
            } finally {
                this.submitting = false;
            }
        }
    }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-3xl font-extrabold text-gray-900">Client Directory</h2>
                    <p class="text-gray-500 mt-1">Manage your policyholders and their contact information.</p>
                </div>
                <div class="flex items-center gap-4">
                    <form action="{{ route('clients.index') }}" method="GET" class="relative group">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search clients..." class="pl-10 pr-4 py-2.5 rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white shadow-sm w-64 transition-all">
                        <svg class="h-5 w-5 absolute left-3 top-3 text-slate-400 group-focus-within:text-indigo-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                    </form>
                    <a href="{{ route('clients.create') }}" class="premium-btn premium-btn-primary flex items-center gap-2 shadow-lg shadow-indigo-100">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                        Add New Client
                    </a>
                </div>
            </div>

            <div class="premium-card overflow-hidden !p-0 border-none shadow-xl">
                <div class="overflow-x-auto">
                    <table class="premium-table">
                        <thead>
                            <tr>
                                <th>Client Name</th>
                                <th>Contact Details</th>
                                <th>Address</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($clients as $client)
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 flex-shrink-0 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-700 font-bold">
                                                {{ substr($client->name, 0, 1) }}
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-bold text-gray-900">{{ $client->name }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900 font-medium">{{ $client->email }}</div>
                                        <div class="text-xs text-gray-500 mt-0.5">{{ $client->phone }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-sm text-gray-600 italic">"{{ Str::limit($client->address, 30) }}"</span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-3 text-sm font-bold uppercase tracking-wider">
                                            <button @click='openView({{ json_encode([
                                                "id" => $client->id,
                                                "name" => $client->name,
                                                "email" => $client->email,
                                                "phone" => $client->phone,
                                                "address" => $client->address,
                                                "dob" => $client->dob,
                                                "gender" => $client->gender,
                                                "marriage_anniversary" => $client->marriage_anniversary
                                            ], JSON_HEX_APOS | JSON_HEX_QUOT) }})' class="text-indigo-600 hover:text-indigo-900 flex items-center gap-1 group transition-transform hover:scale-105">
                                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                                View
                                            </button>
                                            <button @click='openEdit({{ json_encode([
                                                "id" => $client->id,
                                                "name" => $client->name,
                                                "email" => $client->email,
                                                "phone" => $client->phone,
                                                "address" => $client->address,
                                                "dob" => $client->dob,
                                                "gender" => $client->gender,
                                                "marriage_anniversary" => $client->marriage_anniversary
                                            ], JSON_HEX_APOS | JSON_HEX_QUOT) }})' class="text-amber-600 hover:text-amber-900 flex items-center gap-1 group transition-transform hover:scale-105">
                                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                                Edit
                                            </button>
                                            <form action="{{ route('clients.destroy', $client) }}" method="POST" class="inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-rose-600 hover:text-rose-900 flex items-center gap-1 group" onclick="return confirm('Archive this client?')">
                                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                        <div class="flex flex-col items-center">
                                            <svg class="h-12 w-12 text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                                            <p>No clients found. Start by adding one!</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($clients->hasPages())
                    <div class="bg-gray-50 px-6 py-4 border-t border-gray-100">
                        {{ $clients->links() }}
                    </div>
                @endif
            </div>
        </div>

        <!-- Inline Modal Container -->
        <div x-show="openModal" class="fixed inset-0 z-50 overflow-y-auto" x-cloak>
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="openModal" 
                     x-transition:enter="ease-out duration-300" 
                     x-transition:enter-start="opacity-0" 
                     x-transition:enter-end="opacity-100" 
                     x-transition:leave="ease-in duration-200" 
                     x-transition:leave-start="opacity-100" 
                     x-transition:leave-end="opacity-0" 
                     class="fixed inset-0 transition-opacity" 
                     @click="openModal = false">
                    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm"></div>
                </div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

                <div x-show="openModal" 
                     x-transition:enter="ease-out duration-300" 
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
                     x-transition:leave="ease-in duration-200" 
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                     class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-xl sm:w-full border border-slate-100">
                    
                    <div class="px-6 py-4 border-b border-slate-50 flex justify-between items-center bg-slate-50/50">
                        <h3 class="text-lg font-black text-slate-800" x-text="mode === 'view' ? 'Client Details' : 'Edit Client Profile'"></h3>
                        <button @click="openModal = false" class="text-slate-400 hover:text-slate-600">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                        </button>
                    </div>

                    <form :action="`/clients/${client.id}`" method="POST" x-ref="editForm" @submit.prevent="submitForm">
                        @csrf
                        @method('PATCH')
                        
                        <div class="p-6 space-y-6">
                            <div>
                                <label class="text-xs font-bold text-slate-400 uppercase mb-1 block">Full Name</label>
                                <template x-if="mode === 'view'">
                                    <div class="p-3 bg-slate-50 rounded-xl text-slate-700 font-bold" x-text="client.name"></div>
                                </template>
                                <template x-if="mode === 'edit'">
                                    <input type="text" name="name" x-model="client.name" class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm font-bold">
                                </template>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="text-xs font-bold text-slate-400 uppercase mb-1 block">Email Address</label>
                                    <template x-if="mode === 'view'">
                                        <div class="p-3 bg-slate-50 rounded-xl text-slate-600" x-text="client.email"></div>
                                    </template>
                                    <template x-if="mode === 'edit'">
                                        <input type="email" name="email" x-model="client.email" class="w-full rounded-xl border-slate-200 focus:border-indigo-500">
                                    </template>
                                </div>
                                <div>
                                    <label class="text-xs font-bold text-slate-400 uppercase mb-1 block">Phone Number</label>
                                    <template x-if="mode === 'view'">
                                        <div class="p-3 bg-slate-50 rounded-xl text-slate-600" x-text="client.phone"></div>
                                    </template>
                                    <template x-if="mode === 'edit'">
                                        <input type="text" name="phone" x-model="client.phone" class="w-full rounded-xl border-slate-200 focus:border-indigo-500">
                                    </template>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <label class="text-xs font-bold text-slate-400 uppercase mb-1 block">Date of Birth</label>
                                    <template x-if="mode === 'view'">
                                        <div class="p-3 bg-slate-50 rounded-xl text-slate-600" x-text="client.dob || 'N/A'"></div>
                                    </template>
                                    <template x-if="mode === 'edit'">
                                        <input type="date" name="dob" x-model="client.dob" class="w-full rounded-xl border-slate-200 focus:border-indigo-500">
                                    </template>
                                </div>
                                <div>
                                    <label class="text-xs font-bold text-slate-400 uppercase mb-1 block">Gender</label>
                                    <template x-if="mode === 'view'">
                                        <div class="p-3 bg-slate-50 rounded-xl text-slate-600" x-text="client.gender || 'N/A'"></div>
                                    </template>
                                    <template x-if="mode === 'edit'">
                                        <select name="gender" x-model="client.gender" class="w-full rounded-xl border-slate-200 focus:border-indigo-500">
                                            <option value="">Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </template>
                                </div>
                                <div>
                                    <label class="text-xs font-bold text-slate-400 uppercase mb-1 block">Anniversary</label>
                                    <template x-if="mode === 'view'">
                                        <div class="p-3 bg-slate-50 rounded-xl text-slate-600" x-text="client.marriage_anniversary || 'N/A'"></div>
                                    </template>
                                    <template x-if="mode === 'edit'">
                                        <input type="date" name="marriage_anniversary" x-model="client.marriage_anniversary" class="w-full rounded-xl border-slate-200 focus:border-indigo-500">
                                    </template>
                                </div>
                            </div>

                            <div>
                                <label class="text-xs font-bold text-slate-400 uppercase mb-1 block">Primary Address</label>
                                <template x-if="mode === 'view'">
                                    <div class="p-4 bg-slate-50 rounded-xl text-slate-600 italic" x-text="client.address"></div>
                                </template>
                                <template x-if="mode === 'edit'">
                                    <textarea name="address" x-model="client.address" rows="3" class="w-full rounded-xl border-slate-200 focus:border-indigo-500"></textarea>
                                </template>
                            </div>
                        </div>

                        <div class="px-6 py-4 bg-slate-50/50 border-t border-slate-100 flex justify-end gap-3">
                            <button type="button" @click="openModal = false" class="text-sm font-bold text-slate-400 px-4 py-2">Cancel</button>
                            <template x-if="mode === 'view'">
                                <button type="button" @click="mode = 'edit'" class="premium-btn premium-btn-primary !px-8 flex items-center gap-2">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                    Edit Profile
                                </button>
                            </template>
                            <template x-if="mode === 'edit'">
                                <button type="submit" 
                                        :disabled="submitting"
                                        class="premium-btn premium-btn-primary !px-8 shadow-indigo-100 shadow-xl disabled:opacity-50 disabled:cursor-not-allowed">
                                    <span x-show="!submitting">Save Changes</span>
                                    <span x-show="submitting" class="flex items-center gap-2">
                                        <svg class="animate-spin h-4 w-4" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                        Saving...
                                    </span>
                                </button>
                            </template>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
