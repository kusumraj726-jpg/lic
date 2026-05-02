<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-8">
            <h2 class="font-black text-3xl text-slate-900 uppercase tracking-tight dark:text-slate-100">
                QUERIES
            </h2>
            
        </div>
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
            <div class="flex items-center justify-between mb-10 px-2">
                <div>
                    <h2 class="text-3xl font-black text-slate-900 uppercase tracking-tight dark:text-white">Service Queries</h2>
                    <p class="text-slate-400 dark:text-slate-500 text-[10px] font-bold uppercase tracking-widest mt-1">Track and respond to client inquiries and support requests.</p>
                </div>
                <div class="flex items-center gap-4">
                    @if(request('search'))
                        <a href="{{ route('queries.index') }}" class="text-[10px] font-black text-rose-600 hover:text-rose-800 flex items-center gap-1 bg-rose-50 dark:bg-rose-900/30 px-3 py-2.5 rounded-xl transition-colors uppercase tracking-widest">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                            Clear
                        </a>
                    @endif
                    <form action="{{ route('queries.index') }}" method="GET" class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-slate-400 group-focus-within:text-indigo-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search queries..." class="!pl-16 pr-4 py-2.5 text-xs rounded-xl border-slate-100 dark:border-slate-700 focus:border-indigo-500 focus:ring-indigo-500 bg-white dark:bg-slate-800 dark:text-slate-100 dark:placeholder-slate-500 shadow-sm w-64 transition-all uppercase font-bold tracking-tight">
                    </form>
                    <a href="{{ route('queries.create') }}" class="inline-flex items-center gap-2 bg-indigo-600 text-white px-6 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-lg shadow-indigo-200 dark:shadow-none hover:bg-indigo-500 transition-all">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                        New Inquiry
                    </a>
                </div>
            </div>

            <!-- Query Analytics Grid -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                @foreach([
                    ['label' => 'TOTAL', 'sub' => 'Total Queries', 'val' => $stats['total'], 'color' => 'indigo', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2'],
                    ['label' => 'SAFE', 'sub' => 'Approved', 'val' => $stats['approved'], 'color' => 'emerald', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                    ['label' => 'WAITING', 'sub' => 'Pending', 'val' => $stats['pending'], 'color' => 'amber', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                    ['label' => 'DENIED', 'sub' => 'Rejected', 'val' => $stats['rejected'], 'color' => 'rose', 'icon' => 'M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z']
                ] as $s)
                    <div class="bg-white dark:bg-slate-800 rounded-2xl border border-slate-100 dark:border-slate-700 shadow-sm p-5 relative overflow-hidden group hover:shadow-md transition-all duration-300">
                        <div class="flex items-center justify-between mb-3">
                            <div class="p-2 rounded-lg bg-{{ $s['color'] }}-50 dark:bg-{{ $s['color'] }}-900/30 text-{{ $s['color'] }}-600 dark:text-{{ $s['color'] }}-400">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $s['icon'] }}" /></svg>
                            </div>
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ $s['label'] }}</span>
                        </div>
                        <div class="text-2xl font-black text-slate-900 dark:text-slate-100">{{ $s['val'] }}</div>
                        <div class="text-[10px] font-bold text-slate-500 mt-1 uppercase tracking-tight">{{ $s['sub'] }}</div>
                    </div>
                @endforeach
            </div>

            <div class="bg-white dark:bg-slate-900 rounded-[2.5rem] border border-slate-100 dark:border-slate-800 shadow-xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-slate-50/50 dark:bg-slate-800/50 border-b border-slate-100 dark:border-slate-700">
                            <tr>
                                <th class="px-8 py-5 text-[10px] font-black text-slate-900 dark:text-slate-100 uppercase tracking-[0.2em]">Client / Subject</th>
                                <th class="px-8 py-5 text-[10px] font-black text-slate-900 dark:text-slate-100 uppercase tracking-[0.2em]">Priority</th>
                                <th class="px-8 py-5 text-[10px] font-black text-slate-900 dark:text-slate-100 uppercase tracking-[0.2em]">Status</th>
                                <th class="px-8 py-5 text-[10px] font-black text-slate-900 dark:text-slate-100 uppercase tracking-[0.2em]">Received</th>
                                <th class="px-8 py-5 text-[10px] font-black text-slate-900 dark:text-slate-100 uppercase tracking-[0.2em] text-right">Action Hub</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50 dark:divide-slate-800">
                            @forelse($queries as $query)
                                <tr class="hover:bg-slate-50/80 dark:hover:bg-slate-800/80 transition-all duration-300 group">
                                    <td class="px-8 py-6">
                                        <div class="font-black text-slate-900 dark:text-slate-100 uppercase text-[13px]">{{ $query->subject }}</div>
                                        <div class="text-[10px] font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-widest mt-0.5">{{ $query->client->name ?? 'Direct Inquiry' }}</div>
                                        @if($query->document)
                                            <a href="{{ $query->document_url }}" target="_blank" class="inline-flex items-center gap-1.5 text-[9px] bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 px-2.5 py-1 rounded-md mt-2 font-bold uppercase transition-colors hover:bg-indigo-50 dark:hover:bg-indigo-900/30 hover:text-indigo-600 dark:hover:text-indigo-400 cursor-pointer">
                                                <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" /></svg>
                                                Supporting Doc
                                            </a>
                                        @endif
                                    </td>
                                    <td class="px-8 py-6">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[9px] font-black uppercase tracking-widest {{ $query->priority == 'high' ? 'bg-rose-100 text-rose-700 dark:bg-rose-900/30 dark:text-rose-400' : ($query->priority == 'medium' ? 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400' : 'bg-slate-100 text-slate-700 dark:bg-slate-700 dark:text-slate-300') }}">
                                            {{ $query->priority }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="flex items-center gap-2">
                                            <div class="h-2 w-2 rounded-full {{ $query->status == 'approved' ? 'bg-emerald-500' : ($query->status == 'rejected' ? 'bg-rose-500' : 'bg-amber-500') }}"></div>
                                            <span class="text-[10px] font-black uppercase tracking-widest {{ $query->status == 'approved' ? 'text-emerald-700 dark:text-emerald-400' : ($query->status == 'rejected' ? 'text-rose-700 dark:text-rose-400' : 'text-amber-700 dark:text-amber-400') }}">
                                                {{ $query->status }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="text-[11px] font-black text-slate-900 dark:text-slate-100">{{ $query->created_at->format('M d, Y') }}</div>
                                        <div class="text-[9px] font-bold text-slate-400 dark:text-slate-500 mt-0.5 uppercase">{{ $query->created_at->diffForHumans() }}</div>
                                    </td>
                                    <td class="px-8 py-6 text-right">
                                        <div class="flex items-center justify-end gap-3 text-xs font-black uppercase tracking-widest">
                                            <button 
                                                data-query='{{ json_encode([
                                                    "id" => $query->id,
                                                    "subject" => $query->subject,
                                                    "description" => $query->description,
                                                    "priority" => $query->priority,
                                                    "status" => $query->status,
                                                    "client_name" => $query->client->name ?? "Direct Inquiry",
                                                    "client_id" => $query->client_id,
                                                    "document" => $query->document_url ?? "",
                                                    "created_at" => $query->created_at->format("M d, Y")
                                                ]) }}'
                                                @click="openInquiry(JSON.parse($el.dataset.query), 'view')" 
                                                class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300 flex items-center gap-1.5 transition-transform hover:scale-105">View</button>
                                            <span class="text-slate-200 dark:text-slate-700">|</span>
                                            <button 
                                                data-query='{{ json_encode([
                                                    "id" => $query->id,
                                                    "subject" => $query->subject,
                                                    "description" => $query->description,
                                                    "priority" => $query->priority,
                                                    "status" => $query->status,
                                                    "client_name" => $query->client->name ?? "Direct Inquiry",
                                                    "client_id" => $query->client_id,
                                                    "document" => $query->document_url ?? "",
                                                    "created_at" => $query->created_at->format("M d, Y")
                                                ]) }}'
                                                @click="openInquiry(JSON.parse($el.dataset.query), 'edit')" 
                                                class="text-amber-600 dark:text-amber-400 hover:text-amber-900 dark:hover:text-amber-300 flex items-center gap-1.5 transition-transform hover:scale-105">Edit</button>
                                            @if($query->client && $query->client->phone)
                                                <span class="text-slate-200 dark:text-slate-700">|</span>
                                                @php
                                                    $waPhone = preg_replace('/[^0-9]/', '', $query->client->phone);
                                                    if (strlen($waPhone) === 10) { $waPhone = "91" . $waPhone; }
                                                    $waMessage = "Hello " . $query->client->name . ",\n\n" .
                                                                "Regarding your query: " . $query->subject . "\n" .
                                                                "Status: " . strtoupper($query->status) . "\n" .
                                                                "Description: " . $query->description . "\n\n" .
                                                                "Thank you!";
                                                    $waUrl = "https://wa.me/" . $waPhone . "?text=" . urlencode($waMessage);
                                                @endphp
                                                <a href="{{ $waUrl }}" target="_blank" class="text-emerald-600 dark:text-emerald-400 hover:text-emerald-900 dark:hover:text-emerald-300 flex items-center gap-1.5 transition-transform hover:scale-105">WhatsApp</a>
                                            @endif
                                            <span class="text-slate-200 dark:text-slate-700">|</span>
                                            <form action="{{ route('queries.destroy', $query) }}" method="POST" class="inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-rose-600 dark:text-rose-400 hover:text-rose-900 dark:hover:text-rose-300 flex items-center gap-1.5 transition-transform hover:scale-105" onclick="return confirm('Delete this query?')">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-8 py-20 text-center text-gray-500 dark:text-slate-500">
                                        <div class="flex flex-col items-center">
                                            <svg class="h-12 w-12 text-slate-200 dark:text-slate-800 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" /></svg>
                                            <p class="text-[10px] font-black uppercase tracking-widest">No active queries found. Everything is calm!</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($queries->hasPages())
                    <div class="bg-slate-50/50 dark:bg-slate-800/50 px-8 py-5 border-t border-slate-100 dark:border-slate-700">
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
                     class="inline-block align-bottom bg-white dark:bg-slate-800 rounded-2xl text-left overflow-hidden shadow-2xl dark:shadow-black/60 transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full border border-slate-100 dark:border-slate-700/60">
                    
                    <div class="px-6 py-4 border-b border-slate-50 dark:border-slate-700/50 flex justify-between items-center bg-slate-50/50 dark:bg-slate-700/20">
                        <h3 class="text-lg font-black text-slate-800 dark:text-slate-100" x-text="mode === 'view' ? 'Query Details' : 'Edit Inquiry'"></h3>
                        <button @click="openModal = false" class="text-slate-400 dark:text-slate-500 hover:text-slate-600 dark:hover:text-slate-300 transition-colors">
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
                                    <label class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase mb-1 block">Client</label>
                                    <div class="p-3 bg-slate-50 dark:bg-slate-700/40 rounded-xl text-slate-700 dark:text-slate-200 font-bold" x-text="query.client_name"></div>
                                    <input type="hidden" name="client_id" :value="query.client_id">
                                </div>
                                <div>
                                    <label class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase mb-1 block">Subject</label>
                                    <template x-if="mode === 'view'">
                                        <div class="p-3 bg-slate-50 dark:bg-slate-700/40 rounded-xl text-slate-700 dark:text-slate-200 font-bold" x-text="query.subject"></div>
                                    </template>
                                    <template x-if="mode === 'edit'">
                                        <input type="text" name="subject" x-model="query.subject" class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500">
                                    </template>
                                </div>
                            </div>

                            <!-- Field: Description -->
                            <div>
                                <label class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase mb-1 block">Detailed Description</label>
                                <template x-if="mode === 'view'">
                                    <div class="p-4 bg-slate-50 dark:bg-slate-700/40 rounded-xl text-slate-600 dark:text-slate-300 leading-relaxed min-h-[100px]" x-text="query.description"></div>
                                </template>
                                <template x-if="mode === 'edit'">
                                    <textarea name="description" x-model="query.description" rows="4" class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500"></textarea>
                                </template>
                            </div>

                            <!-- Field: Priority & Status -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase mb-1 block">Priority</label>
                                    <template x-if="mode === 'view'">
                                        <div class="flex items-center gap-2 font-bold" :class="query.priority === 'high' ? 'text-rose-600 dark:text-rose-400' : 'text-slate-700 dark:text-slate-300'">
                                            <div class="h-2 w-2 rounded-full" :class="query.priority === 'high' ? 'bg-rose-600 dark:bg-rose-500' : 'bg-slate-400 dark:bg-slate-500'"></div>
                                            <span x-text="query.priority.charAt(0).toUpperCase() + query.priority.slice(1)"></span>
                                        </div>
                                    </template>
                                    <template x-if="mode === 'edit'">
                                        <select name="priority" x-model="query.priority" class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500">
                                            <option value="low">Low Priority</option>
                                            <option value="medium">Medium Priority</option>
                                            <option value="high">High Priority</option>
                                        </select>
                                    </template>
                                </div>
                                <div>
                                    <label class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase mb-1 block">Current Status</label>
                                    <template x-if="mode === 'view'">
                                        <div class="p-2 border border-slate-100 dark:border-slate-600 rounded-lg inline-block text-xs font-black uppercase tracking-widest text-indigo-600 dark:text-indigo-400" x-text="query.status"></div>
                                    </template>
                                    <template x-if="mode === 'edit'">
                                        <select name="status" x-model="query.status" class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500">
                                            <option value="pending">Pending</option>
                                            <option value="approved">Approved</option>
                                            <option value="rejected">Rejected</option>
                                        </select>
                                    </template>
                                </div>
                            </div>

                            <!-- Field: Document -->
                            <template x-if="query.document">
                                <div class="p-3 bg-indigo-50/50 dark:bg-indigo-500/10 border border-indigo-100 dark:border-indigo-500/20 rounded-xl flex items-center justify-between">
                                    <div class="flex items-center gap-2 text-indigo-700 dark:text-indigo-400">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" /></svg>
                                        <span class="text-sm font-bold">Supporting Document Attached</span>
                                    </div>
                                    <a :href="query.document" target="_blank" class="text-xs font-black uppercase text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 underline decoration-2 underline-offset-4">View File</a>
                                </div>
                            </template>
                        </div>

                        <div class="px-6 py-4 bg-slate-50/50 dark:bg-slate-700/20 border-t border-slate-100 dark:border-slate-700/50 flex justify-end gap-3">
                            <button type="button" @click="openModal = false" class="text-sm font-bold text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-200 px-4 py-2 transition-colors">Cancel</button>
                            <template x-if="mode === 'view'">
                                <button type="button" @click="mode = 'edit'" class="premium-btn premium-btn-primary !px-8 flex items-center gap-2">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                    Modify Inquiry
                                </button>
                            </template>
                            <template x-if="mode === 'edit'">
                                <button type="submit" 
                                        :disabled="submitting"
                                        class="premium-btn premium-btn-primary !px-8 disabled:opacity-50 disabled:cursor-not-allowed">
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
