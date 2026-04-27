<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="p-2 bg-amber-600 rounded-lg shadow-lg">
                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <h2 class="font-black text-2xl text-slate-900 uppercase tracking-tight dark:text-slate-100">Platform Expenses</h2>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">Manage Infrastructure & External Bills</p>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <!-- Infrastructure Links -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <a href="https://railway.app/account/billing" target="_blank" class="flex items-center justify-between p-8 bg-white dark:bg-slate-900/50 rounded-[2rem] border border-slate-100 dark:border-slate-800 hover:border-indigo-500 transition-all group">
                <div class="flex items-center gap-5">
                    <div class="h-12 w-12 rounded-2xl bg-slate-900 flex items-center justify-center">
                        <svg class="h-6 w-6 text-white" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2L2 19.7778H22L12 2Z"/></svg>
                    </div>
                    <div>
                        <h4 class="font-black text-slate-900 dark:text-slate-100 uppercase tracking-tight">Railway Billing</h4>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Server & Database Hosting</p>
                    </div>
                </div>
                <svg class="h-5 w-5 text-slate-300 group-hover:text-indigo-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
            </a>

            <a href="https://supabase.com/dashboard/org/_/billing" target="_blank" class="flex items-center justify-between p-8 bg-white dark:bg-slate-900/50 rounded-[2rem] border border-slate-100 dark:border-slate-800 hover:border-emerald-500 transition-all group">
                <div class="flex items-center gap-5">
                    <div class="h-12 w-12 rounded-2xl bg-emerald-600 flex items-center justify-center">
                        <svg class="h-6 w-6 text-white" viewBox="0 0 24 24" fill="currentColor"><path d="M11.6667 0L10.6667 10.6667H21.3333L9.66667 21.3333L10.6667 10.6667H0L11.6667 0Z"/></svg>
                    </div>
                    <div>
                        <h4 class="font-black text-slate-900 dark:text-slate-100 uppercase tracking-tight">Supabase Billing</h4>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Data Storage & Auth</p>
                    </div>
                </div>
                <svg class="h-5 w-5 text-slate-300 group-hover:text-emerald-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Log Form -->
            <div class="lg:col-span-1">
                <div class="bg-white dark:bg-slate-900/50 p-8 rounded-[2.5rem] border border-slate-100 dark:border-slate-800 shadow-sm">
                    <h3 class="text-sm font-black text-slate-900 dark:text-slate-100 uppercase tracking-widest mb-6">Log New Expense</h3>
                    <form action="{{ route('superadmin.expenses.store') }}" method="POST" class="space-y-5">
                        @csrf
                        <div>
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 block">Service Name</label>
                            <input type="text" name="service_name" placeholder="e.g. Railway" required class="w-full h-12 rounded-xl bg-slate-50 dark:bg-slate-800 border-slate-100 dark:border-slate-700 text-sm font-bold text-slate-700 dark:text-slate-100">
                        </div>
                        <div>
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 block">Amount (₹)</label>
                            <input type="number" step="0.01" name="amount" placeholder="0.00" required class="w-full h-12 rounded-xl bg-slate-50 dark:bg-slate-800 border-slate-100 dark:border-slate-700 text-sm font-bold text-slate-700 dark:text-slate-100">
                        </div>
                        <div>
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 block">Billing Date</label>
                            <input type="date" name="billing_date" value="{{ date('Y-m-d') }}" required class="w-full h-12 rounded-xl bg-slate-50 dark:bg-slate-800 border-slate-100 dark:border-slate-700 text-sm font-bold text-slate-700 dark:text-slate-100">
                        </div>
                        <button type="submit" class="w-full py-4 rounded-2xl bg-indigo-600 text-white text-xs font-black uppercase tracking-[0.2em] shadow-lg shadow-indigo-200 dark:shadow-none hover:scale-[1.02] transition-transform">Save Record</button>
                    </form>
                </div>
            </div>

            <!-- Expense List -->
            <div class="lg:col-span-2">
                <div class="bg-white dark:bg-slate-900/50 rounded-[2.5rem] border border-slate-100 dark:border-slate-800 overflow-hidden">
                    <div class="px-8 py-6 border-b border-slate-50 dark:border-slate-800 flex items-center justify-between">
                        <h3 class="font-black text-slate-900 uppercase tracking-widest text-xs dark:text-slate-100">Billing History</h3>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Total Expenses: ₹{{ number_format($expenses->sum('amount'), 2) }}</span>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="text-[10px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-50 dark:border-slate-800">
                                    <th class="px-8 py-5">Service</th>
                                    <th class="px-8 py-5">Date</th>
                                    <th class="px-8 py-5">Amount</th>
                                    <th class="px-8 py-5">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50 dark:divide-slate-800">
                                @forelse($expenses as $expense)
                                    <tr>
                                        <td class="px-8 py-6 font-black text-sm text-slate-900 uppercase dark:text-slate-100">{{ $expense->service_name }}</td>
                                        <td class="px-8 py-6 text-xs font-bold text-slate-600 dark:text-slate-400">{{ $expense->billing_date->format('d M, Y') }}</td>
                                        <td class="px-8 py-6 font-black text-sm text-rose-600">₹{{ number_format($expense->amount, 2) }}</td>
                                        <td class="px-8 py-6">
                                            <form action="{{ route('superadmin.expenses.delete', $expense) }}" method="POST" onsubmit="return confirm('Delete this record?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-slate-300 hover:text-rose-600 transition-colors">
                                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-8 py-20 text-center italic text-xs text-slate-400 font-bold uppercase">No Expenses Logged Yet</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
