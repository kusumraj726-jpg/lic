<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="p-2 bg-rose-600 rounded-lg shadow-lg">
                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                </svg>
            </div>
            <div>
                <h2 class="font-black text-2xl text-slate-900 uppercase tracking-tight dark:text-slate-100">Studio Inquiries</h2>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">Manage incoming service leads</p>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="bg-white dark:bg-slate-900/50 rounded-[2rem] shadow-sm border border-slate-100 dark:border-slate-800 overflow-hidden">
            <div class="px-8 py-6 border-b border-slate-50 dark:border-slate-800 flex items-center justify-between bg-rose-50/10 dark:bg-rose-900/10">
                <h3 class="font-black text-slate-900 uppercase tracking-widest text-xs dark:text-slate-100">Live Leads</h3>
                <span class="text-[10px] font-bold text-rose-600 bg-rose-50 dark:bg-rose-900/20 px-3 py-1 rounded-full uppercase tracking-widest">{{ $inquiries->count() }} New Leads</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-[10px] font-black text-slate-400 uppercase tracking-[0.15em] bg-white dark:bg-slate-900/50 border-b border-slate-50 dark:border-slate-800">
                            <th class="px-8 py-5">Prospect</th>
                            <th class="px-8 py-5">Requested Service</th>
                            <th class="px-8 py-5">Message Brief</th>
                            <th class="px-8 py-5">Received</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50 dark:divide-slate-800">
                        @forelse($inquiries as $inquiry)
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/50 transition-colors group">
                                <td class="px-8 py-6">
                                    <p class="text-sm font-black text-slate-900 uppercase dark:text-slate-100">{{ $inquiry->name }}</p>
                                    <p class="text-[10px] font-medium text-slate-400">{{ $inquiry->email }}</p>
                                </td>
                                <td class="px-8 py-6">
                                    <span class="px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest bg-rose-50 dark:bg-rose-900/20 text-rose-600 dark:text-rose-400">
                                        {{ $inquiry->service }}
                                    </span>
                                </td>
                                <td class="px-8 py-6">
                                    <p class="text-[11px] font-medium text-slate-600 dark:text-slate-400 max-w-xs truncate">{{ $inquiry->message ?? 'No brief provided.' }}</p>
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
</x-app-layout>
