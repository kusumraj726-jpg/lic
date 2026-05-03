<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="p-2 bg-emerald-600 rounded-lg shadow-lg">
                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
            </div>
            <div>
                <h2 class="font-black text-2xl text-slate-900 uppercase tracking-tight dark:text-slate-100">System Updates Hub</h2>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">Manage Global Announcements & Build Notes</p>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Publish Form -->
            <div class="lg:col-span-1">
                <div class="bg-white dark:bg-slate-900/50 p-8 rounded-[2.5rem] shadow-sm border border-slate-100 dark:border-slate-800 sticky top-24">
                    <h3 class="text-sm font-black text-slate-900 uppercase tracking-widest mb-6 dark:text-slate-100">Publish New Update</h3>
                    
                    <form action="{{ route('superadmin.system-updates.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div>
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 block">Update Title</label>
                            <input type="text" name="title" required placeholder="e.g. Security Protocol Enhanced"
                                   class="w-full rounded-2xl bg-slate-50 border-slate-100 p-4 text-xs font-bold text-slate-700 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500/20 transition-all outline-none dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100">
                        </div>

                        <div>
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 block">Version / Build</label>
                            <input type="text" name="version" placeholder="e.g. v1.0.4"
                                   class="w-full rounded-2xl bg-slate-50 border-slate-100 p-4 text-xs font-bold text-slate-700 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500/20 transition-all outline-none dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100">
                        </div>

                        <div>
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 block">Update Type</label>
                            <select name="type" required
                                    class="w-full rounded-2xl bg-slate-50 border-slate-100 p-4 text-xs font-bold text-slate-700 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500/20 transition-all outline-none dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100">
                                <option value="security">Security Update</option>
                                <option value="performance">Performance Boost</option>
                                <option value="feature">New Feature</option>
                            </select>
                        </div>

                        <div>
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 block">Announcement Content</label>
                            <textarea name="content" required rows="4" placeholder="Describe the update for clients..."
                                      class="w-full rounded-2xl bg-slate-50 border-slate-100 p-4 text-xs font-bold text-slate-700 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500/20 transition-all outline-none resize-none dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100"></textarea>
                        </div>

                        <button type="submit" class="w-full py-4 rounded-2xl bg-indigo-600 hover:bg-indigo-700 text-white text-[10px] font-black uppercase tracking-[0.2em] shadow-xl shadow-indigo-200 dark:shadow-none transition-all">
                            Broadcast Update
                        </button>
                    </form>
                </div>
            </div>

            <!-- History List -->
            <div class="lg:col-span-2">
                <div class="bg-white dark:bg-slate-900/50 rounded-[2.5rem] shadow-sm border border-slate-100 dark:border-slate-800 overflow-hidden">
                    <div class="px-8 py-6 border-b border-slate-50 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/50 flex items-center justify-between">
                        <h3 class="font-black text-slate-900 uppercase tracking-widest text-xs dark:text-slate-100">Update History</h3>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ $updates->count() }} Records</span>
                    </div>

                    <div class="p-8 space-y-6">
                        @forelse($updates as $update)
                            <div class="p-6 rounded-[2rem] bg-slate-50 dark:bg-slate-800/50 border border-slate-50 dark:border-slate-700/50 relative group">
                                <div class="flex items-start justify-between">
                                    <div class="flex gap-4">
                                        <div class="h-12 w-12 shrink-0 rounded-2xl flex items-center justify-center bg-{{ $update->type === 'security' ? 'emerald' : ($update->type === 'performance' ? 'blue' : 'indigo') }}-100 text-{{ $update->type === 'security' ? 'emerald' : ($update->type === 'performance' ? 'blue' : 'indigo') }}-600">
                                            @if($update->type === 'security')
                                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                                            @elseif($update->type === 'performance')
                                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                                            @else
                                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                                            @endif
                                        </div>
                                        <div>
                                            <div class="flex items-center gap-3 mb-1">
                                                <h4 class="text-sm font-black text-slate-900 uppercase tracking-tight dark:text-slate-100">{{ $update->title }}</h4>
                                                @if($update->version)
                                                    <span class="px-2 py-0.5 rounded-md bg-slate-200 dark:bg-slate-700 text-slate-600 dark:text-slate-400 text-[8px] font-black uppercase tracking-widest">{{ $update->version }}</span>
                                                @endif
                                            </div>
                                            <p class="text-xs font-medium text-slate-600 dark:text-slate-300 leading-relaxed max-w-lg">{{ $update->content }}</p>
                                            <div class="flex items-center gap-4 mt-4">
                                                <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">{{ $update->created_at->format('M d, Y • h:i A') }}</span>
                                                <span class="h-1 w-1 rounded-full bg-slate-300"></span>
                                                <span class="text-[9px] font-black text-indigo-500 uppercase tracking-widest">{{ strtoupper($update->type) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <form action="{{ route('superadmin.system-updates.destroy', $update) }}" method="POST" onsubmit="return confirm('Remove this update announcement?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-slate-300 hover:text-rose-500 transition-colors">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="py-20 text-center">
                                <p class="text-xs font-bold text-slate-400 uppercase italic">No system updates published yet</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
