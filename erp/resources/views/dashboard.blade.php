<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-slate-900 uppercase tracking-tight dark:text-slate-100">
            {{ __('ERP Command Center') }}
        </h2>
    </x-slot>

    <div class="pt-4 pb-8" x-data="{ }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- 1. Stats Grid (Compact & Premium) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6 mb-10">
                <!-- Total Clients Card -->
                <a href="{{ route('clients.index') }}"
                    class="group block rounded-[2rem] overflow-hidden border-none shadow-xl hover:shadow-2xl hover:translate-y-[-4px] transition-all duration-500 relative bg-gradient-to-br from-indigo-600 via-indigo-700 to-indigo-900 h-[140px]">
                    <div class="absolute -right-4 -top-4 w-20 h-20 bg-white/10 rounded-full blur-2xl group-hover:bg-white/20 transition-all"></div>
                    <div class="p-6 relative z-10 flex flex-col h-full justify-between text-white">
                        <div class="flex items-center gap-3">
                            <div class="h-10 w-10 shrink-0 flex items-center justify-center bg-white/20 rounded-xl backdrop-blur-md">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                            </div>
                            <span class="text-[10px] font-black uppercase tracking-[0.2em] opacity-80">Clients</span>
                        </div>
                        <div>
                            <div class="text-3xl font-black mb-1 leading-none">{{ $stats['clients_count'] }}</div>
                            <div class="text-[9px] font-bold uppercase tracking-widest opacity-60">Total Clients</div>
                        </div>
                    </div>
                </a>

                <!-- Open Queries Card -->
                <a href="{{ route('queries.index') }}"
                    class="group block rounded-[2rem] overflow-hidden border-none shadow-xl hover:shadow-2xl hover:translate-y-[-4px] transition-all duration-500 relative bg-gradient-to-br from-rose-500 via-rose-600 to-rose-800 h-[140px]">
                    <div class="absolute -right-4 -top-4 w-20 h-20 bg-white/10 rounded-full blur-2xl group-hover:bg-white/20 transition-all"></div>
                    <div class="p-6 relative z-10 flex flex-col h-full justify-between text-white">
                        <div class="flex items-center gap-3">
                            <div class="h-10 w-10 shrink-0 flex items-center justify-center bg-white/20 rounded-xl backdrop-blur-md">
                                <svg class="h-5 w-5 transform translate-y-[2px]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" /></svg>
                            </div>
                            <span class="text-[10px] font-black uppercase tracking-[0.2em] opacity-80">Queries</span>
                        </div>
                        <div>
                            <div class="text-3xl font-black mb-1 leading-none">{{ $stats['open_queries'] }}</div>
                            <div class="text-[9px] font-bold uppercase tracking-widest opacity-60">Open Queries</div>
                        </div>
                    </div>
                </a>

                <!-- Pending Claims Card -->
                <a href="{{ route('claims.index') }}"
                    class="group block rounded-[2rem] overflow-hidden border-none shadow-xl hover:shadow-2xl hover:translate-y-[-4px] transition-all duration-500 relative bg-gradient-to-br from-amber-500 via-orange-500 to-orange-700 h-[140px]">
                    <div class="absolute -right-4 -top-4 w-20 h-20 bg-white/10 rounded-full blur-2xl group-hover:bg-white/20 transition-all"></div>
                    <div class="p-6 relative z-10 flex flex-col h-full justify-between text-white">
                        <div class="flex items-center gap-3">
                            <div class="h-10 w-10 shrink-0 flex items-center justify-center bg-white/20 rounded-xl backdrop-blur-md">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                            </div>
                            <span class="text-[10px] font-black uppercase tracking-[0.2em] opacity-80">Claims</span>
                        </div>
                        <div>
                            <div class="text-3xl font-black mb-1 leading-none">{{ $stats['pending_claims'] }}</div>
                            <div class="text-[9px] font-bold uppercase tracking-widest opacity-60">Active Claims</div>
                        </div>
                    </div>
                </a>

                <!-- Upcoming Renewals Card -->
                <a href="{{ route('renewals.index') }}"
                    class="group block rounded-[2rem] overflow-hidden border-none shadow-xl hover:shadow-2xl hover:translate-y-[-4px] transition-all duration-500 relative bg-gradient-to-br from-emerald-600 via-teal-600 to-teal-800 h-[140px]">
                    <div class="absolute -right-4 -top-4 w-20 h-20 bg-white/10 rounded-full blur-2xl group-hover:bg-white/20 transition-all"></div>
                    <div class="p-6 relative z-10 flex flex-col h-full justify-between text-white">
                        <div class="flex items-center gap-3">
                            <div class="h-10 w-10 shrink-0 flex items-center justify-center bg-white/20 rounded-xl backdrop-blur-md">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </div>
                            <span class="text-[10px] font-black uppercase tracking-[0.2em] opacity-80">Renewals</span>
                        </div>
                        <div>
                            <div class="text-3xl font-black mb-1 leading-none">{{ $stats['upcoming_renewals'] }}</div>
                            <div class="text-[9px] font-bold uppercase tracking-widest opacity-60">Active Renewals</div>
                        </div>
                    </div>
                </a>

                <!-- Expected Commission Card (Revenue) -->
                <a href="{{ route('commissions.index') }}"
                    class="group block rounded-[2rem] overflow-hidden border-none shadow-xl hover:shadow-2xl hover:translate-y-[-4px] transition-all duration-500 relative bg-gradient-to-br from-fuchsia-500 via-fuchsia-600 to-pink-700 h-[140px]">
                    <div class="absolute -right-4 -top-4 w-20 h-20 bg-white/10 rounded-full blur-2xl group-hover:bg-white/20 transition-all"></div>
                    <div class="p-6 relative z-10 flex flex-col h-full justify-between text-white">
                        <div class="flex items-center gap-3">
                            <div class="h-10 w-10 shrink-0 flex items-center justify-center bg-white/20 rounded-xl backdrop-blur-md">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </div>
                            <span class="text-[10px] font-black uppercase tracking-[0.2em] opacity-80">Revenue</span>
                        </div>
                        <div>
                            <div class="text-3xl font-black mb-1 leading-none">₹{{ number_format($stats['total_expected_comm'] ?? 0, 0) }}</div>
                            <div class="text-[9px] font-bold uppercase tracking-widest opacity-60">Total Revenue</div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- 2. Main Dashboard Content Grid -->
            <div class="grid lg:grid-cols-12 gap-8 items-start">
                
                <!-- Primary Operations Column (Left) -->
                <div class="lg:col-span-8 space-y-8">
                    
                    <!-- 1. Priority Diagnostic Hub -->
                    <div class="premium-card bg-white dark:bg-slate-900/50 border-none dark:border dark:border-slate-800 shadow-2xl relative overflow-hidden group h-full flex flex-col transition-colors duration-300">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-50/50 dark:bg-indigo-500/5 rounded-full blur-3xl -mr-16 -mt-16"></div>
                        <div class="relative z-10 flex items-center justify-between mb-8">
                            <div class="flex items-center gap-4">
                                <div class="h-12 w-12 rounded-2xl bg-slate-900 flex items-center justify-center shadow-lg transition-transform group-hover:scale-110 duration-500">
                                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12h3L9 3l6 18 3-9h3" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-black text-slate-900 uppercase tracking-tight flex items-center gap-3 dark:text-slate-100">
                                        Priority Diagnostic
                                        <div class="flex items-center gap-1.5 px-2 py-0.5 rounded-full bg-rose-50 border border-rose-100 dark:bg-rose-500/10 dark:border-rose-500/20">
                                            <div class="h-1.5 w-1.5 rounded-full bg-rose-500 animate-pulse"></div>
                                            <span class="text-[9px] font-black text-rose-600 uppercase tracking-widest dark:text-rose-400">Live Pulse</span>
                                        </div>
                                    </h3>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-0.5">High-Authority Operational Alerts</p>
                                </div>
                            </div>
                            <span class="text-[11px] font-black text-slate-900 px-4 py-1.5 rounded-xl bg-slate-50 border border-slate-100 shadow-sm dark:text-white dark:bg-slate-800/80 dark:border-slate-700">{{ $urgent_items->count() }} ALERTS</span>
                        </div>
                        <div class="space-y-4 relative z-10 flex-1 overflow-y-auto pr-1 custom-scrollbar">
                            @forelse($urgent_items as $item)
                                <a href="{{ $item->url }}" class="flex items-center gap-5 p-4 rounded-[1.5rem] bg-slate-50/50 dark:bg-slate-800/30 border border-slate-50 dark:border-slate-800/50 group/item hover:bg-white dark:hover:bg-slate-800/50 hover:shadow-xl hover:border-indigo-100 dark:hover:border-indigo-500/30 transition-all duration-300">
                                    <div class="h-12 w-12 rounded-xl flex items-center justify-center transition-all duration-300 shadow-inner"
                                            'bg-rose-50 text-rose-600 dark:bg-rose-500/10 dark:text-rose-400 group-hover/item:bg-rose-600 group-hover/item:text-white': '{{ $item->type }}' === 'Query', 
                                            'bg-amber-50 text-amber-600 dark:bg-amber-500/10 dark:text-amber-400 group-hover/item:bg-amber-600 group-hover/item:text-white': '{{ $item->type }}' === 'Claim', 
                                            'bg-emerald-50 text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400 group-hover/item:bg-emerald-600 group-hover/item:text-white': '{{ $item->type }}' === 'Renewal',
                                            'bg-fuchsia-50 text-fuchsia-600 dark:bg-fuchsia-500/10 dark:text-fuchsia-400 group-hover/item:bg-fuchsia-600 group-hover/item:text-white': '{{ $item->type }}' === 'Commission'
                                        }">
                                        @if($item->type === 'Query')
                                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                            </svg>
                                        @elseif($item->type === 'Claim')
                                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                            </svg>
                                        @elseif($item->type === 'Renewal')
                                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        @else
                                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center gap-2 mb-0.5">
                                            <span class="text-[9px] font-black uppercase tracking-[0.15em] px-2 py-0.5 rounded-md"
                                                :class="{ 
                                                    'bg-rose-100 text-rose-700 dark:bg-rose-500/20 dark:text-rose-300': '{{ $item->type }}' === 'Query', 
                                                    'bg-amber-100 text-amber-700 dark:bg-amber-500/20 dark:text-amber-300': '{{ $item->type }}' === 'Claim', 
                                                    'bg-emerald-100 text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-300': '{{ $item->type }}' === 'Renewal',
                                                    'bg-fuchsia-100 text-fuchsia-700 dark:bg-fuchsia-500/20 dark:text-fuchsia-300': '{{ $item->type }}' === 'Commission'
                                                }">{{ $item->type }}</span>
                                            <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">{{ $item->created_at->diffForHumans() }}</span>
                                        </div>
                                        <h4 class="text-sm font-black text-slate-900 uppercase tracking-tight truncate group-hover/item:text-indigo-600 transition-colors dark:text-slate-100">
                                            {{ $item->client->name ?? 'External Protocol' }}</h4>
                                        <div class="flex items-center gap-2 mt-0.5">
                                            <span class="text-[10px] font-mono font-bold text-slate-400 dark:text-slate-500 uppercase tracking-tight">POL: {{ $item->policy_number }}</span>
                                            @if(isset($item->policy_type))
                                                <span class="h-1 w-1 rounded-full bg-slate-300 dark:bg-slate-700"></span>
                                                <span class="text-[9px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">{{ $item->policy_type }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-4">
                                        <div class="hidden sm:flex flex-col items-end">
                                            <div class="flex items-center gap-1.5 text-[9px] font-bold text-rose-600 uppercase tracking-wider">
                                                <div class="h-1 w-1 rounded-full bg-rose-600"></div>
                                                Critical Pending
                                            </div>
                                        </div>
                                        <svg class="h-4 w-4 text-slate-300 opacity-0 group-hover/item:opacity-100 group-hover/item:translate-x-1 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </div>
                                </a>
                            @empty
                                <div class="text-center py-16 px-8 rounded-3xl border-2 border-dashed border-slate-100 dark:border-slate-800 bg-slate-50/30 dark:bg-slate-800/20">
                                    <h3 class="text-[10px] font-black text-emerald-900 uppercase tracking-[0.2em] mb-1 dark:text-emerald-400">Clinical All-Clear</h3>
                                    <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest dark:text-slate-500">Zero critical pending items detected</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- 2. Performance Analytics Grid -->
                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- Query Intelligence Card -->
                        <div x-data="{ expanded: false }">
                            <!-- Overlay for expansion -->
                            <div x-show="expanded" class="fixed inset-0 z-[100] p-6 lg:p-12 bg-white/80 dark:bg-slate-900/95 backdrop-blur-2xl flex items-center justify-center transition-all duration-500" x-cloak>
                                <div class="premium-card bg-slate-50 dark:bg-slate-900/80 border border-slate-200 dark:border-slate-800 shadow-2xl flex flex-col w-full max-w-6xl h-full max-h-[90vh] p-12 transition-all duration-500">
                                    <div class="flex items-center justify-between mb-8">
                                        <div class="flex gap-4">
                                            <div class="h-12 w-12 rounded-xl bg-rose-50 dark:bg-rose-500/10 text-rose-500 dark:text-rose-400 flex items-center justify-center border border-rose-100/50 dark:border-rose-500/20">
                                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <h3 class="text-2xl font-black text-slate-900 dark:text-white uppercase tracking-tight">Query Intelligence</h3>
                                                <p class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-widest mt-0.5">Volume Analysis</p>
                                            </div>
                                        </div>
                                        <button @click="expanded = false" class="h-12 w-12 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-400 hover:text-rose-600 dark:hover:text-white transition-all flex items-center justify-center border border-slate-200 dark:border-slate-700 shadow-sm">
                                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                        </button>
                                    </div>
                                    <div class="flex-1 relative">
                                        <canvas id="queryPulseChartExpanded"></canvas>
                                    </div>
                                </div>
                            </div>

                            <!-- Original In-Grid Card -->
                            <div class="premium-card bg-white dark:bg-slate-900/50 border-none dark:border dark:border-slate-800 shadow-xl transition-all duration-300">
                                <div class="flex items-center justify-between mb-6 px-2">
                                    <div class="flex gap-4">
                                        <div class="h-10 w-10 rounded-xl bg-rose-50 dark:bg-rose-500/10 text-rose-500 dark:text-rose-400 flex items-center justify-center border border-rose-100/50 dark:border-rose-500/20">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="text-sm font-black text-slate-900 uppercase tracking-tight dark:text-slate-100">Query Intelligence</h3>
                                            <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-0.5">Volume Analysis</p>
                                        </div>
                                    </div>
                                    <button @click="expanded = true; $nextTick(() => renderExpandedQueryChart())" class="h-8 w-8 rounded-lg bg-slate-50 dark:bg-slate-800 text-slate-400 hover:text-indigo-600 dark:hover:text-white transition-all flex items-center justify-center border border-slate-100 dark:border-slate-700">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" /></svg>
                                    </button>
                                </div>
                                <div class="h-[18rem] px-2">
                                    <canvas id="queryPulseChart"></canvas>
                                </div>
                            </div>
                        </div>

                        <!-- Claim Analytics Card -->
                        <div x-data="{ expanded: false }">
                            <!-- Overlay for expansion -->
                            <div x-show="expanded" class="fixed inset-0 z-[100] p-6 lg:p-12 bg-white/80 dark:bg-slate-900/95 backdrop-blur-2xl flex items-center justify-center transition-all duration-500" x-cloak>
                                <div class="premium-card bg-slate-50 dark:bg-slate-900/80 border border-slate-200 dark:border-slate-800 shadow-2xl flex flex-col w-full max-w-6xl h-full max-h-[90vh] p-12 transition-all duration-500">
                                    <div class="flex items-center justify-between mb-8">
                                        <div class="flex gap-4">
                                            <div class="h-12 w-12 rounded-xl bg-amber-50 dark:bg-amber-500/10 text-amber-500 dark:text-amber-400 flex items-center justify-center border border-amber-100/50 dark:border-amber-500/20">
                                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <h3 class="text-2xl font-black text-slate-900 dark:text-white uppercase tracking-tight">Claim Analytics</h3>
                                                <p class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-widest mt-0.5">Case Metrics</p>
                                            </div>
                                        </div>
                                        <button @click="expanded = false" class="h-12 w-12 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-400 hover:text-rose-600 dark:hover:text-white transition-all flex items-center justify-center border border-slate-200 dark:border-slate-700 shadow-sm">
                                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                        </button>
                                    </div>
                                    <div class="flex-1 relative">
                                        <canvas id="claimPulseChartExpanded"></canvas>
                                    </div>
                                </div>
                            </div>

                            <!-- Original In-Grid Card -->
                            <div class="premium-card bg-white dark:bg-slate-900/50 border-none dark:border dark:border-slate-800 shadow-xl transition-all duration-300">
                                <div class="flex items-center justify-between mb-6 px-2">
                                    <div class="flex gap-4">
                                        <div class="h-10 w-10 rounded-xl bg-amber-50 dark:bg-amber-500/10 text-amber-500 dark:text-amber-400 flex items-center justify-center border border-amber-100/50 dark:border-amber-500/20">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="text-sm font-black text-slate-900 uppercase tracking-tight dark:text-slate-100">Claim Analytics</h3>
                                            <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-0.5">Case Metrics</p>
                                        </div>
                                    </div>
                                    <button @click="expanded = true; $nextTick(() => renderExpandedClaimChart())" class="h-8 w-8 rounded-lg bg-slate-50 dark:bg-slate-800 text-slate-400 hover:text-indigo-600 dark:hover:text-white transition-all flex items-center justify-center border border-slate-100 dark:border-slate-700">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" /></svg>
                                    </button>
                                </div>
                                <div class="h-[18rem] px-2">
                                    <canvas id="claimPulseChart"></canvas>
                                </div>
                            </div>
                        </div>

                         <!-- 3. Revenue Forecasting (Next 12 Months) -->
                        <div class="premium-card bg-white dark:bg-slate-900/50 border-none dark:border dark:border-slate-800 shadow-2xl relative overflow-hidden group md:col-span-2 transition-colors duration-300">
                            <div class="absolute top-0 right-0 w-64 h-64 bg-emerald-500/5 rounded-full blur-3xl -mr-32 -mt-32"></div>
                            <div class="relative z-10 flex items-center justify-between mb-8">
                                <div class="flex items-center gap-4">
                                    <div class="h-12 w-12 rounded-2xl bg-emerald-600 flex items-center justify-center shadow-lg">
                                        <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-black text-slate-900 uppercase tracking-tight dark:text-slate-100">Revenue Forecast</h3>
                                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-0.5">12-Month Net Commission Projection</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="text-xs font-black text-emerald-600 uppercase tracking-widest">Est. ₹{{ number_format(collect($revenueForecast['data'])->sum(), 0) }}</div>
                                    <div class="text-[9px] font-bold text-slate-400 uppercase tracking-[0.15em]">Total Potential</div>
                                </div>
                            </div>
                            <div class="h-[22rem] w-full">
                                <canvas id="revenueForecastChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Intelligence Sidebar (Right) -->
                <div class="lg:col-span-4 space-y-6">
                    
                    <div x-data="calendarData()" class="space-y-6">
                        <!-- Celebration Pulse Feed -->
                        <div class="premium-card bg-white dark:bg-slate-900/50 border-none dark:border dark:border-slate-800 shadow-2xl relative overflow-hidden p-6 min-h-[350px] transition-colors duration-300">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-500/10 rounded-full blur-2xl -mr-16 -mt-16"></div>
                            <div class="relative z-10 flex items-center justify-between mb-8">
                                <h4 class="text-[11px] font-black text-slate-900 dark:text-white uppercase tracking-[0.25em] flex items-center gap-3">
                                    <div class="h-2 w-2 rounded-full bg-indigo-400 animate-pulse"></div>
                                    Relationship Intel
                                </h4>
                                <span class="text-[10px] font-black text-indigo-600 dark:text-indigo-400 uppercase tracking-widest bg-indigo-50 dark:bg-white/5 px-3 py-1 rounded-full border border-indigo-100 dark:border-white/5" x-text="selectedDate + ' ' + monthName"></span>
                            </div>

                            <div class="space-y-2">
                                <template x-if="dailyEvents.length === 0">
                                    <div class="py-8 text-center bg-slate-50 dark:bg-white/5 rounded-[1.5rem] border border-slate-100 dark:border-white/5">
                                        <div class="h-10 w-10 rounded-xl bg-white dark:bg-white/5 shadow-sm dark:shadow-none flex items-center justify-center mx-auto mb-3 border border-slate-200 dark:border-white/10">
                                            <svg class="h-5 w-5 text-slate-400 dark:text-indigo-300/40" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <p class="text-[9px] font-black text-slate-400 dark:text-indigo-300/40 uppercase tracking-[0.15em]">Silent Pulse</p>
                                    </div>
                                </template>
                                <template x-for="(event, i) in dailyEvents" :key="i">
                                    <button @click="$dispatch('open-messaging-modal', event)" 
                                       class="relative p-3.5 rounded-[1.5rem] bg-slate-50 dark:bg-white/5 border border-slate-100 dark:border-white/5 flex items-center gap-4 group hover:bg-indigo-50 hover:border-indigo-100 dark:hover:bg-indigo-500/10 dark:hover:border-indigo-500/20 transition-all duration-300 overflow-hidden block w-full text-left">
                                        <div class="relative z-10 h-11 w-11 shrink-0 rounded-2xl flex items-center justify-center transition-all duration-500 shadow-xl group-hover:scale-105"
                                            :class="event.type === 'anniversary' ? 'bg-pink-100 text-pink-600 dark:bg-pink-500/10 dark:text-pink-300' : 'bg-amber-100 text-amber-600 dark:bg-amber-500/10 dark:text-amber-300'">
                                            <template x-if="event.type === 'birthday'">
                                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V6a2 2 0 10-2 2h2zm0 0H7a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2V10a2 2 0 00-2-2h-5z" />
                                                </svg>
                                            </template>
                                            <template x-if="event.type === 'anniversary'">
                                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10c-1.104 0-2-.896-2-2s.896-2 2-2 2 .896 2 2-.896 2-2 2zm0 0v10M12 10l-4-4M12 10l4-4M12 12l-4 4M12 12l4 4" />
                                                </svg>
                                            </template>
                                        </div>

                                        <div class="relative z-10 flex-1 min-w-0">
                                            <div class="flex items-center justify-between mb-1">
                                                <h5 class="text-[11px] font-black text-slate-900 dark:text-white uppercase tracking-tight truncate" x-text="event.title"></h5>
                                                <svg class="h-3 w-3 text-indigo-600 dark:text-indigo-400 opacity-0 group-hover:opacity-100 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </div>
                                            <p class="text-[10px] font-bold text-slate-500 dark:text-slate-400 uppercase tracking-widest leading-relaxed opacity-70 group-hover:opacity-100 transition-opacity" x-text="event.message"></p>
                                        </div>
                                    </button>
                                </template>
                            </div>
                        </div>

                        <!-- Sidebar Interactive Calendar -->
                        <div class="premium-card bg-white dark:bg-slate-900/50 border-none dark:border dark:border-slate-800 shadow-xl p-8 items-center justify-center transition-colors duration-300">
                            <div class="flex items-center justify-between mb-8">
                                <h3 class="text-sm font-black text-slate-900 uppercase tracking-tight dark:text-slate-100" x-text="monthName"></h3>
                                <div class="flex gap-2">
                                    <button @click="prevMonth" class="h-8 w-8 rounded-lg bg-slate-50 hover:bg-slate-100 text-slate-400 flex items-center justify-center transition-all border border-slate-100 dark:bg-slate-800/50">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
                                    </button>
                                    <button @click="nextMonth" class="h-8 w-8 rounded-lg bg-slate-50 hover:bg-slate-100 text-slate-400 flex items-center justify-center transition-all border border-slate-100 dark:bg-slate-800/50">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                                    </button>
                                </div>
                            </div>

                            <div class="grid grid-cols-7 gap-1 mb-2">
                                <template x-for="dayName in ['S', 'M', 'T', 'W', 'T', 'F', 'S']">
                                    <div class="text-center text-[8px] font-black text-slate-300 py-1" x-text="dayName"></div>
                                </template>
                            </div>

                            <div class="grid grid-cols-7 gap-1">
                                <template x-for="(day, index) in days" :key="index">
                                    <div @click="selectDay(day.day)"
                                        class="aspect-square rounded-lg flex flex-col items-center justify-center relative cursor-pointer transition-all duration-300 group"
                                        :class="{ 'hover:bg-indigo-50': day.day, 'bg-indigo-600 text-white font-black shadow-lg ': day.day === selectedDate && (currentMonth + 1) === selectedMonth, 'ring-2 ring-indigo-50 text-indigo-600': day.isToday && day.day !== selectedDate, 'text-slate-500 font-bold': day.day && day.day !== selectedDate && !day.isToday, 'opacity-0': !day.day }">
                                        <span class="text-[10px]" x-text="day.day"></span>
                                        <template x-if="day.hasEvent">
                                            <div class="h-0.5 w-2 rounded-full absolute bottom-1.5"
                                                 :class="day.day === selectedDate && (currentMonth + 1) === selectedMonth ? 'bg-white' : 'bg-indigo-400'"></div>
                                        </template>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <!-- Dynamic Messaging Hub moved to global layout -->
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>

    <!-- Chart.js and Data Implementation -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // 1. Query Pulse Chart
            const queryCtx = document.getElementById('queryPulseChart').getContext('2d');
            const queryGradient = queryCtx.createLinearGradient(0, 0, 0, 300);
            queryGradient.addColorStop(0, 'rgba(244, 63, 94, 0.15)');
            queryGradient.addColorStop(1, 'rgba(244, 63, 94, 0)');

            new Chart(queryCtx, {
                type: 'line',
                data: {
                    labels: @json($chartData['labels']),
                    datasets: [{
                        label: 'Queries',
                        data: @json($chartData['queries']),
                        borderColor: '#f43f5e',
                        backgroundColor: queryGradient,
                        borderWidth: 3,
                        pointBackgroundColor: '#f43f5e',
                        pointBorderColor: '#fff',
                        pointHoverRadius: 5,
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, suggestedMax: 10, grid: { color: 'rgba(0,0,0,0.03)', drawBorder: false }, ticks: { color: '#94a3b8', font: { size: 9, weight: '700' } } },
                        x: { grid: { display: false }, ticks: { color: '#94a3b8', font: { size: 9, weight: '700' } } }
                    }
                }
            });

            // 2. Claim Analytics Chart
            const claimCtx = document.getElementById('claimPulseChart').getContext('2d');
            const claimGradient = claimCtx.createLinearGradient(0, 0, 0, 300);
            claimGradient.addColorStop(0, 'rgba(245, 158, 11, 0.15)');
            claimGradient.addColorStop(1, 'rgba(245, 158, 11, 0)');

            new Chart(claimCtx, {
                type: 'line',
                data: {
                    labels: @json($chartData['labels']),
                    datasets: [{
                        label: 'Claims',
                        data: @json($chartData['claims']),
                        borderColor: '#f59e0b',
                        backgroundColor: claimGradient,
                        borderWidth: 3,
                        pointBackgroundColor: '#f59e0b',
                        pointBorderColor: '#fff',
                        pointHoverRadius: 5,
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, suggestedMax: 10, grid: { color: 'rgba(0,0,0,0.03)', drawBorder: false }, ticks: { color: '#94a3b8', font: { size: 9, weight: '700' } } },
                        x: { grid: { display: false }, ticks: { color: '#94a3b8', font: { size: 9, weight: '700' } } }
                    }
                }
            });

            // Helper to render expanded Query chart
            window.renderExpandedQueryChart = function() {
                const expandedCtx = document.getElementById('queryPulseChartExpanded').getContext('2d');
                const expandedGradient = expandedCtx.createLinearGradient(0, 0, 0, 600);
                expandedGradient.addColorStop(0, 'rgba(244, 63, 94, 0.2)');
                expandedGradient.addColorStop(1, 'rgba(244, 63, 94, 0)');

                new Chart(expandedCtx, {
                    type: 'line',
                    data: {
                        labels: @json($chartData['labels']),
                        datasets: [{
                            label: 'Queries',
                            data: @json($chartData['queries']),
                            borderColor: '#f43f5e',
                            backgroundColor: expandedGradient,
                            borderWidth: 4,
                            pointBackgroundColor: '#f43f5e',
                            pointBorderColor: '#fff',
                            pointHoverRadius: 8,
                            tension: 0.4,
                            fill: true
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { 
                            legend: { display: false },
                            tooltip: {
                                backgroundColor: '#0f172a',
                                titleFont: { size: 14, weight: '900' },
                                bodyFont: { size: 13, weight: '700' },
                                padding: 16,
                                cornerRadius: 16
                            }
                        },
                        scales: {
                            y: { beginAtZero: true, suggestedMax: 10, grid: { color: 'rgba(148, 163, 184, 0.2)', drawBorder: false }, ticks: { color: '#94a3b8', font: { size: 12, weight: '700' } } },
                            x: { grid: { display: false }, ticks: { color: '#94a3b8', font: { size: 12, weight: '700' } } }
                        }
                    }
                });
            };

            // Helper to render expanded Claim chart
            window.renderExpandedClaimChart = function() {
                const expandedCtx = document.getElementById('claimPulseChartExpanded').getContext('2d');
                const expandedGradient = expandedCtx.createLinearGradient(0, 0, 0, 600);
                expandedGradient.addColorStop(0, 'rgba(245, 158, 11, 0.2)');
                expandedGradient.addColorStop(1, 'rgba(245, 158, 11, 0)');

                new Chart(expandedCtx, {
                    type: 'line',
                    data: {
                        labels: @json($chartData['labels']),
                        datasets: [{
                            label: 'Claims',
                            data: @json($chartData['claims']),
                            borderColor: '#f59e0b',
                            backgroundColor: expandedGradient,
                            borderWidth: 4,
                            pointBackgroundColor: '#f59e0b',
                            pointBorderColor: '#fff',
                            pointHoverRadius: 8,
                            tension: 0.4,
                            fill: true
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { 
                            legend: { display: false },
                            tooltip: {
                                backgroundColor: '#0f172a',
                                titleFont: { size: 14, weight: '900' },
                                bodyFont: { size: 13, weight: '700' },
                                padding: 16,
                                cornerRadius: 16
                            }
                        },
                        scales: {
                            y: { beginAtZero: true, suggestedMax: 10, grid: { color: 'rgba(148, 163, 184, 0.2)', drawBorder: false }, ticks: { color: '#94a3b8', font: { size: 12, weight: '700' } } },
                            x: { grid: { display: false }, ticks: { color: '#94a3b8', font: { size: 12, weight: '700' } } }
                        }
                    }
                });
            };

            // 3. Revenue Forecast Chart
            const revenueCtx = document.getElementById('revenueForecastChart').getContext('2d');
            const revenueGradient = revenueCtx.createLinearGradient(0, 0, 0, 400);
            revenueGradient.addColorStop(0, 'rgba(16, 185, 129, 0.2)');
            revenueGradient.addColorStop(1, 'rgba(16, 185, 129, 0)');

            new Chart(revenueCtx, {
                type: 'line',
                data: {
                    labels: @json($revenueForecast['labels']),
                    datasets: [{
                        label: 'Expected Commission',
                        data: @json($revenueForecast['data']),
                        borderColor: '#10b981',
                        backgroundColor: revenueGradient,
                        borderWidth: 4,
                        pointBackgroundColor: '#10b981',
                        pointBorderColor: '#fff',
                        pointHoverRadius: 6,
                        pointRadius: 4,
                        tension: 0.35,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { 
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#0f172a',
                            titleFont: { size: 12, weight: '900' },
                            bodyFont: { size: 11, weight: '700' },
                            padding: 12,
                            cornerRadius: 12,
                            displayColors: false,
                            callbacks: {
                                label: function(context) {
                                    return '₹' + context.parsed.y.toLocaleString();
                                }
                            }
                        }
                    },
                    scales: {
                        y: { 
                            beginAtZero: true, 
                            grid: { color: 'rgba(0,0,0,0.03)', drawBorder: false }, 
                            ticks: { 
                                color: '#94a3b8', 
                                font: { size: 10, weight: '700' },
                                callback: function(value) { return '₹' + value.toLocaleString(); }
                            } 
                        },
                        x: { grid: { display: false }, ticks: { color: '#94a3b8', font: { size: 10, weight: '700' } } }
                    }
                }
            });

        });

        // Inject Calendar Data
        window.__SERVER_EVENTS = @json($calendar_events);

        function calendarData() {
            let initialEvents = window.__SERVER_EVENTS || [];
            return {
                date: new Date(),
                currentMonth: new Date().getMonth(),
                currentYear: new Date().getFullYear(),
                selectedDate: new Date().getDate(),
                selectedMonth: new Date().getMonth() + 1,
                events: Array.isArray(initialEvents) ? initialEvents : Object.values(initialEvents || {}),
                get days() {
                    let days = [];
                    let firstDay = new Date(this.currentYear, this.currentMonth, 1).getDay();
                    let daysInMonth = new Date(this.currentYear, this.currentMonth + 1, 0).getDate();

                    for (let i = 0; i < firstDay; i++) {
                        days.push({ day: null });
                    }

                    for (let i = 1; i <= daysInMonth; i++) {
                        let hasEvent = (this.events || []).some(e => e.day === i && e.month === (this.currentMonth + 1));
                        days.push({
                            day: i,
                            hasEvent,
                            isToday: i === new Date().getDate() && this.currentMonth === new Date().getMonth() && this.currentYear === new Date().getFullYear()
                        });
                    }
                    return days;
                },
                get monthName() {
                    return new Intl.DateTimeFormat('en-US', { month: 'long' }).format(new Date(this.currentYear, this.currentMonth));
                },
                get dailyEvents() {
                    return (this.events || []).filter(e => e.day === this.selectedDate && e.month === this.selectedMonth);
                },
                prevMonth() { this.currentMonth = (this.currentMonth === 0) ? 11 : this.currentMonth - 1; if (this.currentMonth === 11) this.currentYear--; },
                nextMonth() { this.currentMonth = (this.currentMonth === 11) ? 0 : this.currentMonth + 1; if (this.currentMonth === 0) this.currentYear++; },

                selectDay(d) {
                    if (d) {
                        this.selectedDate = d;
                        this.selectedMonth = this.currentMonth + 1;
                    }
                }
            };
        }
    </script>
</x-app-layout>