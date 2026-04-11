<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <a href="{{ route('dashboard') }}" class="p-2 rounded-xl bg-slate-100 text-slate-500 hover:bg-slate-200 transition-all">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                </a>
                <h2 class="text-2xl font-black text-slate-800 uppercase tracking-tight">
                    {{ __('Query Details') }}
                </h2>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('queries.edit', $query->id) }}" class="px-6 py-2.5 rounded-2xl bg-indigo-600 text-white text-xs font-black uppercase tracking-widest hover:bg-indigo-700 shadow-lg shadow-indigo-100 transition-all">
                    Edit Query
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Main Details -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Subject Header Card -->
                    <div class="premium-card bg-gradient-to-br from-indigo-700 to-slate-900 border-none shadow-xl text-white">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                            <div class="max-w-md">
                                <p class="text-[10px] font-black uppercase tracking-[0.2em] opacity-70 mb-2">Subject</p>
                                <h3 class="text-3xl font-black tracking-tight leading-tight">{{ $query->subject }}</h3>
                            </div>
                            <div class="flex gap-4">
                                <div class="px-6 py-4 rounded-[2rem] bg-white/10 backdrop-blur-md border border-white/20">
                                    <p class="text-[10px] font-black uppercase tracking-[0.2em] opacity-70 mb-1 text-center">Priority</p>
                                    <div class="text-lg font-black uppercase tracking-widest text-center
                                        @if($query->priority == 'high') text-rose-400 @elseif($query->priority == 'medium') text-amber-400 @else text-emerald-400 @endif">
                                        {{ $query->priority }}
                                    </div>
                                </div>
                                <div class="px-6 py-4 rounded-[2rem] bg-white/10 backdrop-blur-md border border-white/20">
                                    <p class="text-[10px] font-black uppercase tracking-[0.2em] opacity-70 mb-1 text-center">Status</p>
                                    <div class="text-lg font-black uppercase tracking-widest text-center text-indigo-200">
                                        {{ $query->status }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Description Card -->
                    <div class="premium-card bg-white border-none shadow-xl">
                        <h4 class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] mb-6">Full Query Description</h4>
                        <div class="p-8 rounded-[2rem] bg-slate-50 border border-slate-100 text-slate-700 leading-relaxed text-sm shadow-inner group transition-all hover:bg-white hover:shadow-md">
                            {{ $query->description }}
                        </div>
                    </div>

                    <!-- Attachments -->
                    <div class="premium-card bg-white border-none shadow-xl">
                        <h4 class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] mb-6">Accompanying Documents</h4>
                        @if($query->document)
                        <div class="flex items-center justify-between p-4 rounded-2xl bg-indigo-50 border border-indigo-100 group hover:border-indigo-400 transition-all">
                            <div class="flex items-center gap-4">
                                <div class="h-12 w-12 rounded-xl bg-indigo-600 text-white flex items-center justify-center">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg>
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase mb-0.5">Filename</p>
                                    <p class="text-[11px] font-black text-indigo-900 uppercase tracking-widest">{{ basename($query->document) }}</p>
                                </div>
                            </div>
                            <a href="{{ asset('storage/' . $query->document) }}" target="_blank" class="px-6 py-2 rounded-xl bg-white text-[10px] font-black text-indigo-600 uppercase tracking-widest border border-indigo-200 hover:bg-indigo-600 hover:text-white transition-all shadow-sm">
                                Download File
                            </a>
                        </div>
                        @else
                        <div class="text-center py-10 rounded-3xl border-2 border-dashed border-slate-100 bg-slate-50">
                            <svg class="h-10 w-10 text-slate-200 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" /></svg>
                            <p class="text-[10px] font-black text-slate-300 uppercase tracking-[0.2em]">No Documents Attached</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Sidebar Sidebar -->
                <div class="space-y-8">
                    <!-- Client Card -->
                    <div class="premium-card bg-white border-none shadow-xl">
                        <h4 class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] mb-6">Initiated By</h4>
                        <div class="flex items-center gap-4 mb-6">
                            <div class="h-16 w-16 rounded-2xl bg-slate-900 text-white flex items-center justify-center text-2xl font-black">
                                {{ substr($query->client->name ?? '?', 0, 1) }}
                            </div>
                            <div>
                                <h4 class="text-lg font-black text-slate-900 uppercase tracking-tight">{{ $query->client->name ?? 'External System' }}</h4>
                                <p class="text-xs font-bold text-slate-400">{{ $query->client->email ?? 'no-email-recorded' }}</p>
                            </div>
                        </div>
                        <div class="pt-6 border-t border-slate-50">
                            <a href="{{ $query->client_id ? route('clients.show', $query->client_id) : '#' }}" class="flex items-center justify-center w-full py-3 rounded-xl bg-slate-50 text-[10px] font-black text-slate-600 uppercase tracking-[0.2em] hover:bg-slate-900 hover:text-white transition-all">
                                View Full Profile
                            </a>
                        </div>
                    </div>

                    <!-- Meta Info Card -->
                    <div class="premium-card bg-indigo-50 border-none shadow-md">
                        <h4 class="text-[11px] font-black text-indigo-400 uppercase tracking-[0.2em] mb-6">Tracking Information</h4>
                        <div class="space-y-4">
                            <div class="flex flex-col gap-1">
                                <span class="text-[9px] font-bold text-indigo-400 uppercase tracking-widest">Logged On</span>
                                <span class="text-xs font-black text-indigo-900 uppercase tracking-widest">{{ $query->created_at->format('d M, Y H:i') }}</span>
                            </div>
                            <div class="flex flex-col gap-1">
                                <span class="text-[9px] font-bold text-indigo-400 uppercase tracking-widest">Internal ID</span>
                                <span class="text-xs font-black text-indigo-900 uppercase tracking-widest">#QR-{{ str_pad($query->id, 5, '0', STR_PAD_LEFT) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
