<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-slate-900 uppercase tracking-tight">
            {{ __('Client Queries') }}
        </h2>
    </x-slot>

    <div class="py-6" x-data="{ 
        openModal: false, 
        mode: 'view', 
        submitting: false,
        query: {
            id: '',
            subject: '',
            description: '',
            priority: '',
            status: '',
            client_name: '',
            client_id: '',
            document: '',
            created_at: ''
        },
        init() {
            const urlParams = new URLSearchParams(window.location.search);
            const id = urlParams.get('id');
            if (id) {
                this.$nextTick(() => {
                    const buttons = document.querySelectorAll('button[data-query]');
                    for (const btn of buttons) {
                        try {
                            const data = JSON.parse(btn.dataset.query);
                            if (String(data.id) === String(id)) {
                                this.openInquiry(data, 'view');
                                window.history.replaceState({}, document.title, window.location.pathname);
                                break;
                            }
                        } catch(e) {}
                    }
                });
            }
        },
        openInquiry(queryObj, mode) {
            this.query = Object.assign({}, queryObj);
            this.mode = mode;
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
                    <h2 class="text-3xl font-extrabold text-gray-900">Service Queries</h2>
                    <p class="text-gray-500 mt-1">Track and respond to client inquiries and support requests.</p>
                </div>
                <div class="flex items-center gap-3">
                    @if(request('search'))
                        <a href="{{ route('queries.index') }}" class="text-sm font-bold text-rose-600 hover:text-rose-800 flex items-center gap-1 bg-rose-50 px-3 py-2 rounded-xl transition-colors">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                            Clear Filters
                        </a>
                    @endif
                    <form action="{{ route('queries.index') }}" method="GET" class="relative group">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search queries..." class="pl-10 pr-4 py-2.5 rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white shadow-sm w-64 transition-all">
                        <svg class="h-5 w-5 absolute left-3 top-3 text-slate-400 group-focus-within:text-indigo-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                    </form>
                    <a href="{{ route('queries.create') }}" class="premium-btn premium-btn-primary flex items-center gap-2 shadow-lg shadow-indigo-100">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                        New Query Request
                    </a>
                </div>
            </div>

            <!-- Query Analytics Grid -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="premium-card !p-5 border-none bg-white shadow-md">
                    <div class="flex items-center justify-between mb-3">
                        <div class="p-2 bg-indigo-50 rounded-lg text-indigo-600">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                        </div>
                        <span class="text-xs font-bold text-slate-400">TOTAL</span>
                    </div>
                    <div class="text-2xl font-black text-slate-900">{{ $stats['total'] }}</div>
                    <div class="text-xs font-bold text-slate-500 mt-1 uppercase">Total Queries</div>
                </div>

                <div class="premium-card !p-5 border-none bg-white shadow-md">
                    <div class="flex items-center justify-between mb-3">
                        <div class="p-2 bg-emerald-50 rounded-lg text-emerald-600">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <span class="text-xs font-bold text-emerald-600">SAFE</span>
                    </div>
                    <div class="text-2xl font-black text-emerald-600">{{ $stats['approved'] }}</div>
                    <div class="text-xs font-bold text-slate-500 mt-1 uppercase">Approved</div>
                </div>

                <div class="premium-card !p-5 border-none bg-white shadow-md">
                    <div class="flex items-center justify-between mb-3">
                        <div class="p-2 bg-amber-50 rounded-lg text-amber-600">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <span class="text-xs font-bold text-amber-600">WAITING</span>
                    </div>
                    <div class="text-2xl font-black text-amber-600">{{ $stats['pending'] }}</div>
                    <div class="text-xs font-bold text-slate-500 mt-1 uppercase">Pending</div>
                </div>

                <div class="premium-card !p-5 border-none bg-white shadow-md">
                    <div class="flex items-center justify-between mb-3">
                        <div class="p-2 bg-rose-50 rounded-lg text-rose-600">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <span class="text-xs font-bold text-rose-600">DENIED</span>
                    </div>
                    <div class="text-2xl font-black text-rose-600">{{ $stats['rejected'] }}</div>
                    <div class="text-xs font-bold text-slate-500 mt-1 uppercase">Rejected</div>
                </div>
            </div>

            <div class="premium-card overflow-hidden !p-0 border-none shadow-xl">
                <div class="overflow-x-auto">
                    <table class="premium-table">
                        <thead>
                            <tr>
                                <th class="text-left">Client / Subject</th>
                                <th class="text-left">Priority</th>
                                <th class="text-left">Status</th>
                                <th class="text-left">Received</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($queries as $query)
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-gray-900">{{ $query->subject }}</div>
                                        <div class="text-xs text-indigo-600 mt-0.5">{{ $query->client->name ?? 'Direct Inquiry' }}</div>
                                        @if($query->document)
                                            <a href="{{ asset('storage/' . $query->document) }}" target="_blank" class="inline-flex items-center gap-1 text-[10px] bg-slate-100 text-slate-600 px-2 py-0.5 rounded-md mt-2 hover:bg-slate-200 transition-colors">
                                                <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" /></svg>
                                                View Attachment
                                            </a>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold {{ $query->priority == 'high' ? 'bg-rose-100 text-rose-700' : ($query->priority == 'medium' ? 'bg-amber-100 text-amber-700' : 'bg-slate-100 text-slate-700') }}">
                                            {{ ucfirst($query->priority) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="badge {{ $query->status == 'approved' ? 'badge-success' : ($query->status == 'rejected' ? 'badge-danger' : 'badge-warning') }}">
                                            {{ ucfirst($query->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        {{ $query->created_at->format('M d, Y') }}
                                        <div class="text-xs text-gray-400 italic mt-0.5">{{ $query->created_at->diffForHumans() }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-3 text-sm font-bold uppercase tracking-wider">
                                            <button 
                                                data-query='{{ json_encode([
                                                    "id" => $query->id,
                                                    "subject" => $query->subject,
                                                    "description" => $query->description,
                                                    "priority" => $query->priority,
                                                    "status" => $query->status,
                                                    "client_name" => $query->client->name ?? "Direct Inquiry",
                                                    "client_id" => $query->client_id,
                                                    "document" => $query->document ? asset("storage/" . $query->document) : "",
                                                    "created_at" => $query->created_at->format("M d, Y")
                                                ]) }}'
                                                @click="openInquiry(JSON.parse($el.dataset.query), 'view')" 
                                                class="text-indigo-600 hover:text-indigo-900 flex items-center gap-1 transition-transform hover:scale-105">
                                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                                View
                                            </button>
                                            <button 
                                                data-query='{{ json_encode([
                                                    "id" => $query->id,
                                                    "subject" => $query->subject,
                                                    "description" => $query->description,
                                                    "priority" => $query->priority,
                                                    "status" => $query->status,
                                                    "client_name" => $query->client->name ?? "Direct Inquiry",
                                                    "client_id" => $query->client_id,
                                                    "document" => $query->document ? asset("storage/" . $query->document) : "",
                                                    "created_at" => $query->created_at->format("M d, Y")
                                                ]) }}'
                                                @click="openInquiry(JSON.parse($el.dataset.query), 'edit')" 
                                                class="text-amber-600 hover:text-amber-900 flex items-center gap-1 transition-transform hover:scale-105">
                                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                                Edit
                                            </button>
                                            <form action="{{ route('queries.destroy', $query) }}" method="POST" class="inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-rose-600 hover:text-rose-900 flex items-center gap-1" onclick="return confirm('Archive query?')">
                                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                        <div class="flex flex-col items-center">
                                            <svg class="h-12 w-12 text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" /></svg>
                                            <p>No active queries found. Everything is calm!</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($queries->hasPages())
                    <div class="bg-gray-50 px-6 py-4 border-t border-gray-100">
                        {{ $queries->links() }}
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
                     class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full border border-slate-100">
                    
                    <div class="px-6 py-4 border-b border-slate-50 flex justify-between items-center bg-slate-50/50">
                        <h3 class="text-lg font-black text-slate-800" x-text="mode === 'view' ? 'Query Details' : 'Edit Inquiry'"></h3>
                        <button @click="openModal = false" class="text-slate-400 hover:text-slate-600 transition-colors">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                        </button>
                    </div>

                    <form :action="`/queries/${query.id}`" method="POST" enctype="multipart/form-data" 
                          x-ref="editForm" @submit.prevent="submitForm">
                        @csrf
                        @method('PATCH')
                        
                        <div class="p-6 space-y-6">
                            <!-- Field: Client & Subject -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="text-xs font-bold text-slate-400 uppercase mb-1 block">Client</label>
                                    <div class="p-3 bg-slate-50 rounded-xl text-slate-700 font-bold" x-text="query.client_name"></div>
                                    <input type="hidden" name="client_id" :value="query.client_id">
                                </div>
                                <div>
                                    <label class="text-xs font-bold text-slate-400 uppercase mb-1 block">Subject</label>
                                    <template x-if="mode === 'view'">
                                        <div class="p-3 bg-slate-50 rounded-xl text-slate-700 font-bold" x-text="query.subject"></div>
                                    </template>
                                    <template x-if="mode === 'edit'">
                                        <input type="text" name="subject" x-model="query.subject" class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
                                    </template>
                                </div>
                            </div>

                            <!-- Field: Description -->
                            <div>
                                <label class="text-xs font-bold text-slate-400 uppercase mb-1 block">Detailed Description</label>
                                <template x-if="mode === 'view'">
                                    <div class="p-4 bg-slate-50 rounded-xl text-slate-600 leading-relaxed min-h-[100px]" x-text="query.description"></div>
                                </template>
                                <template x-if="mode === 'edit'">
                                    <textarea name="description" x-model="query.description" rows="4" class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm"></textarea>
                                </template>
                            </div>

                            <!-- Field: Priority & Status -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="text-xs font-bold text-slate-400 uppercase mb-1 block">Priority</label>
                                    <template x-if="mode === 'view'">
                                        <div class="flex items-center gap-2 font-bold" :class="query.priority === 'high' ? 'text-rose-600' : 'text-slate-700'">
                                            <div class="h-2 w-2 rounded-full" :class="query.priority === 'high' ? 'bg-rose-600' : 'bg-slate-400'"></div>
                                            <span x-text="query.priority.charAt(0).toUpperCase() + query.priority.slice(1)"></span>
                                        </div>
                                    </template>
                                    <template x-if="mode === 'edit'">
                                        <select name="priority" x-model="query.priority" class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
                                            <option value="low">Low Priority</option>
                                            <option value="medium">Medium Priority</option>
                                            <option value="high">High Priority</option>
                                        </select>
                                    </template>
                                </div>
                                <div>
                                    <label class="text-xs font-bold text-slate-400 uppercase mb-1 block">Current Status</label>
                                    <template x-if="mode === 'view'">
                                        <div class="p-2 border border-slate-100 rounded-lg inline-block text-xs font-black uppercase tracking-widest text-indigo-600" x-text="query.status"></div>
                                    </template>
                                    <template x-if="mode === 'edit'">
                                        <select name="status" x-model="query.status" class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
                                            <option value="pending">Pending</option>
                                            <option value="approved">Approved</option>
                                            <option value="rejected">Rejected</option>
                                        </select>
                                    </template>
                                </div>
                            </div>

                            <!-- Field: Document -->
                            <template x-if="query.document">
                                <div class="p-3 bg-indigo-50/50 border border-indigo-100 rounded-xl flex items-center justify-between">
                                    <div class="flex items-center gap-2 text-indigo-700">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" /></svg>
                                        <span class="text-sm font-bold">Supporting Document Attached</span>
                                    </div>
                                    <a :href="query.document" target="_blank" class="text-xs font-black uppercase text-indigo-600 hover:text-indigo-800 underline decoration-2 underline-offset-4">View File</a>
                                </div>
                            </template>
                        </div>

                        <div class="px-6 py-4 bg-slate-50/50 border-t border-slate-100 flex justify-end gap-3">
                            <button type="button" @click="openModal = false" class="text-sm font-bold text-slate-400 hover:text-slate-600 px-4 py-2 transition-colors">Cancel</button>
                            <template x-if="mode === 'view'">
                                <button type="button" @click="mode = 'edit'" class="premium-btn premium-btn-primary !px-8 flex items-center gap-2">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                    Modify Inquiry
                                </button>
                            </template>
                            <template x-if="mode === 'edit'">
                                <button type="submit" 
                                        :disabled="submitting"
                                        class="premium-btn premium-btn-primary !px-8 shadow-indigo-100 shadow-xl disabled:opacity-50 disabled:cursor-not-allowed">
                                    <span x-show="!submitting">Update Details</span>
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
