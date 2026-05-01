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

    <div class="py-6" x-data="{ 
        showEditModal: false, 
        currentInquiry: {},
        openEdit(inquiry) {
            this.currentInquiry = inquiry;
            this.showEditModal = true;
        }
    }">
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
                            <th class="px-8 py-5">Status</th>
                            <th class="px-8 py-5">Received</th>
                            <th class="px-8 py-5">Actions</th>
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
                                    <span class="px-2 py-0.5 rounded text-[9px] font-black uppercase tracking-widest {{ 
                                        $inquiry->status === 'closed' ? 'bg-slate-100 text-slate-600' : 
                                        ($inquiry->status === 'contacted' ? 'bg-blue-50 text-blue-600' : 'bg-amber-50 text-amber-600') 
                                    }}">
                                        {{ $inquiry->status }}
                                    </span>
                                </td>
                                <td class="px-8 py-6 whitespace-nowrap">
                                    <p class="text-[11px] font-bold text-slate-900 dark:text-slate-100">{{ $inquiry->created_at->format('d M, Y') }}</p>
                                    <p class="text-[9px] font-medium text-slate-400 uppercase tracking-widest">{{ $inquiry->created_at->format('h:i A') }}</p>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-3">
                                        <button @click="openEdit({{ $inquiry->toJson() }})" class="p-2 rounded-lg bg-slate-50 dark:bg-slate-800 text-slate-400 hover:text-indigo-600 transition-colors">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                        </button>
                                        <form action="{{ route('superadmin.inquiries.destroy', $inquiry) }}" method="POST" onsubmit="return confirm('Move this lead to trash?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 rounded-lg bg-rose-50 dark:bg-rose-900/20 text-rose-400 hover:text-rose-600 transition-colors">
                                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-8 py-20 text-center">
                                    <p class="text-xs font-bold text-slate-400 uppercase italic">No Pending Studio Inquiries</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Edit Modal -->
        <div x-show="showEditModal" class="fixed inset-0 z-[150] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm" style="display: none;">
            <div class="bg-white dark:bg-slate-900 w-full max-w-lg rounded-[2rem] shadow-2xl border border-slate-100 dark:border-slate-800 p-8" @click.away="showEditModal = false">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-lg font-black text-slate-900 dark:text-slate-100 uppercase tracking-tight">Update Lead Status</h3>
                    <button @click="showEditModal = false" class="text-slate-400 hover:text-rose-500 transition-colors">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>

                <form :action="'{{ url('nexorabyte-control/inquiries') }}/' + currentInquiry.id" method="POST" class="space-y-6">
                    @csrf
                    @method('PATCH')
                    
                    <div>
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 block">Status</label>
                        <select name="status" x-model="currentInquiry.status" class="w-full h-12 rounded-xl bg-slate-50 dark:bg-slate-800 border-slate-100 dark:border-slate-700 text-sm font-bold text-slate-700 dark:text-slate-100">
                            <option value="pending">Pending</option>
                            <option value="contacted">Contacted</option>
                            <option value="closed">Closed / Archive</option>
                        </select>
                    </div>

                    <div>
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 block">Internal Notes</label>
                        <textarea name="internal_notes" x-model="currentInquiry.internal_notes" class="w-full h-32 rounded-xl bg-slate-50 dark:bg-slate-800 border-slate-100 dark:border-slate-700 text-sm p-4 text-slate-700 dark:text-slate-100" placeholder="Enter follow-up notes..."></textarea>
                    </div>

                    <div class="flex items-center gap-3 pt-4">
                        <button type="button" @click="showEditModal = false" class="flex-1 px-6 py-4 rounded-xl bg-slate-100 text-slate-600 text-xs font-black uppercase tracking-widest">Cancel</button>
                        <button type="submit" class="flex-1 px-6 py-4 rounded-xl bg-indigo-600 text-white text-xs font-black uppercase tracking-widest shadow-lg shadow-indigo-200 dark:shadow-none">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
