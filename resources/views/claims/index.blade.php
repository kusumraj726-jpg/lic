<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-8">
            <h2 class="font-black text-3xl text-slate-900 uppercase tracking-tight dark:text-slate-100">
                CLAIMS
            </h2>
            
            <div class="flex items-center gap-2.5 px-4 h-11 rounded-[1.25rem] bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 shadow-sm relative overflow-hidden group">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rose-500 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-rose-500"></span>
                </span>
                <span class="relative text-[10px] font-black text-slate-900 dark:text-slate-100 uppercase tracking-[0.15em]">Simulation Active</span>
            </div>
        </div>
    </x-slot>

    <div class="py-6" x-data="{ 
        openModal: false, 
        mode: 'view', 
        submitting: false,
        claim: {
            id: '',
            client_id: '',
            client_name: '',
            policy_number: '',
            policy_type: '',
            claim_amount: '',
            incident_date: '',
            description: '',
            status: ''
        },
        init() {
            const urlParams = new URLSearchParams(window.location.search);
            const id = urlParams.get('id');
            if (id) {
                this.$nextTick(() => {
                    const buttons = document.querySelectorAll('button[data-claim]');
                    for (const btn of buttons) {
                        try {
                            const data = JSON.parse(btn.dataset.claim);
                            if (String(data.id) === String(id)) {
                                this.openClaim(data, 'view');
                                window.history.replaceState({}, document.title, window.location.pathname);
                                break;
                            }
                        } catch(e) {}
                    }
                });
            }
        },
        openClaim(claimObj, mode) {
            this.claim = {...claimObj};
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
                    <h2 class="text-3xl font-black text-slate-900 uppercase tracking-tight dark:text-white">Insurance Claims</h2>
                    <p class="text-slate-400 dark:text-slate-500 text-[10px] font-bold uppercase tracking-widest mt-1">Monitor and process client insurance claims and settlements.</p>
                </div>
                <div class="flex items-center gap-4">
                    <form action="{{ route('claims.index') }}" method="GET" class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-slate-400 group-focus-within:text-rose-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search policy # or client..." class="pl-10 pr-4 py-2.5 text-xs rounded-xl border-slate-100 dark:border-slate-700 focus:border-rose-500 focus:ring-rose-500 bg-white dark:bg-slate-800 dark:text-slate-100 dark:placeholder-slate-500 shadow-sm w-72 transition-all uppercase font-bold tracking-tight">
                    </form>
                    <a href="{{ route('claims.create') }}" class="inline-flex items-center gap-2 bg-rose-600 text-white px-6 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-lg shadow-rose-200 hover:bg-rose-500 transition-all">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                        New Claim Entry
                    </a>
                </div>
            </div>

            <!-- Claims Analytics Grid -->
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-8">
                @foreach([
                    ['label' => 'TOTAL', 'sub' => 'Total Claims', 'val' => $stats['total'], 'color' => 'slate', 'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
                    ['label' => 'IN-LOG', 'sub' => 'Submitted', 'val' => $stats['submitted'], 'color' => 'indigo', 'icon' => 'M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15'],
                    ['label' => 'WAITING', 'sub' => 'Pending', 'val' => $stats['pending'], 'color' => 'amber', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                    ['label' => 'SETTLED', 'sub' => 'Approved', 'val' => $stats['approved'], 'color' => 'emerald', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                    ['label' => 'VOID', 'sub' => 'Rejected', 'val' => $stats['rejected'], 'color' => 'rose', 'icon' => 'M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z']
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
                                <th class="px-8 py-5 text-[10px] font-black text-slate-900 dark:text-slate-100 uppercase tracking-[0.2em]">Claim Details</th>
                                <th class="px-8 py-5 text-[10px] font-black text-slate-900 dark:text-slate-100 uppercase tracking-[0.2em]">Policy #</th>
                                <th class="px-8 py-5 text-[10px] font-black text-slate-900 dark:text-slate-100 uppercase tracking-[0.2em]">Amount</th>
                                <th class="px-8 py-5 text-[10px] font-black text-slate-900 dark:text-slate-100 uppercase tracking-[0.2em]">Status</th>
                                <th class="px-8 py-5 text-[10px] font-black text-slate-900 dark:text-slate-100 uppercase tracking-[0.2em] text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50 dark:divide-slate-800">
                            @forelse($claims as $claim)
                                <tr class="hover:bg-slate-50/80 dark:hover:bg-slate-800/80 transition-all duration-300 group">
                                    <td class="px-8 py-6">
                                        <div class="font-black text-slate-900 dark:text-slate-100 uppercase text-[13px]">{{ $claim->client?->name ?? 'Unknown Client' }}</div>
                                        <div class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest mt-0.5">{{ ucfirst($claim->policy_type) }} • {{ $claim->incident_date ? $claim->incident_date->format('M d, Y') : 'N/A' }}</div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="font-mono text-[12px] font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider">{{ $claim->policy_number }}</div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="text-[14px] font-black text-slate-900 dark:text-slate-100 tracking-tight">₹{{ number_format($claim->claim_amount, 2) }}</div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[9px] font-black uppercase tracking-widest {{ $claim->status == 'approved' ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400' : ($claim->status == 'rejected' ? 'bg-rose-100 text-rose-700 dark:bg-rose-900/30 dark:text-rose-400' : ($claim->status == 'submitted' ? 'bg-indigo-100 text-indigo-700 dark:bg-indigo-900/30 dark:text-indigo-400' : 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400')) }}">
                                            {{ $claim->status }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-6 text-right">
                                        <div class="flex items-center justify-end gap-3 text-[9px] font-black uppercase tracking-widest">
                                            <button 
                                                data-claim='{{ json_encode([
                                                    "id" => $claim->id,
                                                    "client_id" => $claim->client_id,
                                                    "client_name" => $claim->client->name ?? "Unknown Client",
                                                    "policy_number" => $claim->policy_number,
                                                    "policy_type" => $claim->policy_type,
                                                    "claim_amount" => $claim->claim_amount,
                                                    "incident_date" => $claim->incident_date ? $claim->incident_date->format("Y-m-d") : "",
                                                    "description" => $claim->description,
                                                    "status" => $claim->status
                                                ]) }}'
                                                @click="openClaim(JSON.parse($el.dataset.claim), 'view')" 
                                                class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300 flex items-center gap-1.5 transition-all hover:scale-110">
                                                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                                View
                                            </button>
                                            <button 
                                                data-claim='{{ json_encode([
                                                    "id" => $claim->id,
                                                    "client_id" => $claim->client_id,
                                                    "client_name" => $claim->client->name ?? "Unknown Client",
                                                    "policy_number" => $claim->policy_number,
                                                    "policy_type" => $claim->policy_type,
                                                    "claim_amount" => $claim->claim_amount,
                                                    "incident_date" => $claim->incident_date ? $claim->incident_date->format("Y-m-d") : "",
                                                    "description" => $claim->description,
                                                    "status" => $claim->status
                                                ]) }}'
                                                @click="openClaim(JSON.parse($el.dataset.claim), 'edit')" 
                                                class="text-amber-600 dark:text-amber-400 hover:text-amber-900 dark:hover:text-amber-300 flex items-center gap-1.5 transition-all hover:scale-110">
                                                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                                Edit
                                            </button>
                                            <form action="{{ route('claims.destroy', $claim) }}" method="POST" class="inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-rose-600 dark:text-rose-400 hover:text-rose-900 dark:hover:text-rose-300 flex items-center gap-1.5 transition-all hover:scale-110" onclick="return confirm('Remove claim record?')">
                                                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-8 py-20 text-center text-gray-500 dark:text-slate-500">
                                        <div class="flex flex-col items-center">
                                            <svg class="h-12 w-12 text-slate-200 dark:text-slate-800 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                                            <p class="text-[10px] font-black uppercase tracking-widest">No claims recorded yet.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($claims->hasPages())
                    <div class="bg-slate-50/50 dark:bg-slate-800/50 px-8 py-5 border-t border-slate-100 dark:border-slate-700">
                        {{ $claims->links() }}
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
                        <h3 class="text-lg font-black text-slate-800 dark:text-slate-100" x-text="mode === 'view' ? 'Claim Details' : 'Edit Claim Record'"></h3>
                        <button @click="openModal = false" class="text-slate-400 dark:text-slate-500 hover:text-slate-600 dark:hover:text-slate-300">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                        </button>
                    </div>

                    <form :action="`/claims/${claim.id}`" method="POST" x-ref="editForm" @submit.prevent="submitForm">
                        @csrf
                        @method('PATCH')
                        
                        <div class="p-6 space-y-6">
                            <!-- Client & Policy Info -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="text-xs font-bold text-slate-400 dark:text-slate-500 uppercase mb-1 block">Client</label>
                                    <div class="p-3 bg-slate-50 dark:bg-slate-700/40 rounded-xl text-slate-700 dark:text-slate-200 font-bold" x-text="claim.client_name"></div>
                                    <input type="hidden" name="client_id" :value="claim.client_id">
                                </div>
                                <div>
                                    <label class="text-xs font-bold text-slate-400 uppercase mb-1 block">Policy Number</label>
                                    <template x-if="mode === 'view'">
                                        <div class="p-3 bg-slate-50 dark:bg-slate-700/40 rounded-xl text-indigo-600 dark:text-indigo-400 font-mono font-bold uppercase" x-text="claim.policy_number"></div>
                                    </template>
                                    <template x-if="mode === 'edit'">
                                        <input type="text" name="policy_number" x-model="claim.policy_number" class="w-full rounded-xl border-slate-200 focus:border-indigo-500 font-mono uppercase font-bold dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500">
                                    </template>
                                </div>
                            </div>

                            <!-- Policy Type & Amount -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="text-xs font-bold text-slate-400 uppercase mb-1 block">Policy Type</label>
                                    <template x-if="mode === 'view'">
                                        <div class="p-3 bg-slate-50 dark:bg-slate-700/40 rounded-xl text-slate-700 dark:text-slate-200 capitalize" x-text="claim.policy_type"></div>
                                    </template>
                                    <template x-if="mode === 'edit'">
                                        <select name="policy_type" x-model="claim.policy_type" class="w-full rounded-xl border-slate-200 focus:border-indigo-500 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500">
                                            <option value="life">Life Insurance</option>
                                            <option value="health">Health Insurance</option>
                                            <option value="motor">Motor Insurance</option>
                                            <option value="general">General Insurance</option>
                                        </select>
                                    </template>
                                </div>
                                <div>
                                    <label class="text-xs font-bold text-slate-400 uppercase mb-1 block">Claim Amount (₹)</label>
                                    <template x-if="mode === 'view'">
                                        <div class="p-3 bg-slate-50 dark:bg-slate-700/40 rounded-xl text-slate-900 dark:text-slate-100 font-black text-lg" x-text="'₹' + Number(claim.claim_amount).toLocaleString()"></div>
                                    </template>
                                    <template x-if="mode === 'edit'">
                                        <input type="number" name="claim_amount" x-model="claim.claim_amount" class="w-full rounded-xl border-slate-200 focus:border-indigo-500 font-black text-lg dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500">
                                    </template>
                                </div>
                            </div>

                            <!-- Date & Status -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="text-xs font-bold text-slate-400 uppercase mb-1 block">Incident Date</label>
                                    <template x-if="mode === 'view'">
                                        <div class="p-3 bg-slate-50 dark:bg-slate-700/40 rounded-xl text-slate-700 dark:text-slate-200 font-bold" x-text="claim.incident_date"></div>
                                    </template>
                                    <template x-if="mode === 'edit'">
                                        <input type="date" name="incident_date" x-model="claim.incident_date" class="w-full rounded-xl border-slate-200 focus:border-indigo-500 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500">
                                    </template>
                                </div>
                                <div>
                                    <label class="text-xs font-bold text-slate-400 uppercase mb-1 block">Status</label>
                                    <template x-if="mode === 'view'">
                                        <div class="p-2 border border-slate-100 dark:border-slate-600 rounded-lg inline-block text-xs font-black uppercase tracking-widest" 
                                             :class="claim.status === 'approved' ? 'text-emerald-600' : (claim.status === 'rejected' ? 'text-rose-600' : (claim.status === 'submitted' ? 'text-indigo-600' : 'text-amber-600'))"
                                             x-text="claim.status"></div>
                                    </template>
                                    <template x-if="mode === 'edit'">
                                        <select name="status" x-model="claim.status" class="w-full rounded-xl border-slate-200 focus:border-indigo-500 font-bold dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500">
                                            <option value="submitted">Submitted</option>
                                            <option value="pending">Pending</option>
                                            <option value="approved">Approved</option>
                                            <option value="rejected">Rejected</option>
                                        </select>
                                    </template>
                                </div>
                            </div>

                            <div>
                                <label class="text-xs font-bold text-slate-400 uppercase mb-1 block">Incident Description</label>
                                <template x-if="mode === 'view'">
                                    <div class="p-4 bg-slate-50 dark:bg-slate-700/40 rounded-xl text-slate-600 dark:text-slate-300 leading-relaxed min-h-[80px]" x-text="claim.description"></div>
                                </template>
                                <template x-if="mode === 'edit'">
                                    <textarea name="description" x-model="claim.description" rows="3" class="w-full rounded-xl border-slate-200 focus:border-indigo-500 shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500"></textarea>
                                </template>
                            </div>
                        </div>

                        <div class="px-6 py-4 bg-slate-50/50 dark:bg-slate-700/20 border-t border-slate-100 dark:border-slate-700/50 flex justify-end gap-3">
                            <button type="button" @click="openModal = false" class="text-sm font-bold text-slate-400 dark:text-slate-500 px-4 py-2">Cancel</button>
                            <template x-if="mode === 'view'">
                                <button type="button" @click="mode = 'edit'" class="premium-btn premium-btn-primary !px-8 flex items-center gap-2">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                    Modify Record
                                </button>
                            </template>
                            <template x-if="mode === 'edit'">
                                <button type="submit" 
                                        :disabled="submitting"
                                        class="premium-btn premium-btn-primary !px-8 disabled:opacity-50 disabled:cursor-not-allowed">
                                    <span x-show="!submitting">Update Claim</span>
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
