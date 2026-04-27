<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="p-2 bg-slate-900 rounded-lg shadow-lg">
                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
            </div>
            <div>
                <h2 class="font-black text-2xl text-slate-900 uppercase tracking-tight dark:text-slate-100">Super Trash Bin</h2>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">Recover or permanently delete records</p>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <!-- Inquiries Trash -->
        <div class="bg-white dark:bg-slate-900/50 rounded-[2rem] shadow-sm border border-slate-100 dark:border-slate-800 overflow-hidden">
            <div class="px-8 py-6 border-b border-slate-50 dark:border-slate-800 flex items-center justify-between bg-slate-50/50 dark:bg-slate-800/50">
                <h3 class="font-black text-slate-900 uppercase tracking-widest text-xs dark:text-slate-100">Deleted Studio Inquiries</h3>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ $deletedInquiries->count() }} Archived Records</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-[10px] font-black text-slate-400 uppercase tracking-[0.15em] bg-white dark:bg-slate-900/50 border-b border-slate-50 dark:border-slate-800">
                            <th class="px-8 py-5">Prospect</th>
                            <th class="px-8 py-5">Deleted At</th>
                            <th class="px-8 py-5">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50 dark:divide-slate-800">
                        @forelse($deletedInquiries as $inquiry)
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/50 transition-colors group">
                                <td class="px-8 py-6">
                                    <p class="text-sm font-black text-slate-900 uppercase dark:text-slate-100">{{ $inquiry->name }}</p>
                                    <p class="text-[10px] font-medium text-slate-400">{{ $inquiry->email }}</p>
                                </td>
                                <td class="px-8 py-6">
                                    <p class="text-[11px] font-bold text-slate-900 dark:text-slate-100">{{ $inquiry->deleted_at->format('d M, Y') }}</p>
                                    <p class="text-[9px] font-medium text-rose-500 uppercase tracking-widest">{{ $inquiry->deleted_at->diffForHumans() }}</p>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-3">
                                        <form action="{{ route('superadmin.trash.restore', $inquiry->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="px-4 py-2 rounded-xl bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 dark:text-emerald-400 text-[9px] font-black uppercase tracking-widest hover:bg-emerald-100 transition-all">
                                                Restore
                                            </button>
                                        </form>
                                        <form action="{{ route('superadmin.trash.force', $inquiry->id) }}" method="POST" onsubmit="return confirm('PERMANENTLY delete this record? This cannot be undone.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-4 py-2 rounded-xl bg-rose-50 dark:bg-rose-900/20 text-rose-600 dark:text-rose-400 text-[9px] font-black uppercase tracking-widest hover:bg-rose-100 transition-all">
                                                Purge
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-8 py-20 text-center">
                                    <p class="text-xs font-bold text-slate-400 uppercase italic">No Deleted Inquiries Found</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
