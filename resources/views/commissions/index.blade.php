<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-8">
            <h2 class="font-black text-3xl text-slate-900 uppercase tracking-tight dark:text-slate-100">
                COMMISSIONS
            </h2>
            
        </div>
    </x-slot>

    <script>window.__comPolicies = @json($clientPolicies ?? []);</script>
    <div class="py-6" x-data="{ 
        openPayoutModal: false,
        openCommissionModal: false,
        openLogicModal: false,
        mode: 'create',
        submitting: false,
        commission: {
            id: '',
            client_id: '',
            client_name: '',
            policy_number: '',
            provider: '',
            expected_amount: 0,
            received_amount: 0,
            status: 'pending',
            notes: '',
            received_at: '{{ date('Y-m-d') }}'
        },
        clientPolicies: window.__comPolicies || {},
        get availablePolicies() {
            return this.clientPolicies[String(this.commission.client_id)] || [];
        },
        updatePolicyInput() {
            let policies = this.availablePolicies;
            if (policies.length === 1) {
                this.commission.policy_number = policies[0].number;
            } else {
                let numbers = policies.map(p => p.number);
                if (!numbers.includes(this.commission.policy_number)) {
                    this.commission.policy_number = '';
                }
            }
        },
        openPayout(commObj) {
            this.commission = { ...commObj, received_at: '{{ date('Y-m-d') }}', received_amount: commObj.expected_amount };
            this.openPayoutModal = true;
        },
        openCreate() {
            this.mode = 'create';
            this.commission = { id: '', client_id: '', client_name: '', policy_number: '', provider: '{{ auth()->user()->context()->company_name ?? 'Vantage ERP' }}', expected_amount: 0, received_amount: 0, status: 'pending', notes: '', received_at: '{{ date('Y-m-d') }}' };
            this.openCommissionModal = true;
        },
        openEdit(commObj) {
            this.mode = 'edit';
            this.commission = { ...commObj };
            this.openCommissionModal = true;
        }
    }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-10 px-2">
                <div>
                    <h2 class="text-3xl font-black text-slate-900 uppercase tracking-tight dark:text-white">Financial Hub</h2>
                    <p class="text-slate-400 dark:text-slate-500 text-[10px] font-bold uppercase tracking-widest mt-1">Track commissions, revenue yields, and payment settlements.</p>
                </div>
                <div class="flex items-center gap-4">
                    @if(request('search') || request('status') || request('provider'))
                        <a href="{{ route('commissions.index') }}" class="text-[10px] font-black text-rose-600 hover:text-rose-800 flex items-center gap-1 bg-rose-50 dark:bg-rose-900/30 px-3 py-2.5 rounded-xl transition-colors uppercase tracking-widest">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                            Clear
                        </a>
                    @endif
                    <form action="{{ route('commissions.index') }}" method="GET" class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-slate-400 group-focus-within:text-violet-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search ledger..." class="!pl-16 pr-4 py-2.5 text-xs rounded-xl border-slate-100 dark:border-slate-700 focus:border-violet-500 focus:ring-violet-500 bg-white dark:bg-slate-800 dark:text-slate-100 dark:placeholder-slate-500 shadow-sm w-72 transition-all uppercase font-bold tracking-tight">
                    </form>
                    <button @click="openCreate()" class="inline-flex items-center gap-2 bg-emerald-600 text-white px-6 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-lg shadow-emerald-200 dark:shadow-none hover:bg-emerald-500 transition-all">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                        Manual Ledger Entry
                    </button>
                    <a href="{{ route('commissions.export') }}" class="inline-flex items-center gap-2 bg-violet-600 text-white px-6 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-lg shadow-violet-200 dark:shadow-none hover:bg-violet-500 transition-all">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                        Export Ledger
                    </a>
                </div>
            </div>

            <!-- Financial Statistics -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                @foreach([
                    ['label' => 'INCOMING', 'sub' => 'Total Pending', 'val' => '₹' . number_format($stats['total_pending'], 2), 'color' => 'amber', 'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                    ['label' => 'REVENUE', 'sub' => 'Received (Month)', 'val' => '₹' . number_format($stats['total_received_month'], 2), 'color' => 'emerald', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                    ['label' => 'VOLUME', 'sub' => 'Unpaid Count', 'val' => $stats['pending_count'], 'color' => 'indigo', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z']
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
                                <th class="px-8 py-5 text-[10px] font-black text-slate-900 dark:text-slate-100 uppercase tracking-[0.2em]">Source (Client)</th>
                                <th class="px-8 py-5 text-[10px] font-black text-slate-900 dark:text-slate-100 uppercase tracking-[0.2em]">Policy / Provider</th>
                                <th class="px-8 py-5 text-[10px] font-black text-slate-900 dark:text-slate-100 uppercase tracking-[0.2em]">Expected</th>
                                <th class="px-8 py-5 text-[10px] font-black text-slate-900 dark:text-slate-100 uppercase tracking-[0.2em]">Received</th>
                                <th class="px-8 py-5 text-[10px] font-black text-slate-900 dark:text-slate-100 uppercase tracking-[0.2em]">Status</th>
                                <th class="px-8 py-5 text-[10px] font-black text-slate-900 dark:text-slate-100 uppercase tracking-[0.2em] text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50 dark:divide-slate-800">
                            @forelse($commissions as $comm)
                                <tr class="hover:bg-slate-50/80 dark:hover:bg-slate-800/80 transition-all duration-300 group">
                                    <td class="px-8 py-6">
                                        <div class="font-black text-slate-900 dark:text-slate-100 uppercase text-[13px]">{{ $comm->client->name }}</div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="font-mono text-[12px] font-bold text-slate-900 dark:text-slate-100 uppercase tracking-wider">{{ $comm->policy_number }}</div>
                                        <div class="text-[9px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mt-0.5">{{ $comm->provider }}</div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="text-[14px] font-black text-slate-900 dark:text-slate-100 tracking-tight">₹{{ number_format($comm->expected_amount, 2) }}</div>
                                    </td>
                                    <td class="px-8 py-6">
                                        @if($comm->received_amount > 0)
                                            <div class="text-[14px] font-black text-emerald-600 dark:text-emerald-400 tracking-tight">₹{{ number_format($comm->received_amount, 2) }}</div>
                                            @if($comm->received_at)
                                                <div class="text-[9px] font-bold text-slate-400 dark:text-slate-500 uppercase mt-0.5">{{ $comm->received_at->format('M d, Y') }}</div>
                                            @endif
                                        @else
                                            <div class="text-[14px] font-black text-slate-200 dark:text-slate-800 tracking-tight">—</div>
                                        @endif
                                    </td>
                                    <td class="px-8 py-6">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[9px] font-black uppercase tracking-widest {{ $comm->status == 'received' ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400' : 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400' }}">
                                            {{ $comm->status }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-6 text-right">
                                        <div class="flex items-center justify-end gap-4">
                                            @if($comm->status !== 'received')
                                                <button 
                                                    data-comm='{{ json_encode([
                                                        "id" => $comm->id,
                                                        "client_name" => $comm->client->name,
                                                        "policy_number" => $comm->policy_number,
                                                        "expected_amount" => $comm->expected_amount
                                                    ]) }}'
                                                    @click="openPayout(JSON.parse($el.dataset.comm))"
                                                    class="text-xs font-black uppercase tracking-widest text-emerald-600 hover:text-emerald-900 transition-all">
                                                    Mark Paid
                                                </button>
                                            @endif
                                            <button 
                                                data-comm='{{ json_encode([
                                                    "id" => $comm->id,
                                                    "client_id" => $comm->client_id,
                                                    "client_name" => $comm->client->name,
                                                    "policy_number" => $comm->policy_number,
                                                    "provider" => $comm->provider,
                                                    "expected_amount" => $comm->expected_amount,
                                                    "received_amount" => $comm->received_amount,
                                                    "status" => $comm->status,
                                                    "notes" => $comm->notes
                                                ]) }}'
                                                @click="openEdit(JSON.parse($el.dataset.comm))"
                                                class="text-xs font-black uppercase tracking-widest text-violet-600 hover:text-violet-900 transition-all">
                                                Edit
                                            </button>
                                            <form action="{{ route('commissions.destroy', $comm) }}" method="POST" class="inline" onsubmit="return confirm('Archive this financial record?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-xs font-black uppercase tracking-widest text-rose-600 hover:text-rose-900 transition-all">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-8 py-20 text-center text-gray-500 dark:text-slate-500">
                                        <div class="flex flex-col items-center">
                                            <svg class="h-12 w-12 text-slate-200 dark:text-slate-800 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                            <p class="text-[10px] font-black uppercase tracking-widest">No commission records found.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($commissions->hasPages())
                    <div class="bg-slate-50/50 dark:bg-slate-800/50 px-8 py-5 border-t border-slate-100 dark:border-slate-700">
                        {{ $commissions->links() }}
                    </div>
                @endif
            </div>
        </div>

        <!-- Mark as Received Modal -->
        <div x-show="openPayoutModal" class="fixed inset-0 z-50 overflow-y-auto" x-cloak>
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="openPayoutModal" @click="openPayoutModal = false" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
                <div x-show="openPayoutModal" class="inline-block align-bottom bg-white dark:bg-slate-900 rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md sm:w-full border border-slate-100 dark:border-slate-800">
                    <div class="p-6">
                        <h3 class="text-xl font-black text-slate-900 dark:text-slate-100 mb-2">Payout Settlement</h3>
                        <p class="text-sm text-slate-500 dark:text-slate-400 mb-6">Confirm the commission amount received for <span class="font-bold text-slate-800 dark:text-slate-200" x-text="commission.client_name"></span>.</p>
                        
                        <form :action="`/commissions/${commission.id}/received`" method="POST">
                            @csrf
                            <div class="space-y-4">
                                <div>
                                    <label class="text-[11px] font-black text-slate-900 dark:text-white uppercase tracking-widest mb-2 block">Received Amount (₹)</label>
                                    <input type="number" name="amount" x-model="commission.received_amount" step="0.01" class="w-full rounded-xl border-slate-200 focus:border-emerald-500 focus:ring-emerald-500 font-bold text-lg dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100">
                                </div>
                                <div>
                                    <label class="text-[11px] font-black text-slate-900 dark:text-white uppercase tracking-widest mb-2 block">Received Date</label>
                                    <input type="date" name="received_at" x-model="commission.received_at" class="w-full rounded-xl border-slate-200 focus:border-emerald-500 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100">
                                </div>
                            </div>

                            <div class="mt-8 flex gap-3">
                                <button type="button" @click="openPayoutModal = false" class="flex-1 px-4 py-3 rounded-xl font-bold text-slate-400 dark:text-slate-500 bg-slate-50 dark:bg-slate-800/50 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">Cancel</button>
                                <button type="submit" class="flex-1 px-4 py-3 rounded-xl font-bold text-white bg-emerald-600 shadow-lg shadow-emerald-100 dark:shadow-none">Confirm Payout</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Manual Commission Modal -->
        <div x-show="openCommissionModal" class="fixed inset-0 z-50 overflow-y-auto" x-cloak>
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="openCommissionModal" @click="openCommissionModal = false" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
                <div x-show="openCommissionModal" class="inline-block align-bottom bg-white dark:bg-slate-900 rounded-[2rem] text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full border border-slate-100 dark:border-slate-800">
                    <div class="p-8">
                        <div class="flex justify-between items-center mb-8">
                            <h3 class="text-2xl font-black text-slate-900 dark:text-slate-100 uppercase tracking-tight" x-text="mode === 'create' ? 'New Commission' : 'Edit Commission'"></h3>
                            <button @click="openCommissionModal = false" class="text-slate-400 hover:text-slate-600 transition-colors">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                            </button>
                        </div>
                        
                        <form :action="mode === 'create' ? '{{ route('commissions.store') }}' : `/commissions/${commission.id}`" method="POST">
                            @csrf
                            <template x-if="mode === 'edit'">
                                <input type="hidden" name="_method" value="PATCH">
                            </template>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="text-[11px] font-black text-slate-900 dark:text-white uppercase tracking-widest mb-2 block">Client <span class="text-rose-500">*</span></label>
                                    <select name="client_id" x-model="commission.client_id" @change="updatePolicyInput()" class="w-full rounded-xl border-slate-200 focus:border-violet-500 font-bold dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100" required>
                                        <option value="">-- Select Client --</option>
                                        @foreach($clients as $client)
                                            <option value="{{ $client->id }}">{{ $client->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="text-[11px] font-black text-slate-900 dark:text-white uppercase tracking-widest mb-2 block">Policy Number <span class="text-rose-500">*</span></label>
                                    
                                    <!-- Dynamic Selector -->
                                    <template x-if="availablePolicies.length > 0">
                                        <select name="policy_number" x-model="commission.policy_number" class="w-full rounded-xl border-slate-200 focus:border-violet-500 font-mono font-bold dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100" required>
                                            <option value="">-- Select Policy --</option>
                                            <template x-for="policy in availablePolicies" :key="policy.number">
                                                <option :value="policy.number" x-text="policy.number"></option>
                                            </template>
                                        </select>
                                    </template>
                                    
                                    <template x-if="availablePolicies.length === 0">
                                        <input type="text" name="policy_number" x-model="commission.policy_number" class="w-full rounded-xl border-slate-200 focus:border-violet-500 font-mono font-bold dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100" placeholder="Type Policy Number" required>
                                    </template>
                                </div>
                                <div>
                                    <label class="text-[11px] font-black text-slate-900 dark:text-white uppercase tracking-widest mb-2 block">Provider / Company <span class="text-rose-500">*</span></label>
                                    <input type="text" name="provider" x-model="commission.provider" list="provider_list" class="w-full rounded-xl border-slate-200 focus:border-violet-500 font-bold dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100" required>
                                    <datalist id="provider_list">
                                        <option value="{{ auth()->user()->context()->company_name ?? 'Vantage ERP' }}">
                                        <option value="LIC of India">
                                        <option value="HDFC Life">
                                        <option value="ICICI Prudential">
                                        <option value="SBI Life">
                                        <option value="Tata AIA">
                                        <option value="Bajaj Allianz">
                                    </datalist>
                                </div>
                                <div>
                                    <label class="text-[11px] font-black text-slate-900 dark:text-white uppercase tracking-widest mb-2 block">Expected Amount (₹) <span class="text-rose-500">*</span></label>
                                    <input type="number" name="expected_amount" x-model="commission.expected_amount" step="0.01" class="w-full rounded-xl border-slate-200 focus:border-violet-500 font-black text-lg dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100" required>
                                </div>
                                <div>
                                    <label class="text-[11px] font-black text-slate-900 dark:text-white uppercase tracking-widest mb-2 block">Status</label>
                                    <select name="status" x-model="commission.status" 
                                        @change="if(commission.status === 'received') commission.received_amount = commission.expected_amount"
                                        class="w-full rounded-xl border-slate-200 focus:border-violet-500 font-bold dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100">
                                        <option value="pending">Pending</option>
                                        <option value="received">Received</option>
                                        <option value="partial">Partial</option>
                                    </select>
                                </div>
                                <div x-show="commission.status === 'received' || commission.status === 'partial'">
                                    <label class="text-[11px] font-black text-slate-900 dark:text-white uppercase tracking-widest mb-2 block">Received Amount (₹) <span class="text-rose-500">*</span></label>
                                    <input type="number" name="received_amount" x-model="commission.received_amount" step="0.01" 
                                        :required="commission.status === 'received' || commission.status === 'partial'"
                                        class="w-full rounded-xl border-slate-200 focus:border-emerald-500 font-black text-lg dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100">
                                </div>
                            </div>

                            <div class="mt-6">
                                <label class="text-[11px] font-black text-slate-900 dark:text-white uppercase tracking-widest mb-2 block">Internal Notes</label>
                                <textarea name="notes" x-model="commission.notes" rows="2" class="w-full rounded-xl border-slate-200 focus:border-violet-500 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100" placeholder="Optional notes..."></textarea>
                            </div>

                            <div class="mt-10 flex gap-4">
                                <button type="button" @click="openCommissionModal = false" class="flex-1 px-6 py-4 rounded-2xl font-black text-[10px] uppercase tracking-widest text-slate-400 bg-slate-50 dark:bg-slate-800/50 hover:bg-slate-100 transition-colors">Cancel</button>
                                <button type="submit" class="flex-1 px-6 py-4 rounded-2xl font-black text-[10px] uppercase tracking-widest text-white bg-violet-600 shadow-xl shadow-violet-100 hover:bg-violet-500 transition-all" x-text="mode === 'create' ? 'Create Record' : 'Save Changes'"></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Commission Logic Modal -->
        <div x-show="openLogicModal" class="fixed inset-0 z-[150] overflow-y-auto" x-cloak>
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="openLogicModal" @click="openLogicModal = false" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity"
                     x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" 
                     x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
                <div x-show="openLogicModal" 
                     class="inline-block align-bottom bg-white dark:bg-[#1e293b] rounded-[2rem] text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full border border-slate-100 dark:border-slate-800"
                     x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
                     x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                    
                    <div class="relative overflow-hidden group p-8 sm:p-10">
                        <div class="absolute top-0 right-0 w-64 h-64 bg-emerald-500/5 dark:bg-emerald-500/10 rounded-full blur-3xl -mr-32 -mt-32 transition-transform duration-1000 group-hover:scale-150"></div>
                        <div class="relative">
                            <div class="flex items-center justify-between mb-10">
                                <div class="flex items-center gap-5">
                                    <div class="h-12 w-12 rounded-2xl bg-emerald-50 dark:bg-emerald-500/10 flex items-center justify-center text-emerald-600 dark:text-emerald-400">
                                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    </div>
                                    <div>
                                        <h3 class="text-2xl font-black text-slate-900 dark:text-white tracking-tight">Commission Logic</h3>
                                        <p class="text-slate-400 text-[10px] font-black uppercase tracking-[0.2em] mt-1">Smart Financial Automation</p>
                                    </div>
                                </div>
                                <button @click="openLogicModal = false" class="text-slate-400 hover:text-slate-600 dark:hover:text-amber-400 transition-colors">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                </button>
                            </div>

                            <form action="{{ route('settings.commissions.update') }}" method="POST" class="space-y-8">
                                @csrf
                                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                                    @php
                                        $rates = $context->commission_rates ?? ['default' => 15, 'life' => 15, 'health' => 15, 'motor' => 15, 'general' => 15];
                                        $types = [
                                            'default' => 'Default (Fallback)',
                                            'life' => 'Life Insurance',
                                            'health' => 'Health Insurance',
                                            'motor' => 'Motor Insurance',
                                            'general' => 'General Insurance'
                                        ];
                                    @endphp

                                    @foreach($types as $key => $label)
                                        <div class="p-6 rounded-[2rem] bg-slate-50 dark:bg-[#0f172a] border border-slate-100 dark:border-slate-800 focus-within:ring-4 focus-within:ring-emerald-500/10 transition-all">
                                            <label class="text-[9px] font-black text-slate-900 dark:text-white uppercase tracking-[0.2em] mb-3 block">{{ $label }}</label>
                                            <div class="flex items-center gap-3">
                                                <input type="number" name="rates[{{ $key }}]" value="{{ $rates[$key] ?? 15 }}" step="0.5" class="w-full bg-transparent border-none p-0 text-2xl font-black text-slate-900 dark:text-white focus:ring-0">
                                                <span class="text-xl font-black text-slate-400">%</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="pt-8 mt-8 border-t border-slate-100 dark:border-slate-800 flex justify-between items-center bg-slate-50/50 dark:bg-slate-900/50 -mx-10 -mb-10 p-10">
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest max-w-sm">
                                        These are your Master Defaults. Individual policies can still have custom rates if needed.
                                    </p>
                                    <button type="submit" class="premium-btn premium-btn-primary flex items-center gap-2 !px-10 bg-emerald-600 hover:bg-emerald-700 shadow-emerald-200 text-white dark:shadow-none">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                        Update Rates
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
