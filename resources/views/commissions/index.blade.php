<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-slate-900 uppercase tracking-tight dark:text-slate-100">
            {{ __('Commission Tracker') }}
        </h2>
    </x-slot>

    <div class="py-6" x-data="{ 
        openPayoutModal: false,
        openLogicModal: false,
        submitting: false,
        commission: {
            id: '',
            client_name: '',
            policy_number: '',
            expected_amount: 0,
            received_amount: 0,
            received_at: '{{ date('Y-m-d') }}'
        },
        openPayout(commObj) {
            this.commission = { ...commObj, received_at: '{{ date('Y-m-d') }}', received_amount: commObj.expected_amount };
            this.openPayoutModal = true;
        }
    }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-3xl font-extrabold text-gray-900 dark:text-gray-100">Financial Hub</h2>
                    <p class="text-gray-500 mt-1 dark:text-slate-400">Monitor expected commissions and track your payouts.</p>
                </div>
                <div class="flex items-center gap-3">
                    @if(request('search') || request('status') || request('provider'))
                        <a href="{{ route('commissions.index') }}" class="text-sm font-bold text-rose-600 hover:text-rose-800 flex items-center gap-1 bg-rose-50 px-3 py-2 rounded-xl transition-colors">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                            Clear Filters
                        </a>
                    @endif
                    <form action="{{ route('commissions.index') }}" method="GET" class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-400 group-focus-within:text-indigo-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search policy or client..." class="search-input pl-11 pr-4 py-2.5 rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white shadow-sm w-72 transition-all dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100">
                    </form>
                    <button @click="openLogicModal = true" class="premium-btn premium-btn-primary flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white shadow-emerald-200 dark:shadow-none dark:hover:bg-emerald-500">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                        Logic
                    </button>
                </div>
            </div>

            <!-- Financial Statistics -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="premium-card !p-6 border-none bg-white shadow-xl">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-amber-50 rounded-2xl text-amber-600">
                            <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <div>
                            <div class="text-3xl font-black text-slate-900 dark:text-slate-100">₹{{ number_format($stats['total_pending'], 2) }}</div>
                            <div class="text-xs font-bold text-slate-500 uppercase tracking-widest mt-1">Pending Commissions</div>
                        </div>
                    </div>
                </div>

                <div class="premium-card !p-6 border-none bg-white shadow-xl">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-emerald-50 rounded-2xl text-emerald-600">
                            <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <div>
                            <div class="text-3xl font-black text-slate-900 dark:text-slate-100">₹{{ number_format($stats['total_received_month'], 2) }}</div>
                            <div class="text-xs font-bold text-slate-500 uppercase tracking-widest mt-1">Received This Month</div>
                        </div>
                    </div>
                </div>

                <div class="premium-card !p-6 border-none bg-white shadow-xl">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-indigo-50 rounded-2xl text-indigo-600">
                            <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                        </div>
                        <div>
                            <div class="text-3xl font-black text-slate-900 dark:text-slate-100">{{ $stats['pending_count'] }}</div>
                            <div class="text-xs font-bold text-slate-500 uppercase tracking-widest mt-1">Unpaid Policies</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="premium-card overflow-hidden !p-0 border-none shadow-xl">
                <div class="overflow-x-auto">
                    <table class="premium-table">
                        <thead>
                            <tr>
                                <th>Source</th>
                                <th>Policy #</th>
                                <th>Expected</th>
                                <th>Received</th>
                                <th>Status</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($commissions as $comm)
                                <tr class="hover:bg-slate-50 transition-colors dark:hover:bg-slate-800/50">
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-gray-900 dark:text-gray-100">{{ $comm->client->name }}</div>
                                        <div class="text-[10px] font-black uppercase tracking-widest text-indigo-600 mt-1">{{ $comm->provider }}</div>
                                    </td>
                                    <td class="px-6 py-4 font-mono text-sm text-gray-600 dark:text-gray-300">
                                        {{ $comm->policy_number }}
                                    </td>
                                    <td class="px-6 py-4 font-bold text-slate-900 dark:text-slate-100">
                                        ₹{{ number_format($comm->expected_amount, 2) }}
                                    </td>
                                    <td class="px-6 py-4 text-emerald-600 font-bold">
                                        @if($comm->status === 'received')
                                            ₹{{ number_format($comm->received_amount, 2) }}
                                            <div class="text-[9px] text-slate-400 font-medium">{{ $comm->received_at->format('d M Y') }}</div>
                                        @else
                                            —
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="badge {{ $comm->status == 'received' ? 'badge-success' : 'badge-warning' }}">
                                            {{ ucfirst($comm->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        @if($comm->status !== 'received')
                                            <button 
                                                data-comm='{{ json_encode([
                                                    "id" => $comm->id,
                                                    "client_name" => $comm->client->name,
                                                    "policy_number" => $comm->policy_number,
                                                    "expected_amount" => $comm->expected_amount
                                                ]) }}'
                                                @click="openPayout(JSON.parse($el.dataset.comm))"
                                                class="text-xs font-black uppercase tracking-widest bg-emerald-600 text-white px-4 py-2 rounded-xl hover:bg-emerald-700 transition-colors shadow-lg shadow-emerald-200 dark:shadow-none">
                                                Mark Received
                                            </button>
                                        @else
                                            <span class="text-xs font-bold text-slate-400 italic">Settled</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                        No commission records found. Add or renew a policy to generate one.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($commissions->hasPages())
                    <div class="bg-gray-50 px-6 py-4 border-t border-gray-100 dark:bg-slate-800/50">
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
                <div x-show="openPayoutModal" class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md sm:w-full">
                    <div class="p-6">
                        <h3 class="text-xl font-black text-slate-900 mb-2">Payout Settlement</h3>
                        <p class="text-sm text-slate-500 mb-6">Confirm the commission amount received for <span class="font-bold text-slate-800" x-text="commission.client_name"></span>.</p>
                        
                        <form :action="`/commissions/${commission.id}/received`" method="POST">
                            @csrf
                            <div class="space-y-4">
                                <div>
                                    <label class="text-xs font-bold text-slate-400 uppercase mb-1 block">Received Amount (₹)</label>
                                    <input type="number" name="amount" x-model="commission.received_amount" step="0.01" class="w-full rounded-xl border-slate-200 focus:border-emerald-500 focus:ring-emerald-500 font-bold text-lg">
                                </div>
                                <div>
                                    <label class="text-xs font-bold text-slate-400 uppercase mb-1 block">Received Date</label>
                                    <input type="date" name="received_at" x-model="commission.received_at" class="w-full rounded-xl border-slate-200 focus:border-emerald-500">
                                </div>
                            </div>

                            <div class="mt-8 flex gap-3">
                                <button type="button" @click="openPayoutModal = false" class="flex-1 px-4 py-3 rounded-xl font-bold text-slate-400 bg-slate-50">Cancel</button>
                                <button type="submit" class="flex-1 px-4 py-3 rounded-xl font-bold text-white bg-emerald-600 shadow-lg shadow-emerald-100">Confirm Payout</button>
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
                                            <label class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 block">{{ $label }}</label>
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
