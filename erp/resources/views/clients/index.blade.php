<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-8">
            <h2 class="font-black text-3xl text-slate-900 uppercase tracking-tight dark:text-slate-100">
                CLIENTS
            </h2>

        </div>
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
            photo: '',
            policies: []
        },
        openView(c) {
            this.client = c;
            this.mode = 'view';
            this.openModal = true;
        },
        openEdit(c) {
            this.client = {...c};
            this.client.policies = c.policies ? JSON.parse(JSON.stringify(c.policies)) : [];
            if (this.client.policies.length === 0) {
                this.client.policies = [{ id: '', number: '', type: 'Life Insurance', premium: '', expiry: '', custom_type: '' }];
            }
            this.mode = 'edit';
            this.openModal = true;
        },
        addPolicy() {
            this.client.policies.push({ id: '', number: '', type: 'Life Insurance', premium: '', expiry: '', custom_type: '' });
        },
        removePolicy(index) {
            if (this.client.policies.length > 1) {
                this.client.policies.splice(index, 1);
            }
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
            <div class="flex items-center justify-between mb-10 px-2">
                <div>
                    <h2 class="text-3xl font-black text-slate-900 uppercase tracking-tight dark:text-white">Client
                        Directory</h2>
                    <p class="text-slate-400 dark:text-slate-500 text-[10px] font-bold uppercase tracking-widest mt-1">
                        Manage your policyholders and their comprehensive insurance portfolios.</p>
                </div>
                <div class="flex items-center gap-4">
                    <form action="{{ route('clients.index') }}" method="GET" class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-slate-400 group-focus-within:text-rose-500 transition-colors"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search clients..."
                            class="!pl-16 pr-4 py-2.5 text-xs rounded-xl border-slate-100 focus:border-rose-500 focus:ring-rose-500 bg-white shadow-sm w-64 transition-all uppercase font-bold text-slate-900 tracking-tight dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500">
                    </form>
                    <a href="{{ route('clients.create') }}"
                        class="inline-flex items-center gap-2 bg-rose-600 text-white px-6 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-lg shadow-rose-200 dark:shadow-none hover:bg-rose-500 transition-all">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Add New Client
                    </a>
                </div>
            </div>

            <div
                class="bg-white dark:bg-slate-900 rounded-[2.5rem] border border-slate-100 dark:border-slate-800 shadow-xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead
                            class="bg-slate-50/50 dark:bg-slate-800/50 border-b border-slate-100 dark:border-slate-700">
                            <tr>
                                <th
                                    class="px-8 py-5 text-[10px] font-black text-slate-900 dark:text-slate-100 uppercase tracking-[0.2em]">
                                    Client Name</th>
                                <th
                                    class="px-8 py-5 text-[10px] font-black text-slate-900 dark:text-slate-100 uppercase tracking-[0.2em]">
                                    Contact Details</th>
                                <th
                                    class="px-8 py-5 text-[10px] font-black text-slate-900 dark:text-slate-100 uppercase tracking-[0.2em]">
                                    DOB / Gender</th>
                                <th
                                    class="px-8 py-5 text-[10px] font-black text-slate-900 dark:text-slate-100 uppercase tracking-[0.2em]">
                                    Policies</th>
                                <th
                                    class="px-8 py-5 text-[10px] font-black text-slate-900 dark:text-slate-100 uppercase tracking-[0.2em] text-right">
                                    Action Hub</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50 dark:divide-slate-800">
                            @forelse($clients as $client)
                                                        <tr
                                                            class="hover:bg-slate-50/80 dark:hover:bg-slate-800/80 transition-all duration-300 group">
                                                            <td class="px-8 py-5">
                                                                <div class="flex items-center gap-4">
                                                                    <div
                                                                        class="h-10 w-10 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 p-0.5 shadow-sm border border-white/50 flex-shrink-0 group-hover:scale-110 transition-transform">
                                                                        <div
                                                                            class="h-full w-full rounded-[9px] bg-white dark:bg-slate-900 flex items-center justify-center overflow-hidden">
                                                                            @if($client->photo)
                                                                                <img class="h-full w-full object-cover"
                                                                                    src="{{ $client->photo_url }}" alt="">
                                                                            @else
                                                                                <span
                                                                                    class="text-indigo-600 dark:text-indigo-400 font-black text-xs uppercase">{{ substr($client->name, 0, 1) }}</span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div>
                                                                        <div
                                                                            class="text-[13px] font-black text-slate-900 dark:text-slate-100 uppercase">
                                                                            {{ $client->name }}</div>
                                                                        <div
                                                                            class="text-[9px] font-bold text-slate-400 group-hover:text-rose-500 transition-colors uppercase tracking-widest mt-0.5">
                                                                            REG-ID: NX-100{{ $client->id }}</div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="px-8 py-5">
                                                                <div class="text-[12px] font-bold text-slate-700 dark:text-slate-300">
                                                                    {{ $client->email ?: '—' }}</div>
                                                                <div
                                                                    class="text-[10px] font-medium text-slate-400 dark:text-slate-500 mt-0.5 tracking-tight">
                                                                    {{ $client->phone ?: '—' }}</div>
                                                            </td>
                                                            <td class="px-8 py-5">
                                                                <div class="text-xs font-bold text-slate-900 dark:text-slate-100">
                                                                    {{ $client->dob ? \Carbon\Carbon::parse($client->dob)->format('M d, Y') : '—' }}
                                                                </div>
                                                                @if($client->gender)
                                                                    <span
                                                                        class="inline-flex items-center px-2 py-0.5 rounded-full text-[9px] font-black tracking-widest mt-1.5 uppercase {{ $client->gender === 'Male' ? 'bg-indigo-50 text-indigo-600 dark:bg-indigo-900/30 dark:text-indigo-400' : 'bg-rose-50 text-rose-600 dark:bg-rose-900/30 dark:text-rose-400' }}">
                                                                        {{ $client->gender }}
                                                                    </span>
                                                                @endif
                                                            </td>
                                                            <td class="px-8 py-5">
                                                                @if($client->renewals->count() > 0)
                                                                    <div class="flex flex-wrap gap-1">
                                                                        @foreach($client->renewals->take(3) as $renewal)
                                                                            <span class="inline-flex items-center px-1.5 py-0.5 rounded bg-slate-100 dark:bg-slate-800 text-[9px] font-bold text-slate-600 dark:text-slate-400 border border-slate-200 dark:border-slate-700">
                                                                                {{ $renewal->policy_number }}
                                                                            </span>
                                                                        @endforeach
                                                                        @if($client->renewals->count() > 3)
                                                                            <span class="inline-flex items-center px-1.5 py-0.5 rounded bg-indigo-50 dark:bg-indigo-900/30 text-[9px] font-bold text-indigo-600 dark:text-indigo-400">
                                                                                +{{ $client->renewals->count() - 3 }} More
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                @else
                                                                    <span class="text-[10px] font-medium text-slate-400 italic uppercase tracking-widest">No Policies</span>
                                                                @endif
                                                            </td>
                                                            <td class="px-8 py-5 text-right">
                                                                <div
                                                                    class="flex items-center justify-end gap-4 opacity-40 group-hover:opacity-100 transition-opacity">
                                                                    <button @click='openView({{ json_encode([
                                    "id" => $client->id,
                                    "name" => $client->name,
                                    "email" => $client->email,
                                    "phone" => $client->phone,
                                    "address" => $client->address,
                                    "dob" => $client->dob,
                                    "gender" => $client->gender,
                                    "photo" => $client->photo ? Storage::url($client->photo) : null
                                ], JSON_HEX_APOS | JSON_HEX_QUOT) }})'
                                                                        class="p-2 hover:bg-indigo-50 dark:hover:bg-indigo-900/30 hover:text-indigo-600 dark:hover:text-indigo-400 rounded-xl transition-all"
                                                                        title="View">
                                                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                                        </svg>
                                                                    </button>
                                                                    <button @click='openEdit({{ json_encode([
                                    "id" => $client->id,
                                    "name" => $client->name,
                                    "email" => $client->email,
                                    "phone" => $client->phone,
                                    "address" => $client->address,
                                    "dob" => $client->dob,
                                    "gender" => $client->gender,
                                    "photo" => $client->photo ? Storage::url($client->photo) : null,
                                    "policies" => $client->renewals->map(fn($p) => [
                                        'id' => $p->id,
                                        'number' => $p->policy_number,
                                        'type' => in_array($p->policy_type, ['Life Insurance', 'Health Insurance', 'Motor Insurance', 'General Insurance']) ? $p->policy_type : 'Custom',
                                        'custom_type' => in_array($p->policy_type, ['Life Insurance', 'Health Insurance', 'Motor Insurance', 'General Insurance']) ? '' : $p->policy_type,
                                        'premium' => $p->premium_amount,
                                        'expiry' => $p->expiry_date
                                    ])
                                ], JSON_HEX_APOS | JSON_HEX_QUOT) }})'
                                                                        class="p-2 hover:bg-amber-50 dark:hover:bg-amber-900/30 hover:text-amber-600 dark:hover:text-amber-400 rounded-xl transition-all"
                                                                        title="Edit">
                                                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                                        </svg>
                                                                    </button>
                                                                    <form action="{{ route('clients.destroy', $client) }}" method="POST"
                                                                        class="inline">
                                                                        @csrf @method('DELETE')
                                                                        <button type="submit"
                                                                            class="p-2 hover:bg-rose-50 dark:hover:bg-rose-900/30 hover:text-rose-600 dark:hover:text-rose-400 rounded-xl transition-all"
                                                                            title="Delete" onclick="return confirm('Archive this client?')">
                                                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                                                                stroke="currentColor">
                                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                                    stroke-width="2"
                                                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                                            </svg>
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </td>
                                                        </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-8 py-20 text-center text-gray-500 dark:text-slate-400">
                                        <div class="flex flex-col items-center">
                                            <svg class="h-12 w-12 text-slate-200 dark:text-slate-800 mb-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                            </svg>
                                            <p class="text-[10px] font-black uppercase tracking-widest">No clients found in
                                                the infrastructure.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($clients->hasPages())
                    <div
                        class="bg-slate-50/50 dark:bg-slate-800/50 px-8 py-5 border-t border-slate-100 dark:border-slate-700">
                        {{ $clients->links() }}
                    </div>
                @endif
            </div>
        </div>

        <!-- Inline Modal Container -->
        <div x-show="openModal" class="fixed inset-0 z-50 overflow-y-auto" x-cloak>
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="openModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                    class="fixed inset-0 transition-opacity" @click="openModal = false">
                    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm"></div>
                </div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

                <div x-show="openModal" x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="inline-block align-bottom bg-white dark:bg-slate-900 rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-xl sm:w-full border border-slate-100 dark:border-slate-800">

                    <div
                        class="px-6 py-4 border-b border-slate-50 dark:border-slate-800 flex justify-between items-center bg-slate-50/50 dark:bg-slate-800/50">
                        <h3 class="text-lg font-black text-slate-800 dark:text-slate-200"
                            x-text="mode === 'view' ? 'Client Details' : 'Edit Client Profile'"></h3>
                        <button @click="openModal = false" class="text-slate-400 hover:text-slate-600">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <form :action="`/clients/${client.id}`" method="POST" x-ref="editForm" @submit.prevent="submitForm"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="p-6 space-y-6">
                            <!-- Photo Section in Modal -->
                            <div
                                class="flex items-center gap-6 bg-slate-50 dark:bg-slate-800/50 p-4 rounded-2xl border border-slate-100 dark:border-slate-700">
                                <div class="relative group">
                                    <div
                                        class="h-20 w-20 rounded-2xl bg-white dark:bg-slate-900 p-1 shadow-sm overflow-hidden border border-slate-100 dark:border-slate-800">
                                        <div id="modal-photo-preview"
                                            class="h-full w-full flex items-center justify-center bg-slate-50 text-slate-300 dark:bg-slate-800/50">
                                            <template x-if="client.photo">
                                                <img :src="client.photo" class="h-full w-full object-cover">
                                            </template>
                                            <template x-if="!client.photo">
                                                <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                            </template>
                                        </div>
                                    </div>
                                    <template x-if="mode === 'edit'">
                                        <label for="modal-photo"
                                            class="absolute -bottom-1 -right-1 h-7 w-7 bg-white dark:bg-slate-800 shadow-lg rounded-lg flex items-center justify-center text-slate-600 dark:text-slate-300 hover:text-indigo-600 dark:hover:text-amber-400 cursor-pointer border border-slate-100 dark:border-slate-700 transition-transform hover:scale-110">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                            <input type="file" id="modal-photo" name="photo"
                                                class="hidden dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500"
                                                accept="image/*" @change="
                                                const file = $event.target.files[0];
                                                if (file) {
                                                    const reader = new FileReader();
                                                    reader.onload = (e) => { client.photo = e.target.result; };
                                                    reader.readAsDataURL(file);
                                                }
                                            ">
                                        </label>
                                    </template>
                                </div>
                                <div>
                                    <h4 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-1">Profile
                                        Photo</h4>
                                    <p class="text-[10px] text-slate-500 font-medium dark:text-slate-400"
                                        x-text="mode === 'view' ? 'Current client identification' : 'Upload or change photo'">
                                    </p>
                                </div>
                            </div>

                            <div>
                                <label class="text-xs font-bold text-slate-400 uppercase mb-1 block">Full Name</label>
                                <template x-if="mode === 'view'">
                                    <div class="p-3 bg-slate-50 rounded-xl text-slate-700 font-bold dark:bg-slate-800/50"
                                        x-text="client.name"></div>
                                </template>
                                <template x-if="mode === 'edit'">
                                    <input type="text" name="name" x-model="client.name"
                                        class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm font-bold dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500">
                                </template>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="text-xs font-bold text-slate-400 uppercase mb-1 block">Email
                                        Address</label>
                                    <template x-if="mode === 'view'">
                                        <div class="p-3 bg-slate-50 rounded-xl text-slate-600 dark:text-slate-300 dark:bg-slate-800/50"
                                            x-text="client.email"></div>
                                    </template>
                                    <template x-if="mode === 'edit'">
                                        <input type="email" name="email" x-model="client.email"
                                            class="w-full rounded-xl border-slate-200 focus:border-indigo-500 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500">
                                    </template>
                                </div>
                                <div>
                                    <label class="text-xs font-bold text-slate-400 uppercase mb-1 block">Phone
                                        Number</label>
                                    <template x-if="mode === 'view'">
                                        <div class="p-3 bg-slate-50 rounded-xl text-slate-600 dark:text-slate-300 dark:bg-slate-800/50"
                                            x-text="client.phone"></div>
                                    </template>
                                    <template x-if="mode === 'edit'">
                                        <input type="text" name="phone" x-model="client.phone"
                                            class="w-full rounded-xl border-slate-200 focus:border-indigo-500 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500">
                                    </template>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <label class="text-xs font-bold text-slate-400 uppercase mb-1 block">Date of
                                        Birth</label>
                                    <template x-if="mode === 'view'">
                                        <div class="p-3 bg-slate-50 rounded-xl text-slate-600 dark:text-slate-300 dark:bg-slate-800/50"
                                            x-text="client.dob || 'N/A'"></div>
                                    </template>
                                    <template x-if="mode === 'edit'">
                                        <input type="date" name="dob" x-model="client.dob"
                                            class="w-full rounded-xl border-slate-200 focus:border-indigo-500 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500">
                                    </template>
                                </div>
                                <div>
                                    <label class="text-xs font-bold text-slate-400 uppercase mb-1 block">Gender</label>
                                    <template x-if="mode === 'view'">
                                        <div class="p-3 bg-slate-50 rounded-xl text-slate-600 dark:text-slate-300 dark:bg-slate-800/50"
                                            x-text="client.gender || 'N/A'"></div>
                                    </template>
                                    <template x-if="mode === 'edit'">
                                        <select name="gender" x-model="client.gender"
                                            class="w-full rounded-xl border-slate-200 focus:border-indigo-500 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500">
                                            <option value="">Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </template>
                                </div>
                            </div>

                            <div>
                                <label class="text-xs font-bold text-slate-400 uppercase mb-1 block">Primary
                                    Address</label>
                                <template x-if="mode === 'view'">
                                    <div class="p-4 bg-slate-50 rounded-xl text-slate-600 italic dark:text-slate-300 dark:bg-slate-800/50"
                                        x-text="client.address"></div>
                                </template>
                                <template x-if="mode === 'edit'">
                                    <textarea name="address" x-model="client.address" rows="3"
                                        class="w-full rounded-xl border-slate-200 focus:border-indigo-500 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500"></textarea>
                                </template>
                            </div>

                            <!-- Modal Portfolio Section -->
                            <template x-if="mode === 'view'">
                                <div class="space-y-4 pt-6 border-t border-slate-100 dark:border-slate-800">
                                    <h4 class="text-xs font-black text-slate-400 uppercase tracking-widest">Active Portfolio</h4>
                                    <div class="grid grid-cols-1 gap-3">
                                        <template x-for="policy in client.policies" :key="policy.id">
                                            <div class="p-3 bg-slate-50 dark:bg-slate-800/50 rounded-xl border border-slate-100 dark:border-slate-700 flex justify-between items-center">
                                                <div>
                                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Policy #</p>
                                                    <p class="text-sm font-bold text-slate-700 dark:text-slate-200" x-text="policy.number"></p>
                                                </div>
                                                <div class="text-right">
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[8px] font-black tracking-widest uppercase bg-indigo-50 text-indigo-600 dark:bg-indigo-900/30 dark:text-indigo-400" x-text="policy.type === 'Custom' ? policy.custom_type : policy.type"></span>
                                                    <p class="text-[10px] font-bold text-slate-400 mt-1" x-text="'₹' + Number(policy.premium).toLocaleString()"></p>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </template>

                            <template x-if="mode === 'edit'">
                                <div class="space-y-6 pt-6 border-t border-slate-100 dark:border-slate-800">
                                    <div class="flex items-center justify-between">
                                        <h4 class="text-xs font-black text-slate-400 uppercase tracking-widest">Insurance Portfolio</h4>
                                        <button type="button" @click="addPolicy()" class="text-[10px] font-black text-indigo-500 uppercase tracking-widest hover:text-indigo-600 transition-colors">
                                            + Add Policy
                                        </button>
                                    </div>
                                    <div class="space-y-4">
                                        <template x-for="(policy, index) in client.policies" :key="index">
                                            <div class="p-4 bg-slate-50 dark:bg-slate-800/50 rounded-2xl border border-slate-100 dark:border-slate-700 relative">
                                                <button type="button" @click="removePolicy(index)" x-show="client.policies.length > 1" class="absolute top-2 right-2 text-slate-300 hover:text-rose-500">
                                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                                </button>
                                                <input type="hidden" :name="`policies[${index}][id]`" x-model="policy.id">
                                                <div class="grid grid-cols-2 gap-4">
                                                    <div>
                                                        <label class="text-[9px] font-black text-slate-400 uppercase mb-1 block">Policy #</label>
                                                        <input type="text" :name="`policies[${index}][policy_number]`" x-model="policy.number" class="w-full text-xs rounded-lg border-slate-200 dark:bg-slate-900 dark:border-slate-700" required>
                                                    </div>
                                                    <div>
                                                        <label class="text-[9px] font-black text-slate-400 uppercase mb-1 block">Type</label>
                                                        <select :name="`policies[${index}][policy_type]`" x-model="policy.type" class="w-full text-xs rounded-lg border-slate-200 dark:bg-slate-900 dark:border-slate-700">
                                                            <option value="Life Insurance">Life</option>
                                                            <option value="Health Insurance">Health</option>
                                                            <option value="Motor Insurance">Motor</option>
                                                            <option value="General Insurance">General</option>
                                                            <option value="Custom">Custom</option>
                                                        </select>
                                                    </div>
                                                    <div x-show="policy.type === 'Custom'" class="col-span-2">
                                                        <input type="text" :name="`policies[${index}][custom_type]`" x-model="policy.custom_type" class="w-full text-xs rounded-lg border-slate-200 dark:bg-slate-900 dark:border-slate-700" placeholder="Custom Type Name">
                                                    </div>
                                                    <div>
                                                        <label class="text-[9px] font-black text-slate-400 uppercase mb-1 block">Premium</label>
                                                        <input type="number" step="0.01" :name="`policies[${index}][premium_amount]`" x-model="policy.premium" class="w-full text-xs rounded-lg border-slate-200 dark:bg-slate-900 dark:border-slate-700" required>
                                                    </div>
                                                    <div>
                                                        <label class="text-[9px] font-black text-slate-400 uppercase mb-1 block">Expiry</label>
                                                        <input type="date" :name="`policies[${index}][expiry_date]`" x-model="policy.expiry" class="w-full text-xs rounded-lg border-slate-200 dark:bg-slate-900 dark:border-slate-700" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </template>
                        </div>

                        <div
                            class="px-6 py-4 bg-slate-50/50 dark:bg-slate-800/50 border-t border-slate-100 dark:border-slate-800 flex justify-end gap-3">
                            <button type="button" @click="openModal = false"
                                class="text-sm font-bold text-slate-400 dark:text-slate-500 hover:text-slate-600 dark:hover:text-slate-300 px-4 py-2">Cancel</button>
                            <template x-if="mode === 'view'">
                                <button type="button" @click="mode = 'edit'"
                                    class="premium-btn premium-btn-primary !px-8 flex items-center gap-2">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Edit Profile
                                </button>
                            </template>
                            <template x-if="mode === 'edit'">
                                <button type="submit" :disabled="submitting"
                                    class="premium-btn premium-btn-primary !px-8 disabled:opacity-50 disabled:cursor-not-allowed">
                                    <span x-show="!submitting">Save Changes</span>
                                    <span x-show="submitting" class="flex items-center gap-2">
                                        <svg class="animate-spin h-4 w-4" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                                stroke-width="4" fill="none"></circle>
                                            <path class="opacity-75" fill="currentColor"
                                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                            </path>
                                        </svg>
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