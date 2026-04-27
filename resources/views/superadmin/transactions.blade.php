<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="p-2 bg-emerald-600 rounded-lg shadow-lg">
                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <h2 class="font-black text-2xl text-slate-900 uppercase tracking-tight dark:text-slate-100">Transaction Hub</h2>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">Monitor Incoming Subscription Revenue</p>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="bg-white dark:bg-slate-900/50 rounded-[2rem] shadow-sm border border-slate-100 dark:border-slate-800 overflow-hidden">
            <div class="px-8 py-6 border-b border-slate-50 dark:border-slate-800 flex items-center justify-between bg-emerald-50/10 dark:bg-emerald-900/10">
                <h3 class="font-black text-slate-900 uppercase tracking-widest text-xs dark:text-slate-100">Success Payments</h3>
                <span class="text-[10px] font-bold text-emerald-600 bg-emerald-50 dark:bg-emerald-900/20 px-3 py-1 rounded-full uppercase tracking-widest">Total: ₹{{ number_format($payments->sum('amount')) }}</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-[10px] font-black text-slate-400 uppercase tracking-[0.15em] bg-white dark:bg-slate-900/50 border-b border-slate-50 dark:border-slate-800">
                            <th class="px-8 py-5">Tenant / User</th>
                            <th class="px-8 py-5">Razorpay Info</th>
                            <th class="px-8 py-5">Amount</th>
                            <th class="px-8 py-5">Plan</th>
                            <th class="px-8 py-5">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50 dark:divide-slate-800">
                        @forelse($payments as $payment)
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/50 transition-colors">
                                <td class="px-8 py-6">
                                    <p class="text-sm font-black text-slate-900 uppercase dark:text-slate-100">{{ $payment->user->company_name ?? 'Guest/Pending' }}</p>
                                    <p class="text-[10px] font-medium text-slate-400">{{ $payment->user->email ?? '—' }}</p>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex flex-col gap-1">
                                        <div class="flex items-center gap-2">
                                            <span class="text-[9px] font-black text-slate-400 uppercase">ORDER:</span>
                                            <span class="text-[10px] font-bold text-slate-600 dark:text-slate-300 font-mono">{{ $payment->razorpay_order_id }}</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span class="text-[9px] font-black text-slate-400 uppercase">PAYMENT:</span>
                                            <span class="text-[10px] font-bold text-indigo-600 dark:text-indigo-400 font-mono">{{ $payment->razorpay_payment_id }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <p class="text-sm font-black text-emerald-600">₹{{ number_format($payment->amount) }}</p>
                                </td>
                                <td class="px-8 py-6">
                                    <span class="px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 border border-slate-200 dark:border-slate-700">
                                        {{ $payment->plan }}
                                    </span>
                                </td>
                                <td class="px-8 py-6">
                                    <p class="text-[11px] font-bold text-slate-900 dark:text-slate-100">{{ $payment->created_at->format('d M, Y') }}</p>
                                    <p class="text-[9px] font-medium text-slate-400 uppercase tracking-widest">{{ $payment->created_at->format('h:i A') }}</p>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-8 py-20 text-center">
                                    <p class="text-xs font-bold text-slate-400 uppercase italic">No Payments Recorded Yet</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
