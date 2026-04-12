<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-slate-900 uppercase tracking-tight">
            {{ __('ERP Command Center') }}
        </h2>
    </x-slot>

    <div class="py-6" x-data="{ }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- 1. Stats Grid (Restored High-Fidelity Colors) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-10">
                <!-- Total Clients Card -->
                <a href="{{ route('clients.index') }}" class="group block rounded-[2.5rem] overflow-hidden border-none shadow-xl hover:shadow-2xl hover:scale-[1.02] transition-all duration-300 relative bg-gradient-to-br from-indigo-600 to-indigo-800">
                    <div class="absolute -right-4 -top-4 w-24 h-24 bg-white/10 rounded-full blur-2xl group-hover:bg-white/20 transition-all"></div>
                    <div class="p-9 relative z-10">
                        <div class="flex items-center gap-4 mb-8">
                            <div class="h-14 w-14 flex items-center justify-center bg-white/20 rounded-2xl backdrop-blur-md shadow-inner">
                                <svg class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                            </div>
                            <span class="text-[11px] font-black text-white uppercase tracking-[0.2em] opacity-90">Client Module</span>
                        </div>
                        <div class="text-6xl font-black text-white mb-2 tracking-tighter">{{ $stats['clients_count'] }}</div>
                        <div class="text-xs font-bold text-indigo-100 uppercase tracking-widest opacity-80">Total Clients</div>
                    </div>
                    <div class="px-9 py-5 bg-black/10 flex items-center justify-between group-hover:bg-black/20 transition-all">
                        <span class="text-[10px] font-black text-white uppercase tracking-widest">Active Business Units</span>
                        <svg class="h-4 w-4 text-white translate-x-0 group-hover:translate-x-1.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                    </div>
                </a>

                <!-- Open Queries Card -->
                <a href="{{ route('queries.index') }}" class="group block rounded-[2.5rem] overflow-hidden border-none shadow-xl hover:shadow-2xl hover:scale-[1.02] transition-all duration-300 relative bg-gradient-to-br from-rose-500 to-rose-700">
                    <div class="absolute -right-4 -top-4 w-24 h-24 bg-white/10 rounded-full blur-2xl group-hover:bg-white/20 transition-all"></div>
                    <div class="p-9 relative z-10">
                        <div class="flex items-center gap-4 mb-8">
                            <div class="h-14 w-14 flex items-center justify-center bg-white/20 rounded-2xl backdrop-blur-md shadow-inner">
                                <svg class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" /></svg>
                            </div>
                            <span class="text-[11px] font-black text-white uppercase tracking-[0.2em] opacity-90">Query Pulse</span>
                        </div>
                        <div class="text-6xl font-black text-white mb-2 tracking-tighter">{{ $stats['open_queries'] }}</div>
                        <div class="text-xs font-bold text-rose-50 uppercase tracking-widest opacity-80">Active Queries</div>
                    </div>
                    <div class="px-9 py-5 bg-black/10 flex items-center justify-between group-hover:bg-black/20 transition-all border-t border-white/5">
                        <span class="text-[10px] font-black text-white uppercase tracking-widest">Immediate Attention Required</span>
                        <svg class="h-4 w-4 text-white translate-x-0 group-hover:translate-x-1.5 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                    </div>
                </a>

                <!-- Pending Claims Card -->
                <a href="{{ route('claims.index') }}" class="group block rounded-[2.5rem] overflow-hidden border-none shadow-xl hover:shadow-2xl hover:scale-[1.02] transition-all duration-300 relative bg-gradient-to-br from-amber-500 to-orange-600">
                    <div class="absolute -right-4 -top-4 w-24 h-24 bg-white/10 rounded-full blur-2xl group-hover:bg-white/20 transition-all"></div>
                    <div class="p-9 relative z-10">
                        <div class="flex items-center gap-4 mb-8">
                            <div class="h-14 w-14 flex items-center justify-center bg-white/20 rounded-2xl backdrop-blur-md shadow-inner">
                                <svg class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                            </div>
                            <span class="text-[11px] font-black text-white uppercase tracking-[0.2em] opacity-90">Claim Status</span>
                        </div>
                        <div class="text-6xl font-black text-white mb-2 tracking-tighter">{{ $stats['pending_claims'] }}</div>
                        <div class="text-xs font-bold text-amber-50 uppercase tracking-widest opacity-80">Active Claims</div>
                    </div>
                    <div class="px-9 py-5 bg-black/10 flex items-center justify-between group-hover:bg-black/20 transition-all border-t border-white/5">
                        <span class="text-[10px] font-black text-white uppercase tracking-widest">Processing in Progress</span>
                        <svg class="h-4 w-4 text-white translate-x-0 group-hover:translate-x-1.5 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                    </div>
                </a>

                <!-- Upcoming Renewals Card -->
                <a href="{{ route('renewals.index') }}" class="group block rounded-[2.5rem] overflow-hidden border-none shadow-xl hover:shadow-2xl hover:scale-[1.02] transition-all duration-300 relative bg-gradient-to-br from-emerald-600 to-teal-800">
                    <div class="absolute -right-4 -top-4 w-24 h-24 bg-white/10 rounded-full blur-2xl group-hover:bg-white/20 transition-all"></div>
                    <div class="p-9 relative z-10">
                        <div class="flex items-center gap-4 mb-8">
                            <div class="h-14 w-14 flex items-center justify-center bg-white/20 rounded-2xl backdrop-blur-md shadow-inner">
                                <svg class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </div>
                            <span class="text-[11px] font-black text-white uppercase tracking-[0.2em] opacity-90">Revenue Stream</span>
                        </div>
                        <div class="text-6xl font-black text-white mb-2 tracking-tighter">{{ $stats['upcoming_renewals'] }}</div>
                        <div class="text-xs font-bold text-emerald-50 uppercase tracking-widest opacity-80">Upcoming Renewals</div>
                    </div>
                    <div class="px-9 py-5 bg-black/10 flex items-center justify-between group-hover:bg-black/20 transition-all">
                        <span class="text-[10px] font-black text-white uppercase tracking-widest">Policy Anniversary Pipeline</span>
                        <svg class="h-4 w-4 text-white translate-x-0 group-hover:translate-x-1.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                    </div>
                </a>
            </div>

            <!-- 2. Main Dashboard Command Center -->
            <div class="space-y-8">

                <!-- 1. Performance Pulses -->
                <div class="space-y-8">
                    <!-- Query Intelligence Card -->
                    <div class="premium-card bg-white border-none shadow-xl transition-all duration-300">
                        <div class="flex items-center justify-between mb-8 px-2">
                            <div>
                                <h3 class="text-xl font-black text-slate-900 uppercase tracking-tight">Query Intelligence</h3>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Incoming Volume Analysis</p>
                            </div>
                            <div class="h-12 w-12 rounded-[1.25rem] bg-rose-50 text-rose-500 flex items-center justify-center shadow-sm border border-rose-100/50">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" /></svg>
                            </div>
                        </div>
                        <div class="h-[22rem] px-2">
                            <canvas id="queryPulseChart"></canvas>
                        </div>
                    </div>

                    <!-- Claim Analytics Card -->
                    <div class="premium-card bg-white border-none shadow-xl transition-all duration-300">
                        <div class="flex items-center justify-between mb-8 px-2">
                            <div>
                                <h3 class="text-xl font-black text-slate-900 uppercase tracking-tight">Claim Analytics</h3>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Case Volume Diagnostics</p>
                            </div>
                            <div class="h-12 w-12 rounded-[1.25rem] bg-amber-50 text-amber-500 flex items-center justify-center shadow-sm border border-amber-100/50">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                            </div>
                        </div>
                        <div class="h-[22rem] px-2">
                            <canvas id="claimPulseChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- 2. Priority Diagnostic Hub -->
                <div class="premium-card bg-white border-none shadow-2xl relative overflow-hidden group">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-rose-50/50 rounded-full blur-3xl -mr-16 -mt-16"></div>
                    <div class="relative z-10 flex items-center justify-between mb-8">
                        <div class="flex items-center gap-4">
                            <div class="h-12 w-12 rounded-2xl bg-slate-900 flex items-center justify-center shadow-lg shadow-slate-200">
                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-black text-slate-900 uppercase tracking-tight flex items-center gap-3">
                                    Priority Diagnostic
                                    <div class="flex items-center gap-1.5 px-2 py-0.5 rounded-full bg-rose-50 border border-rose-100">
                                        <div class="h-1.5 w-1.5 rounded-full bg-rose-500 animate-pulse"></div>
                                        <span class="text-[9px] font-black text-rose-600 uppercase tracking-widest">Live Pulse</span>
                                    </div>
                                </h3>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-0.5">High-Authority Operational Alerts</p>
                            </div>
                        </div>
                        <span class="text-[11px] font-black text-slate-900 px-4 py-1.5 rounded-xl bg-slate-50 border border-slate-100 shadow-sm">{{ $urgent_items->count() }} ALERTS</span>
                    </div>
                    <div class="space-y-4 relative z-10">
                        @forelse($urgent_items as $item)
                        <a href="{{ $item->url }}" class="flex items-center gap-5 p-5 rounded-[2rem] bg-slate-50/50 border border-slate-50 group/item hover:bg-white hover:shadow-2xl hover:border-indigo-100 transition-all duration-300 transform hover:-translate-y-1">
                            <div class="h-14 w-14 rounded-2xl flex items-center justify-center transition-all duration-300 shadow-inner"
                                 :class="{
                                    'bg-rose-50 text-rose-600 group-hover/item:bg-rose-600 group-hover/item:text-white': '{{ $item->type }}' === 'Query',
                                    'bg-amber-50 text-amber-600 group-hover/item:bg-amber-600 group-hover/item:text-white': '{{ $item->type }}' === 'Claim',
                                    'bg-emerald-50 text-emerald-600 group-hover/item:bg-emerald-600 group-hover/item:text-white': '{{ $item->type }}' === 'Renewal'
                                 }">
                                @if($item->type === 'Query')
                                    <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" /></svg>
                                @elseif($item->type === 'Claim')
                                    <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                                @else
                                    <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="text-[10px] font-black uppercase tracking-[0.15em] px-2.5 py-0.5 rounded-lg"
                                          :class="{
                                            'bg-rose-100 text-rose-700': '{{ $item->type }}' === 'Query',
                                            'bg-amber-100 text-amber-700': '{{ $item->type }}' === 'Claim',
                                            'bg-emerald-100 text-emerald-700': '{{ $item->type }}' === 'Renewal'
                                          }">{{ $item->type }}</span>
                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ $item->created_at->diffForHumans() }}</span>
                                </div>
                                <h4 class="text-sm font-black text-slate-900 uppercase tracking-tight truncate group-hover/item:text-indigo-600 transition-colors">{{ $item->client->name ?? 'External Protocol' }}</h4>
                                <div class="flex items-center gap-3 mt-2">
                                    <div class="flex items-center gap-1.5 text-[9px] font-bold text-rose-600 uppercase tracking-wider">
                                        <div class="h-1 w-1 rounded-full bg-rose-600"></div>
                                        Critical Pending
                                    </div>
                                    @if($item->type === 'Renewal')
                                        <div class="text-[9px] font-bold text-slate-400 uppercase">Exp: {{ \Carbon\Carbon::parse($item->expiry_date)->format('M d') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="opacity-0 group-hover/item:opacity-100 transition-all transform translate-x-2 group-hover/item:translate-x-0">
                                <div class="h-10 w-10 rounded-full bg-slate-900 text-white flex items-center justify-center shadow-lg">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                                </div>
                            </div>
                        </a>
                        @empty
                        <div class="text-center py-20 px-8 rounded-[2.5rem] border-2 border-dashed border-slate-100 bg-slate-50/30">
                            <div class="h-20 w-20 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center mx-auto mb-6 shadow-inner">
                                <svg class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </div>
                            <h3 class="text-[11px] font-black text-emerald-900 uppercase tracking-[0.2em]">Clinical All-Clear</h3>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-2">Zero critical pending items detected in diagnostic sweep</p>
                        </div>
                        @endforelse
                    </div>
                </div>

                <!-- 3. Birthday Pulse Calendar -->
                <div x-data="calendarData()" class="premium-card bg-white border-none shadow-xl overflow-hidden ring-1 ring-slate-100 animate-fade-in-up">
                    <div class="grid grid-cols-1 lg:grid-cols-3">
                        <!-- Calendar Grid (2/3 width) -->
                        <div class="lg:col-span-2 p-10 border-r border-slate-50">
                            <div class="flex items-center justify-between mb-12">
                                <div>
                                    <h3 class="text-2xl font-black text-slate-900 uppercase tracking-tight" x-text="monthName + ' ' + currentYear"></h3>
                                    <div class="flex items-center gap-2 mt-2">
                                        <div class="h-1.5 w-1.5 rounded-full bg-indigo-500"></div>
                                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Team &amp; Client Birthdays</p>
                                    </div>
                                </div>
                                <div class="flex gap-4">
                                    <button @click="prevMonth" class="h-12 w-12 rounded-2xl bg-white hover:bg-slate-50 text-slate-400 hover:text-slate-900 flex items-center justify-center transition-all border border-slate-100 shadow-sm">
                                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
                                    </button>
                                    <button @click="nextMonth" class="h-12 w-12 rounded-2xl bg-white hover:bg-slate-50 text-slate-400 hover:text-slate-900 flex items-center justify-center transition-all border border-slate-100 shadow-sm">
                                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                                    </button>
                                </div>
                            </div>

                            <div class="grid grid-cols-7 gap-3 mb-4">
                                <template x-for="dayName in ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT']">
                                    <div class="text-center text-[10px] font-black text-slate-300 uppercase tracking-[0.2em] py-2" x-text="dayName"></div>
                                </template>
                            </div>

                            <div class="grid grid-cols-7 gap-3">
                                <template x-for="(day, index) in days" :key="index">
                                    <div
                                        @click="selectDay(day.day)"
                                        class="aspect-square rounded-[1.5rem] flex flex-col items-center justify-center relative cursor-pointer transition-all duration-300 group shadow-sm border"
                                        :class="{
                                            'bg-slate-50/30 border-transparent hover:bg-white hover:shadow-xl hover:border-indigo-100 hover:scale-105': day.day,
                                            'bg-gradient-to-br from-indigo-600 to-indigo-800 border-indigo-700 text-white shadow-2xl shadow-indigo-200 scale-110 z-10': day.day === selectedDate && (currentMonth + 1) === selectedMonth,
                                            'ring-4 ring-indigo-50 border-indigo-200': day.isToday && day.day !== selectedDate,
                                            'opacity-0 pointer-events-none': !day.day
                                        }"
                                    >
                                        <span class="text-base font-black transition-colors" :class="day.day === selectedDate && (currentMonth + 1) === selectedMonth ? 'text-white' : 'text-slate-900 group-hover:text-indigo-600'" x-text="day.day"></span>
                                        <div class="flex gap-1.5 absolute bottom-4">
                                            <template x-if="day.hasBirthday">
                                                <div class="h-1.5 w-1.5 rounded-full" :class="day.day === selectedDate && (currentMonth + 1) === selectedMonth ? 'bg-white' : 'bg-indigo-500 shadow-sm shadow-indigo-200'"></div>
                                            </template>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <!-- Birthday Pulse Feed (1/3 width) -->
                        <div class="bg-slate-50/30 p-10">
                            <div class="flex items-center justify-between mb-10">
                                <h4 class="text-[11px] font-black text-slate-900 uppercase tracking-[0.2em] flex items-center gap-3">
                                    <div class="h-2 w-2 rounded-full bg-indigo-600 animate-pulse"></div>
                                    Birthday Pulse
                                </h4>
                                <span class="text-[10px] font-bold text-slate-400 uppercase" x-text="selectedMonth + '/' + selectedDate"></span>
                            </div>
                            <div class="space-y-4">
                                <template x-if="dailyEvents.length === 0">
                                    <div class="flex flex-col items-center justify-center py-16 text-center">
                                        <div class="h-20 w-20 rounded-3xl bg-white flex items-center justify-center mb-6 shadow-sm border border-slate-100">
                                            <svg class="h-8 w-8 text-slate-200" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                        </div>
                                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest leading-loose max-w-[12rem]">No birthdays noted for <span class="text-slate-900 font-black" x-text="selectedDate + ' ' + monthName"></span></p>
                                    </div>
                                </template>
                                <template x-for="(event, i) in dailyEvents" :key="i">
                                    <div class="p-6 rounded-3xl bg-white shadow-sm border border-slate-100 flex items-start gap-5 transform transition-all hover:scale-[1.02] hover:shadow-md group">
                                        <div class="h-12 w-12 rounded-2xl flex items-center justify-center flex-shrink-0 transition-all bg-brand/10 text-brand group-hover:bg-brand group-hover:text-white">
                                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.703 2.703 0 01-3 0 2.703 2.703 0 01-3 0 2.703 2.703 0 01-3 0 2.704 2.704 0 01-1.5-.454M3 8v4.5a2.5 2.5 0 005 0V8a2.5 2.5 0 015 0v4.5a2.5 2.5 0 005 0V8a2.5 2.5 0 015 0v4.5a2.5 2.5 0 005 0V8" /></svg>
                                        </div>
                                        <div>
                                            <h5 class="text-sm font-black text-slate-900 uppercase tracking-tight mb-1" x-text="event.title"></h5>
                                            <div class="flex items-center gap-2">
                                                <div class="h-1 w-1 rounded-full bg-slate-200"></div>
                                                <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Personal Milestone</p>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>
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
            const queryGradient = queryCtx.createLinearGradient(0, 0, 0, 400);
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
                        borderWidth: 4,
                        pointBackgroundColor: '#f43f5e',
                        pointBorderColor: '#fff',
                        pointHoverRadius: 6,
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, suggestedMax: 10, grid: { color: 'rgba(0,0,0,0.05)', drawBorder: false }, ticks: { color: '#94a3b8', font: { size: 9, weight: '800' } } },
                        x: { grid: { display: false }, ticks: { color: '#94a3b8', font: { size: 9, weight: '800' } } }
                    }
                }
            });

            // 2. Claim Analytics Chart
            const claimCtx = document.getElementById('claimPulseChart').getContext('2d');
            const claimGradient = claimCtx.createLinearGradient(0, 0, 0, 400);
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
                        borderWidth: 4,
                        pointBackgroundColor: '#f59e0b',
                        pointBorderColor: '#fff',
                        pointHoverRadius: 6,
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, suggestedMax: 10, grid: { color: 'rgba(0,0,0,0.05)', drawBorder: false }, ticks: { color: '#94a3b8', font: { size: 9, weight: '800' } } },
                        x: { grid: { display: false }, ticks: { color: '#94a3b8', font: { size: 9, weight: '800' } } }
                    }
                }
            });

        });

        // Inject Calendar Data into global scope to prevent Alpine attribute parsing errors
        window.__SERVER_EVENTS = @json($calendar_events);

        // Alpine.js Calendar Logic
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
                        let hasBirthday = (this.events || []).some(e => e.day === i && e.month === (this.currentMonth + 1));
                        days.push({ 
                            day: i, 
                            hasBirthday, 
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
                prevMonth() {
                    if (this.currentMonth === 0) {
                        this.currentMonth = 11;
                        this.currentYear--;
                    } else {
                        this.currentMonth--;
                    }
                },
                nextMonth() {
                    if (this.currentMonth === 11) {
                        this.currentMonth = 0;
                        this.currentYear++;
                    } else {
                        this.currentMonth++;
                    }
                },
                selectDay(d) {
                    if(d) {
                        this.selectedDate = d;
                        this.selectedMonth = this.currentMonth + 1;
                    }
                }
            };
        }
    </script>
</x-app-layout>
