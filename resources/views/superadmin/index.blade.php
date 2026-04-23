<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="p-2 bg-indigo-600 rounded-lg shadow-lg">
                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
            </div>
            <div>
                <h2 class="font-black text-2xl text-slate-900 uppercase tracking-tight dark:text-slate-100">Master Control Panel</h2>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">Platform Oversight & Revenue Tracking</p>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <!-- Revenue Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 relative overflow-hidden group">
                <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                    <svg class="h-12 w-12 text-slate-900 dark:text-slate-100" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                </div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Total Tenants</p>
                <p class="text-3xl font-black text-slate-900 dark:text-slate-100">{{ $stats['total'] ?? 0 }}</p>
            </div>

            <div class="bg-indigo-600 p-6 rounded-3xl shadow-lg relative overflow-hidden group">
                <div class="absolute top-0 right-0 p-4 opacity-20">
                    <svg class="h-12 w-12 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                </div>
                <p class="text-[10px] font-black text-indigo-200 uppercase tracking-widest mb-1">Active</p>
                <p class="text-3xl font-black text-white">{{ $stats['active'] ?? 0 }}</p>
            </div>

            <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 relative overflow-hidden group">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Expired / Inactive</p>
                <p class="text-3xl font-black text-rose-600">{{ $stats['expired'] ?? 0 }}</p>
            </div>

            <div class="bg-slate-900 p-6 rounded-3xl shadow-xl relative overflow-hidden group text-white">
                <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1 dark:text-slate-400">Est. Total Revenue</p>
                <p class="text-3xl font-black text-white">₹{{ number_format($stats['total_revenue'] ?? 0) }}</p>
            </div>
        </div>

        <!-- Breakdown -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="bg-white p-5 rounded-2xl border border-slate-100 flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Monthly MRR</p>
                    <p class="text-xl font-black text-slate-900 mt-1 dark:text-slate-100">₹{{ number_format($stats['monthly_mrr'] ?? 0) }}</p>
                </div>
                <span class="bg-indigo-50 text-indigo-600 text-[9px] font-black px-3 py-1 rounded-full uppercase">999/mo</span>
            </div>
            <div class="bg-white p-5 rounded-2xl border border-slate-100 flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Yearly ARR</p>
                    <p class="text-xl font-black text-slate-900 mt-1 dark:text-slate-100">₹{{ number_format($stats['yearly_arr'] ?? 0) }}</p>
                </div>
                <span class="bg-amber-50 text-amber-600 text-[9px] font-black px-3 py-1 rounded-full uppercase">9,990/yr</span>
            </div>
            <div class="bg-white p-5 rounded-2xl border border-slate-100 flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Trial Revenue</p>
                    <p class="text-xl font-black text-slate-900 mt-1 dark:text-slate-100">₹{{ number_format($stats['trial_revenue'] ?? 0) }}</p>
                </div>
                <span class="bg-emerald-50 text-emerald-600 text-[9px] font-black px-3 py-1 rounded-full uppercase">99 Trial</span>
            </div>
        </div>

        <!-- Tenant Table -->
        <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
            <div class="px-8 py-6 border-b border-slate-50 flex items-center justify-between bg-slate-50/50">
                <h3 class="font-black text-slate-900 uppercase tracking-widest text-xs dark:text-slate-100">Platform Tenants</h3>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ $tenants->where('role', 'admin')->count() }} Registered Accounts</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-[10px] font-black text-slate-400 uppercase tracking-[0.15em] bg-white border-b border-slate-50">
                            <th class="px-8 py-5">Company / Tenant</th>
                            <th class="px-8 py-5">Plan</th>
                            <th class="px-8 py-5">Status</th>
                            <th class="px-8 py-5">Expiry Date</th>
                            <th class="px-8 py-5">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($tenants->where('role', 'admin') as $tenant)
                            <tr class="hover:bg-slate-50/50 transition-colors group">
                                <td class="px-8 py-6">
                                    <p class="text-sm font-black text-slate-900 uppercase truncate max-w-[200px] dark:text-slate-100">{{ $tenant->company_name ?? '—' }}</p>
                                    <p class="text-[10px] font-medium text-slate-400 truncate max-w-[200px]">{{ $tenant->email }}</p>
                                </td>
                                <td class="px-8 py-6">
                                    <span class="px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest bg-slate-100 text-slate-600 dark:text-slate-300 dark:bg-slate-800">
                                        {{ $tenant->subscription_plan ?? 'none' }}
                                    </span>
                                </td>
                                <td class="px-8 py-6">
                                    @if($tenant->hasActiveSubscription())
                                        <div class="flex items-center gap-2">
                                            <div class="h-1.5 w-1.5 rounded-full bg-emerald-500 animate-pulse"></div>
                                            <span class="text-[10px] font-black text-emerald-600 uppercase">Active</span>
                                        </div>
                                    @else
                                        <div class="flex items-center gap-2">
                                            <div class="h-1.5 w-1.5 rounded-full bg-rose-500"></div>
                                            <span class="text-[10px] font-black text-rose-600 uppercase">Suspended</span>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-8 py-6 whitespace-nowrap">
                                    @if($tenant->subscription_ends_at)
                                        @php
                                            try { $endsAt = \Illuminate\Support\Carbon::parse($tenant->subscription_ends_at); } catch(\Exception $e) { $endsAt = null; }
                                        @endphp
                                        @if($endsAt)
                                            <p class="text-[11px] font-bold text-slate-900 dark:text-slate-100">{{ $endsAt->format('d M, Y') }}</p>
                                            <p class="text-[9px] font-medium {{ $endsAt->isPast() ? 'text-rose-500' : 'text-slate-400' }}">
                                                {{ $endsAt->diffForHumans() }}
                                            </p>
                                        @else
                                            <p class="text-[11px] font-bold text-slate-400">{{ $tenant->subscription_ends_at }}</p>
                                        @endif
                                    @else
                                        <p class="text-[11px] font-bold text-slate-300">No Expiry Set</p>
                                    @endif
                                </td>
                                <td class="px-8 py-6">
                                    <form method="POST" action="{{ route('superadmin.toggle', $tenant) }}">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" 
                                            class="px-4 py-2 rounded-xl text-[9px] font-black uppercase tracking-widest transition-all {{ $tenant->hasActiveSubscription() ? 'bg-rose-50 text-rose-600 hover:bg-rose-100' : 'bg-emerald-50 text-emerald-600 hover:bg-emerald-100' }}">
                                            {{ $tenant->hasActiveSubscription() ? 'Suspend' : 'Activate' }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-8 py-20 text-center">
                                    <p class="text-xs font-bold text-slate-400 uppercase italic">No Registered Tenants Found</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- Studio Inquiries Table -->
        <div class="mt-12 bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
            <div class="px-8 py-6 border-b border-slate-50 flex items-center justify-between bg-rose-50/10">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-rose-600 flex items-center justify-center text-white shadow-lg">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" /></svg>
                    </div>
                    <h3 class="font-black text-slate-900 uppercase tracking-widest text-xs dark:text-slate-100">Studio Inquiries</h3>
                </div>
                <span class="text-[10px] font-bold text-rose-600 bg-rose-50 px-3 py-1 rounded-full uppercase tracking-widest">{{ $inquiries->count() }} New Leads</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-[10px] font-black text-slate-400 uppercase tracking-[0.15em] bg-white border-b border-slate-50">
                            <th class="px-8 py-5">Prospect</th>
                            <th class="px-8 py-5">Requested Service</th>
                            <th class="px-8 py-5">Message Brief</th>
                            <th class="px-8 py-5">Received</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($inquiries as $inquiry)
                            <tr class="hover:bg-slate-50/50 transition-colors group">
                                <td class="px-8 py-6">
                                    <p class="text-sm font-black text-slate-900 uppercase dark:text-slate-100">{{ $inquiry->name }}</p>
                                    <p class="text-[10px] font-medium text-slate-400">{{ $inquiry->email }}</p>
                                </td>
                                <td class="px-8 py-6">
                                    <span class="px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest bg-rose-50 text-rose-600">
                                        {{ $inquiry->service }}
                                    </span>
                                </td>
                                <td class="px-8 py-6">
                                    <p class="text-[11px] font-medium text-slate-600 max-w-xs truncate">{{ $inquiry->message ?? 'No brief provided.' }}</p>
                                </td>
                                <td class="px-8 py-6 whitespace-nowrap">
                                    <p class="text-[11px] font-bold text-slate-900 dark:text-slate-100">{{ $inquiry->created_at->format('d M, Y') }}</p>
                                    <p class="text-[9px] font-medium text-slate-400 uppercase tracking-widest">{{ $inquiry->created_at->format('h:i A') }}</p>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-8 py-20 text-center">
                                    <p class="text-xs font-bold text-slate-400 uppercase italic">No Pending Studio Inquiries</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
