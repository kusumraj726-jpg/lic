<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-slate-900 uppercase tracking-tight">
            {{ __('Policy Renewals') }}
        </h2>
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
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-3xl font-extrabold text-gray-900">Policy Renewals</h2>
                    <p class="text-gray-500 mt-1">Manage upcoming expirations and renewal processes.</p>
                </div>
                <div class="flex items-center gap-3">
                    @if(request('search') || request('status') || request('upcoming'))
                        <a href="{{ route('renewals.index') }}" class="text-sm font-bold text-rose-600 hover:text-rose-800 flex items-center gap-1 bg-rose-50 px-3 py-2 rounded-xl transition-colors">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                            Clear Filters
                        </a>
                    @endif
                    <form action="{{ route('renewals.index') }}" method="GET" class="relative group">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search policy # or client..." class="pl-10 pr-4 py-2.5 rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white shadow-sm w-72 transition-all">
                        <svg class="h-5 w-5 absolute left-3 top-3 text-slate-400 group-focus-within:text-indigo-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                    </form>
                    <a href="{{ route('renewals.create') }}" class="premium-btn premium-btn-primary flex items-center gap-2 shadow-lg shadow-indigo-100">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                        Add Renewal Item
                    </a>
                </div>
            </div>

            <!-- Renewals Analytics Grid -->
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-8">
                <a href="{{ route('renewals.index') }}" class="premium-card !p-4 border-none bg-white shadow-md hover:shadow-lg transition-all {{ !request('status') && !request('upcoming') ? 'ring-2 ring-slate-100' : '' }}">
                    <div class="flex items-center justify-between mb-3">
                        <div class="p-2 bg-slate-100 rounded-lg text-slate-600">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                        </div>
                        <span class="text-xs font-bold text-slate-400">AGREE</span>
                    </div>
                    <div class="text-2xl font-black text-slate-900">{{ $stats['total'] }}</div>
                    <div class="text-xs font-bold text-slate-500 mt-1 uppercase">Total Policies</div>
                </a>

                <a href="{{ route('renewals.index', ['status' => 'pending']) }}" class="premium-card !p-4 border-none bg-white shadow-md hover:shadow-lg transition-all {{ request('status') === 'pending' ? 'ring-2 ring-amber-500 bg-amber-50/10' : '' }}">
                    <div class="flex items-center justify-between mb-3">
                        <div class="p-2 bg-amber-50 rounded-lg text-amber-600">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <span class="text-xs font-bold text-amber-600">WAITING</span>
                    </div>
                    <div class="text-2xl font-black text-amber-600">{{ $stats['pending'] }}</div>
                    <div class="text-xs font-bold text-slate-500 mt-1 uppercase">Pending</div>
                </a>

                <a href="{{ route('renewals.index', ['status' => 'renewed']) }}" class="premium-card !p-4 border-none bg-white shadow-md hover:shadow-lg transition-all {{ request('status') === 'renewed' ? 'ring-2 ring-emerald-500 bg-emerald-50/10' : '' }}">
                    <div class="flex items-center justify-between mb-3">
                        <div class="p-2 bg-emerald-50 rounded-lg text-emerald-600">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <span class="text-xs font-bold text-emerald-600">SECURE</span>
                    </div>
                    <div class="text-2xl font-black text-emerald-600">{{ $stats['renewed'] }}</div>
                    <div class="text-xs font-bold text-slate-500 mt-1 uppercase">Renewed</div>
                </a>

                <a href="{{ route('renewals.index', ['status' => 'lapsed']) }}" class="premium-card !p-4 border-none bg-white shadow-md hover:shadow-lg transition-all {{ request('status') === 'lapsed' ? 'ring-2 ring-rose-500 bg-rose-50/10' : '' }}">
                    <div class="flex items-center justify-between mb-3">
                        <div class="p-2 bg-rose-50 rounded-lg text-rose-600">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                        </div>
                        <span class="text-xs font-bold text-rose-600">CRITICAL</span>
                    </div>
                    <div class="text-2xl font-black text-rose-600">{{ $stats['lapsed'] }}</div>
                    <div class="text-xs font-bold text-slate-500 mt-1 uppercase">Lapsed</div>
                </a>

                <a href="{{ route('renewals.index', ['upcoming' => 1]) }}" class="premium-card !p-4 border-none bg-white shadow-md hover:shadow-lg transition-all {{ request('upcoming') ? 'ring-2 ring-indigo-500 bg-indigo-50/10' : '' }}">
                    <div class="flex items-center justify-between mb-3">
                        <div class="p-2 bg-indigo-50 rounded-lg text-indigo-600">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /></svg>
                        </div>
                        <span class="text-xs font-bold text-indigo-600">ALERT</span>
                    </div>
                    <div class="text-2xl font-black text-indigo-600">{{ $stats['upcoming'] }}</div>
                    <div class="text-xs font-bold text-slate-500 mt-1 uppercase">30-Day Alert</div>
                </a>
            </div>


            <div class="premium-card overflow-hidden !p-0 border-none shadow-xl">
                <div class="overflow-x-auto">
                    <table class="premium-table">
                        <thead>
                            <tr>
                                <th>Policy Details</th>
                                <th>Policy #</th>
                                <th>Premium</th>
                                <th>Expiry / Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($renewals as $renewal)
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-gray-900">{{ $renewal->client->name }}</div>
                                        <div class="text-xs text-indigo-600 mt-0.5">{{ ucfirst($renewal->policy_type) }}</div>
                                    </td>
                                    <td class="px-6 py-4 font-mono text-sm text-gray-600">
                                        {{ $renewal->policy_number }}
                                    </td>
                                    <td class="px-6 py-4 font-bold text-slate-900">
                                        ₹{{ number_format($renewal->premium_amount, 2) }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-bold {{ Carbon\Carbon::parse($renewal->expiry_date)->isPast() ? 'text-rose-600' : 'text-gray-900' }}">
                                            {{ $renewal->expiry_date }}
                                        </div>
                                        <span class="badge mt-1 {{ $renewal->status == 'renewed' ? 'badge-success' : ($renewal->status == 'lapsed' ? 'badge-danger' : 'badge-warning') }}">
                                            {{ ucfirst($renewal->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-3 text-sm font-bold uppercase tracking-wider">
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
                                                class="text-indigo-600 hover:text-indigo-900 flex items-center gap-1 transition-transform hover:scale-105">
                                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                                View
                                            </button>
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
                                                class="text-amber-600 hover:text-amber-900 flex items-center gap-1 transition-transform hover:scale-105">
                                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                                Edit
                                            </button>
                                            <form action="{{ route('renewals.destroy', $renewal) }}" method="POST" class="inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-rose-600 hover:text-rose-900 flex items-center gap-1" onclick="return confirm('Remove renewal record?')">
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
                                            <svg class="h-12 w-12 text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                            <p>No renewals scheduled.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($renewals->hasPages())
                    <div class="bg-gray-50 px-6 py-4 border-t border-gray-100">
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
                     class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-xl sm:w-full border border-slate-100">
                    
                    <div class="px-6 py-4 border-b border-slate-50 flex justify-between items-center bg-slate-50/50">
                        <h3 class="text-lg font-black text-slate-800" x-text="mode === 'view' ? 'Renewal Details' : 'Edit Renewal Record'"></h3>
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
                                    <label class="text-xs font-bold text-slate-400 uppercase mb-1 block">Client</label>
                                    <div class="p-3 bg-slate-50 rounded-xl text-slate-700 font-bold" x-text="renewal.client_name"></div>
                                </div>
                                <div>
                                    <label class="text-xs font-bold text-slate-400 uppercase mb-1 block">Policy Number</label>
                                    <template x-if="mode === 'view'">
                                        <div class="p-3 bg-slate-50 rounded-xl text-indigo-600 font-mono font-bold uppercase" x-text="renewal.policy_number"></div>
                                    </template>
                                    <template x-if="mode === 'edit'">
                                        <input type="text" name="policy_number" x-model="renewal.policy_number" class="w-full rounded-xl border-slate-200 focus:border-indigo-500 font-mono uppercase font-bold">
                                    </template>
                                </div>
                            </div>

                            <!-- Policy Type & Amount -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="text-xs font-bold text-slate-400 uppercase mb-1 block">Policy Type</label>
                                    <template x-if="mode === 'view'">
                                        <div class="p-3 bg-slate-50 rounded-xl text-slate-700 capitalize" x-text="renewal.policy_type"></div>
                                    </template>
                                    <template x-if="mode === 'edit'">
                                        <select name="policy_type" x-model="renewal.policy_type" class="w-full rounded-xl border-slate-200 focus:border-indigo-500 capitalize">
                                            <option value="life">Life Insurance</option>
                                            <option value="health">Health Insurance</option>
                                            <option value="motor">Motor Insurance</option>
                                            <option value="general">General Insurance</option>
                                        </select>
                                    </template>
                                </div>
                                <div>
                                    <label class="text-xs font-bold text-slate-400 uppercase mb-1 block">Premium Amount (₹)</label>
                                    <template x-if="mode === 'view'">
                                        <div class="p-3 bg-slate-50 rounded-xl text-slate-900 font-black text-lg" x-text="'₹' + Number(renewal.premium_amount).toLocaleString()"></div>
                                    </template>
                                    <template x-if="mode === 'edit'">
                                        <input type="number" name="premium_amount" x-model="renewal.premium_amount" class="w-full rounded-xl border-slate-200 focus:border-indigo-500 font-black text-lg">
                                    </template>
                                </div>
                            </div>

                            <!-- Expiry & Status -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="text-xs font-bold text-slate-400 uppercase mb-1 block">Expiry Date</label>
                                    <template x-if="mode === 'view'">
                                        <div class="p-3 bg-slate-50 rounded-xl text-slate-700 font-bold" :class="new Date(renewal.expiry_date) < new Date() ? 'text-rose-600' : ''" x-text="renewal.expiry_date"></div>
                                    </template>
                                    <template x-if="mode === 'edit'">
                                        <input type="date" name="expiry_date" x-model="renewal.expiry_date" class="w-full rounded-xl border-slate-200 focus:border-indigo-500">
                                    </template>
                                </div>
                                <div>
                                    <label class="text-xs font-bold text-slate-400 uppercase mb-1 block">Status</label>
                                    <template x-if="mode === 'view'">
                                        <div class="p-2 border border-slate-100 rounded-lg inline-block text-xs font-black uppercase tracking-widest" 
                                             :class="renewal.status === 'renewed' ? 'text-emerald-600' : (renewal.status === 'lapsed' ? 'text-rose-600' : 'text-amber-600')"
                                             x-text="renewal.status"></div>
                                    </template>
                                    <template x-if="mode === 'edit'">
                                        <select name="status" x-model="renewal.status" class="w-full rounded-xl border-slate-200 focus:border-indigo-500 font-bold">
                                            <option value="pending">Pending</option>
                                            <option value="renewed">Renewed</option>
                                            <option value="lapsed">Lapsed</option>
                                        </select>
                                    </template>
                                </div>
                            </div>
                        </div>

                        <div class="px-6 py-4 bg-slate-50/50 border-t border-slate-100 flex justify-end gap-3">
                            <button type="button" @click="openModal = false" class="text-sm font-bold text-slate-400 px-4 py-2">Cancel</button>
                            <template x-if="mode === 'view'">
                                <button type="button" @click="mode = 'edit'" class="premium-btn premium-btn-primary !px-8 flex items-center gap-2">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                    Edit Renewal
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
