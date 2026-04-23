<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-8">
            <h2 class="font-black text-3xl text-slate-900 uppercase tracking-tight dark:text-slate-100">
                RENEWALS
            </h2>
            
        </div>
    </x-slot>

    <div class="py-6" x-data="{ 
        openModal: false, 
        mode: 'view', 
        submitting: false,
        renewal: {
            id: '',
            client_id: '',
            client_name: '',
            policy_number: '',
            policy_type: 'life',
            premium_amount: 0,
            expiry_date: '',
            status: 'pending'
        },
        openRenewal(renewalObj, mode) {
            this.renewal = { ...renewalObj };
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
                    <h2 class="text-3xl font-black text-slate-900 uppercase tracking-tight dark:text-white">Policy Renewals</h2>
                    <p class="text-slate-400 dark:text-slate-500 text-[10px] font-bold uppercase tracking-widest mt-1">Manage upcoming expirations and renewal processes.</p>
                </div>
                <div class="flex items-center gap-4">
                    <form action="{{ route('renewals.index') }}" method="GET" class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-slate-400 group-focus-within:text-slate-900 dark:group-focus-within:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search policy #..." class="!pl-16 pr-4 py-2.5 text-xs rounded-xl border-slate-100 dark:border-slate-700 focus:border-slate-900 dark:focus:border-white focus:ring-0 bg-white dark:bg-slate-800 dark:text-slate-100 dark:placeholder-slate-500 shadow-sm w-64 transition-all uppercase font-bold tracking-tight">
                    </form>
                    <a href="{{ route('renewals.create') }}" class="inline-flex items-center gap-2 bg-emerald-600 text-white px-6 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-lg shadow-emerald-200 hover:bg-emerald-500 transition-all">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                        Add Renewal
                    </a>
                </div>
            </div>

            <!-- Renewals Analytics Grid -->
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-8">
                <a href="{{ route('renewals.index') }}" class="bg-white dark:bg-slate-900 p-6 rounded-[2rem] border border-slate-100 dark:border-slate-800 shadow-sm hover:shadow-xl transition-all group">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-2.5 bg-slate-50 dark:bg-slate-800 rounded-xl text-slate-400 group-hover:scale-110 transition-transform">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                        </div>
                        <span class="text-[10px] font-black text-slate-300 dark:text-slate-600 uppercase tracking-widest">AGREE</span>
                    </div>
                    <div class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">{{ $stats['total'] }}</div>
                    <div class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-1">Total Policies</div>
                </a>

                <a href="{{ route('renewals.index', ['status' => 'pending']) }}" class="bg-white dark:bg-slate-900 p-6 rounded-[2rem] border border-slate-100 dark:border-slate-800 shadow-sm hover:shadow-xl transition-all group">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-2.5 bg-amber-50 dark:bg-amber-900/20 rounded-xl text-amber-500 group-hover:scale-110 transition-transform">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <span class="text-[10px] font-black text-amber-300 dark:text-amber-800 uppercase tracking-widest">WAITING</span>
                    </div>
                    <div class="text-3xl font-black text-amber-600 tracking-tight">{{ $stats['pending'] }}</div>
                    <div class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-1">Pending</div>
                </a>

                <a href="{{ route('renewals.index', ['status' => 'renewed']) }}" class="bg-white dark:bg-slate-900 p-6 rounded-[2rem] border border-slate-100 dark:border-slate-800 shadow-sm hover:shadow-xl transition-all group">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-2.5 bg-emerald-50 dark:bg-emerald-900/20 rounded-xl text-emerald-500 group-hover:scale-110 transition-transform">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <span class="text-[10px] font-black text-emerald-300 dark:text-emerald-800 uppercase tracking-widest">SECURE</span>
                    </div>
                    <div class="text-3xl font-black text-emerald-600 tracking-tight">{{ $stats['renewed'] }}</div>
                    <div class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-1">Renewed</div>
                </a>

                <a href="{{ route('renewals.index', ['status' => 'lapsed']) }}" class="bg-white dark:bg-slate-900 p-6 rounded-[2rem] border border-slate-100 dark:border-slate-800 shadow-sm hover:shadow-xl transition-all group">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-2.5 bg-rose-50 dark:bg-rose-900/20 rounded-xl text-rose-500 group-hover:scale-110 transition-transform">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                        </div>
                        <span class="text-[10px] font-black text-rose-300 dark:text-rose-800 uppercase tracking-widest">CRITICAL</span>
                    </div>
                    <div class="text-3xl font-black text-rose-600 tracking-tight">{{ $stats['lapsed'] }}</div>
                    <div class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-1">Lapsed</div>
                </a>

                <a href="{{ route('renewals.index', ['upcoming' => 1]) }}" class="bg-white dark:bg-slate-900 p-6 rounded-[2rem] border border-slate-100 dark:border-slate-800 shadow-sm hover:shadow-xl transition-all group">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-2.5 bg-indigo-50 dark:bg-indigo-900/20 rounded-xl text-indigo-500 group-hover:scale-110 transition-transform">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /></svg>
                        </div>
                        <span class="text-[10px] font-black text-indigo-300 dark:text-indigo-800 uppercase tracking-widest">ALERT</span>
                    </div>
                    <div class="text-3xl font-black text-indigo-600 tracking-tight">{{ $stats['upcoming'] }}</div>
                    <div class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-1">30-Day Alert</div>
                </a>
            </div>


            <div class="bg-white dark:bg-slate-900 rounded-[2.5rem] border border-slate-100 dark:border-slate-800 shadow-xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-slate-50/50 dark:bg-slate-800/50 border-b border-slate-100 dark:border-slate-700">
                            <tr>
                                <th class="px-8 py-5 text-[10px] font-black text-slate-900 dark:text-slate-100 uppercase tracking-[0.2em]">Policy Details</th>
                                <th class="px-8 py-5 text-[10px] font-black text-slate-900 dark:text-slate-100 uppercase tracking-[0.2em]">Policy #</th>
                                <th class="px-8 py-5 text-[10px] font-black text-slate-900 dark:text-slate-100 uppercase tracking-[0.2em]">Premium</th>
                                <th class="px-8 py-5 text-[10px] font-black text-slate-900 dark:text-slate-100 uppercase tracking-[0.2em]">Expiry / Status</th>
                                <th class="px-8 py-5 text-[10px] font-black text-slate-900 dark:text-slate-100 uppercase tracking-[0.2em] text-right">Action Hub</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50 dark:divide-slate-800">
                            @forelse($renewals as $renewal)
                                <tr class="hover:bg-slate-50/80 dark:hover:bg-slate-800/80 transition-all duration-300 group">
                                    <td class="px-8 py-6">
                                        <div class="font-black text-slate-900 dark:text-slate-100 uppercase text-[13px]">{{ $renewal->client?->name ?? 'Unknown Client' }}</div>
                                        <div class="text-[9px] font-black text-emerald-600 dark:text-emerald-400 uppercase tracking-widest mt-0.5">{{ $renewal->policy_type }}</div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="font-mono text-[12px] font-bold text-slate-900 dark:text-slate-100 uppercase tracking-wider">{{ $renewal->policy_number }}</div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="text-[14px] font-black text-slate-900 dark:text-slate-100 tracking-tight">₹{{ number_format($renewal->premium_amount, 2) }}</div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="text-[11px] font-black {{ Carbon\Carbon::parse($renewal->expiry_date)->isPast() ? 'text-rose-600' : 'text-slate-900 dark:text-slate-100' }} tracking-tight">
                                            {{ $renewal->expiry_date }}
                                        </div>
                                        <div class="mt-1">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[9px] font-black uppercase tracking-widest {{ $renewal->status == 'renewed' ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400' : ($renewal->status == 'lapsed' ? 'bg-rose-100 text-rose-700 dark:bg-rose-900/30 dark:text-rose-400' : 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400') }}">
                                                {{ $renewal->status }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6 text-right">
                                        <div class="flex items-center justify-end gap-3 text-[10px] font-black uppercase tracking-widest">
                                            <button 
                                                data-renewal='{{ json_encode([
                                                    "id" => $renewal->id,
                                                    "client_id" => $renewal->client_id,
                                                    "client_name" => $renewal->client->name ?? "N/A",
                                                    "policy_number" => $renewal->policy_number,
                                                    "policy_type" => $renewal->policy_type,
                                                    "premium_amount" => $renewal->premium_amount,
                                                    "expiry_date" => $renewal->expiry_date,
                                                    "status" => $renewal->status
                                                ]) }}'
                                                @click="openRenewal(JSON.parse($el.dataset.renewal), 'view')" 
                                                class="text-emerald-600 dark:text-emerald-400 hover:text-emerald-900 dark:hover:text-emerald-300 transition-colors">View</button>
                                            <span class="text-slate-200 dark:text-slate-800 text-xs">|</span>
                                            <button 
                                                data-renewal='{{ json_encode([
                                                    "id" => $renewal->id,
                                                    "client_id" => $renewal->client_id,
                                                    "client_name" => $renewal->client->name ?? "N/A",
                                                    "policy_number" => $renewal->policy_number,
                                                    "policy_type" => $renewal->policy_type,
                                                    "premium_amount" => $renewal->premium_amount,
                                                    "expiry_date" => $renewal->expiry_date,
                                                    "status" => $renewal->status
                                                ]) }}'
                                                @click="openRenewal(JSON.parse($el.dataset.renewal), 'edit')" 
                                                class="text-amber-600 dark:text-amber-400 hover:text-amber-900 dark:hover:text-amber-300 transition-colors">Edit</button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-8 py-20 text-center text-gray-500 dark:text-slate-500">
                                        <div class="flex flex-col items-center">
                                            <svg class="h-12 w-12 text-slate-200 dark:text-slate-800 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                            <p class="text-[10px] font-black uppercase tracking-widest">No renewals found.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($renewals->hasPages())
                    <div class="bg-slate-50/50 dark:bg-slate-800/50 px-8 py-5 border-t border-slate-100 dark:border-slate-700">
                        {{ $renewals->links() }}
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
                     class="inline-block align-bottom bg-white dark:bg-slate-900 rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-xl sm:w-full border border-slate-100 dark:border-slate-800">
                    
                    <div class="px-6 py-4 border-b border-slate-50 dark:border-slate-800 flex justify-between items-center bg-slate-50/50 dark:bg-slate-800/50">
                        <h3 class="text-lg font-black text-slate-800 dark:text-slate-200" x-text="mode === 'view' ? 'Renewal Details' : 'Edit Renewal Record'"></h3>
                        <button @click="openModal = false" class="text-slate-400 hover:text-slate-600">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                        </button>
                    </div>

                    <form :action="`/renewals/${renewal.id}`" method="POST" x-ref="editForm" @submit.prevent="submitForm">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="client_id" :value="renewal.client_id">
                        
                        <div class="p-6 space-y-6">
                            <!-- Client & Policy Info -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="text-[11px] font-black text-slate-600 dark:text-slate-400 uppercase tracking-widest mb-2 block">Client</label>
                                    <div class="p-3 bg-slate-50 rounded-xl text-slate-700 font-bold dark:bg-slate-800/50" x-text="renewal.client_name"></div>
                                </div>
                                <div>
                                    <label class="text-[11px] font-black text-slate-600 dark:text-slate-400 uppercase tracking-widest mb-2 block">Policy Number</label>
                                    <template x-if="mode === 'view'">
                                        <div class="p-3 bg-slate-50 rounded-xl text-indigo-600 font-mono font-bold uppercase dark:bg-slate-800/50" x-text="renewal.policy_number"></div>
                                    </template>
                                    <template x-if="mode === 'edit'">
                                        <input type="text" name="policy_number" x-model="renewal.policy_number" class="w-full rounded-xl border-slate-200 focus:border-indigo-500 font-mono uppercase font-bold dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500">
                                    </template>
                                </div>
                            </div>

                            <!-- Policy Type & Amount -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="text-[11px] font-black text-slate-600 dark:text-slate-400 uppercase tracking-widest mb-2 block">Policy Type</label>
                                    <template x-if="mode === 'view'">
                                        <div class="p-3 bg-slate-50 rounded-xl text-slate-700 capitalize dark:bg-slate-800/50" x-text="renewal.policy_type"></div>
                                    </template>
                                    <template x-if="mode === 'edit'">
                                        <select name="policy_type" x-model="renewal.policy_type" class="w-full rounded-xl border-slate-200 focus:border-indigo-500 capitalize dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500">
                                            <option value="life">Life Insurance</option>
                                            <option value="health">Health Insurance</option>
                                            <option value="motor">Motor Insurance</option>
                                            <option value="general">General Insurance</option>
                                        </select>
                                    </template>
                                </div>
                                <div>
                                    <label class="text-[11px] font-black text-slate-600 dark:text-slate-400 uppercase tracking-widest mb-2 block">Premium Amount (₹)</label>
                                    <template x-if="mode === 'view'">
                                        <div class="p-3 bg-slate-50 rounded-xl text-slate-900 font-black text-lg dark:text-slate-100 dark:bg-slate-800/50" x-text="'₹' + Number(renewal.premium_amount).toLocaleString()"></div>
                                    </template>
                                    <template x-if="mode === 'edit'">
                                        <input type="number" name="premium_amount" x-model="renewal.premium_amount" class="w-full rounded-xl border-slate-200 focus:border-indigo-500 font-black text-lg dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500">
                                    </template>
                                </div>
                            </div>

                            <!-- Expiry & Status -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="text-[11px] font-black text-slate-600 dark:text-slate-400 uppercase tracking-widest mb-2 block">Expiry Date</label>
                                    <template x-if="mode === 'view'">
                                        <div class="p-3 bg-slate-50 rounded-xl text-slate-700 font-bold dark:bg-slate-800/50" :class="new Date(renewal.expiry_date) < new Date() ? 'text-rose-600' : ''" x-text="renewal.expiry_date"></div>
                                    </template>
                                    <template x-if="mode === 'edit'">
                                        <input type="date" name="expiry_date" x-model="renewal.expiry_date" class="w-full rounded-xl border-slate-200 focus:border-indigo-500 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500">
                                    </template>
                                </div>
                                <div>
                                    <label class="text-[11px] font-black text-slate-600 dark:text-slate-400 uppercase tracking-widest mb-2 block">Status</label>
                                    <template x-if="mode === 'view'">
                                        <div class="p-2 border border-slate-100 rounded-lg inline-block text-xs font-black uppercase tracking-widest" 
                                             :class="renewal.status === 'renewed' ? 'text-emerald-600' : (renewal.status === 'lapsed' ? 'text-rose-600' : 'text-amber-600')"
                                             x-text="renewal.status"></div>
                                    </template>
                                    <template x-if="mode === 'edit'">
                                        <select name="status" x-model="renewal.status" class="w-full rounded-xl border-slate-200 focus:border-indigo-500 font-bold dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500">
                                            <option value="pending">Pending</option>
                                            <option value="renewed">Renewed</option>
                                            <option value="lapsed">Lapsed</option>
                                        </select>
                                    </template>
                                </div>
                            </div>
                        </div>

                        <div class="px-6 py-4 bg-slate-50/50 dark:bg-slate-800/50 border-t border-slate-100 dark:border-slate-800 flex justify-end gap-3">
                            <button type="button" @click="openModal = false" class="text-sm font-bold text-slate-400 dark:text-slate-500 hover:text-slate-600 dark:hover:text-slate-300 px-4 py-2">Cancel</button>
                            <template x-if="mode === 'view'">
                                <button type="button" @click="mode = 'edit'" class="premium-btn premium-btn-primary !px-8 flex items-center gap-2">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                    Edit Renewal
                                </button>
                            </template>
                            <template x-if="mode === 'edit'">
                                <button type="submit" 
                                        :disabled="submitting"
                                        class="premium-btn premium-btn-primary !px-8 disabled:opacity-50 disabled:cursor-not-allowed">
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
