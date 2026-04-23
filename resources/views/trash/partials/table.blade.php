<div class="bg-white dark:bg-slate-900 rounded-[2.5rem] border border-slate-100 dark:border-slate-800 shadow-xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-50/50 dark:bg-slate-800/50 border-b border-slate-100 dark:border-slate-700">
                <tr>
                    <th class="px-8 py-5 text-[10px] font-black text-slate-900 dark:text-slate-100 uppercase tracking-[0.2em]">Record Details</th>
                    <th class="px-8 py-5 text-[10px] font-black text-slate-900 dark:text-slate-100 uppercase tracking-[0.2em]">Deleted On</th>
                    <th class="px-8 py-5 text-[10px] font-black text-slate-900 dark:text-slate-100 uppercase tracking-[0.2em] text-right">Action Hub</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50 dark:divide-slate-800">
                @forelse($items as $item)
                    <tr class="hover:bg-slate-50/80 dark:hover:bg-slate-800/80 transition-all duration-300 group">
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-4">
                                <div class="h-10 w-10 rounded-xl bg-slate-50 dark:bg-slate-800 flex items-center justify-center text-slate-300 dark:text-slate-700 border border-slate-100 dark:border-slate-800">
                                    @if($type === 'client')
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                    @elseif($type === 'query')
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" /></svg>
                                    @elseif($type === 'claim')
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                                    @elseif($type === 'staff')
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                                    @else
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    @endif
                                </div>
                                <div>
                                    <div class="font-black text-slate-900 dark:text-slate-100 uppercase text-[13px]">
                                        @if($type === 'client' || $type === 'staff') {{ $item->name }} @endif
                                        @if($type === 'query') {{ $item->subject }} @endif
                                        @if($type === 'claim' || $type === 'renewal') {{ $item->policy_number }} @endif
                                    </div>
                                    <div class="text-[9px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest mt-0.5">
                                        @if($type === 'client') {{ $item->email ?? 'No Email' }} @endif
                                        @if($type === 'staff') {{ $item->designation ?? 'System User' }} @endif
                                        @if($type === 'query') {{ $item->client?->name ?? 'Unknown Client' }} @endif
                                        @if($type === 'claim' || $type === 'renewal') {{ $item->client?->name ?? 'Unknown Client' }} @endif
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            <div class="text-[11px] font-black text-rose-600 dark:text-rose-400 tracking-tight">{{ $item->deleted_at->format('Y-m-d H:i A') }}</div>
                        </td>
                        <td class="px-8 py-6 text-right">
                            <div class="flex items-center justify-end gap-3 text-[10px] font-black uppercase tracking-widest">
                                <form action="{{ route('trash.restore', [$type, $item->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-slate-400 hover:text-slate-900 dark:hover:text-white transition-colors">Restore</button>
                                </form>
                                <span class="text-slate-200 dark:text-slate-800 text-xs">|</span>
                                <form action="{{ route('trash.force-delete', [$type, $item->id]) }}" method="POST" onsubmit="return confirm('WARNING: This will permanently erase this record. Continue?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-rose-600 dark:text-rose-400 hover:text-rose-900 dark:hover:text-rose-300 transition-colors">Purge</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-8 py-20 text-center text-gray-500 dark:text-slate-500">
                            <div class="flex flex-col items-center">
                                <svg class="h-12 w-12 text-slate-200 dark:text-slate-800 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                <p class="text-[10px] font-black uppercase tracking-widest">No deleted {{ $type }} records found.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
