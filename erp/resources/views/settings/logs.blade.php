<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-slate-900 uppercase tracking-tight dark:text-slate-100">
            {{ __('Intelligence Logs') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-10 items-start">
                
                <!-- Advanced Navigation Sidebar -->
                <div class="w-full lg:w-80 shrink-0 sticky top-24">
                    <div class="mb-4">
                        <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">{{ $type === 'admin' ? 'Security' : 'Team Intel' }}</h1>
                        <p class="text-slate-500 text-[10px] font-black uppercase tracking-widest mt-1 dark:text-slate-400">Audit Stream Authority</p>
                    </div>

                    <div class="space-y-1.5 p-1.5 bg-slate-100/50 dark:bg-slate-800/50 rounded-[2rem] border border-slate-200/50 dark:border-slate-700/50 backdrop-blur-sm mb-6">
                        <x-settings-nav-link :href="route('settings.logs', ['type' => 'staff'])" :active="$type === 'staff'">
                            <span class="flex items-center justify-between w-full">
                                <span class="flex items-center gap-3">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                                    Staff Activity
                                </span>
                                @if($type === 'staff') <div class="h-2 w-2 rounded-full bg-indigo-600 animate-pulse"></div> @endif
                            </span>
                        </x-settings-nav-link>

                        <x-settings-nav-link :href="route('settings.logs', ['type' => 'admin'])" :active="$type === 'admin'">
                            <span class="flex items-center justify-between w-full">
                                <span class="flex items-center gap-3">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                                    Management
                                </span>
                                @if($type === 'admin') <div class="h-2 w-2 rounded-full bg-amber-500 animate-pulse"></div> @endif
                            </span>
                        </x-settings-nav-link>
                    </div>

                    <div class="premium-card bg-slate-900 border-none shadow-2xl p-6 text-white overflow-hidden relative rounded-[2rem]">
                         <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-indigo-500/20 rounded-full blur-xl"></div>
                         <h5 class="text-[9px] font-black text-indigo-300 uppercase tracking-[0.2em] mb-4 leading-none">Intelligence Metrics</h5>
                         <div class="space-y-6">
                            <div>
                                <div class="text-3xl font-black leading-none tracking-tight">{{ $logs->total() }}</div>
                                <div class="text-[8px] font-bold text-slate-400 uppercase tracking-widest mt-1.5">Stream Pulses</div>
                            </div>
                            <a href="{{ route('settings.index') }}" class="flex items-center gap-2 text-xs font-black text-white hover:text-indigo-300 transition-colors py-2 uppercase tracking-widest border-t border-white/10 pt-4 mt-4">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                                Exit Feed
                            </a>
                         </div>
                    </div>
                </div>

                <!-- Activity Timeline Stream -->
                <div class="flex-1 min-w-0">
                    <div class="space-y-8 relative {{ $logs->count() > 0 ? 'before:absolute before:inset-0 before:ml-5 before:-translate-x-px md:before:mx-auto md:before:translate-x-0 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-indigo-500 before:via-slate-200 dark:before:via-slate-700 before:to-transparent' : '' }}">
                        
                        @forelse($logs as $log)
                            <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group">
                                <!-- Status Pulse Marker -->
                                <div class="flex items-center justify-center w-10 h-10 rounded-full border-4 border-white dark:border-slate-900 bg-slate-100 dark:bg-slate-800 text-slate-900 dark:text-slate-100 shadow-xl shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 transition-all duration-500 group-hover:scale-125 z-10"
                                     :class="{ 'bg-indigo-600 text-white ': '{{ $log->action }}' === 'created', 'bg-amber-500 text-white ': '{{ $log->action }}' === 'updated', 'bg-rose-500 text-white ': '{{ $log->action }}' === 'deleted' || '{{ $log->action }}' === 'permanently_deleted', 'bg-emerald-500 text-white ': '{{ $log->action }}' === 'restored', 'bg-slate-800 text-white': '{{ $log->action }}' === 'login' }">
                                    @if($log->action === 'created')
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                                    @elseif($log->action === 'updated')
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                    @elseif($log->action === 'deleted' || $log->action === 'permanently_deleted')
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    @elseif($log->action === 'restored')
                                         <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg>
                                    @else
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                                    @endif
                                </div>

                                <!-- Timeline Card -->
                                <div class="w-[calc(100%-4rem)] md:w-[calc(50%-2.5rem)] p-8 rounded-[2rem] bg-white dark:bg-[#1e293b] border border-slate-100 dark:border-slate-700 shadow-xl dark:shadow-black/20 hover:shadow-2xl hover:translate-y-[-4px] transition-all duration-500 cursor-default group/card overflow-hidden relative">
                                    <div class="absolute top-0 right-0 w-24 h-24 bg-slate-50 dark:bg-slate-800 rounded-full blur-2xl -mr-12 -mt-12 transition-colors group-hover/card:bg-indigo-50 dark:group-hover/card:bg-indigo-500/10"></div>
                                    
                                    <div class="relative">
                                        <div class="flex items-center justify-between mb-4">
                                            <time class="font-black text-[10px] text-indigo-400 dark:text-indigo-300 uppercase tracking-[0.2em]">{{ $log->created_at->diffForHumans() }}</time>
                                            <span class="text-[9px] font-black uppercase tracking-[0.2em] px-3 py-1 rounded-full {{ $log->action === 'created' ? 'bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400' : ($log->action === 'updated' ? 'bg-amber-50 dark:bg-amber-500/10 text-amber-600 dark:text-amber-400' : 'bg-slate-50 dark:bg-slate-800 text-slate-600 dark:text-slate-300') }}">
                                                {{ strtoupper(str_replace('_', ' ', $log->action)) }}
                                            </span>
                                        </div>
                                        <div class="flex items-start gap-4 mb-6">
                                            <div class="h-10 w-10 rounded-2xl bg-slate-900 text-white flex items-center justify-center font-black text-xs uppercase shadow-lg dark:shadow-black/40 group-hover/card:scale-110 transition-transform">
                                                {{ substr($log->user->name, 0, 1) }}
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <div class="text-sm font-black text-slate-900 dark:text-white tracking-tight">{{ $log->user->name }}</div>
                                                <div class="text-xs font-bold text-slate-400 uppercase mt-0.5">{{ $log->description }}</div>
                                            </div>
                                        </div>
                                        @if($log->metadata && isset($log->metadata['attributes']))
                                            <div class="p-5 bg-slate-50 dark:bg-slate-800/50 rounded-3xl space-y-3 group-hover/card:bg-white dark:group-hover/card:bg-slate-800 border border-transparent group-hover/card:border-slate-100 dark:group-hover/card:border-slate-700 transition-colors">
                                                @php
                                                    $target = class_basename($log->target_type);
                                                @endphp
                                                <div class="flex items-center justify-between">
                                                    <span class="text-[9px] font-black bg-slate-900 text-white px-2 py-0.5 rounded uppercase tracking-widest">{{ $target }}</span>
                                                    <span class="text-xs font-mono text-indigo-600 dark:text-indigo-400 font-bold tracking-tighter">REF: {{ str_pad($log->target_id, 5, '0', STR_PAD_LEFT) }}</span>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="mt-6 pt-6 border-t border-slate-50 dark:border-slate-700/50 flex items-center justify-between">
                                            <div class="flex items-center gap-3">
                                                <div class="h-6 w-6 rounded-lg bg-slate-50 flex items-center justify-center dark:bg-slate-800/50">
                                                    <svg class="h-3 w-3 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                                                </div>
                                                <span class="text-[10px] font-bold text-slate-400 font-mono tracking-tight">{{ $log->ip_address }}</span>
                                            </div>
                                            <div class="text-[9px] font-black text-slate-300 uppercase tracking-widest">{{ $log->created_at->format('H:i:s') }} UTC</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-32 bg-white dark:bg-[#1e293b] rounded-[3rem] border-4 border-dashed border-slate-100 dark:border-slate-700/50 p-10">
                                <div class="h-20 w-20 bg-slate-50 dark:bg-slate-800 rounded-full flex items-center justify-center mx-auto mb-6 text-slate-200 dark:text-slate-600">
                                     <svg class="h-10 w-10 animate-spin-slow" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                </div>
                                <h3 class="text-xl font-black text-slate-900 dark:text-white tracking-tight">Stream Silence</h3>
                                <p class="text-sm font-bold text-slate-400 dark:text-slate-500 mt-2 uppercase tracking-widest">No intelligence pulses detected in this frequency yet.</p>
                            </div>
                        @endforelse

                        <!-- Pagination Hub -->
                        @if($logs->hasPages())
                            <div class="pt-12 px-5">
                                {{ $logs->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

