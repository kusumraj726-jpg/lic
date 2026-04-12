<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-slate-900 uppercase tracking-tight">
            {{ __('ERP Command Center') }}
        </h2>
    </x-slot>

    <div class="py-6" x-data="{ }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- 1. Stats Grid (Precision Aligned) -->
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
                        <span class="text-[10px] font-black text-white uppercase tracking-widest">View Clients</span>
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
                            <span class="text-[11px] font-black text-white uppercase tracking-[0.2em] opacity-90">Query Module</span>
                        </div>
                        <div class="text-6xl font-black text-white mb-2 tracking-tighter">{{ $stats['open_queries'] }}</div>
                        <div class="text-xs font-bold text-rose-50 uppercase tracking-widest opacity-80">Open Queries</div>
                    </div>
                    <div class="px-9 py-5 bg-black/10 flex items-center justify-between group-hover:bg-black/20 transition-all">
                        <span class="text-[10px] font-black text-white uppercase tracking-widest">View Queries</span>
                        <svg class="h-4 w-4 text-white translate-x-0 group-hover:translate-x-1.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
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
                            <span class="text-[11px] font-black text-white uppercase tracking-[0.2em] opacity-90">Claim Module</span>
                        </div>
                        <div class="text-6xl font-black text-white mb-2 tracking-tighter">{{ $stats['pending_claims'] }}</div>
                        <div class="text-xs font-bold text-amber-50 uppercase tracking-widest opacity-80">Pending Claims</div>
                    </div>
                    <div class="px-9 py-5 bg-black/10 flex items-center justify-between group-hover:bg-black/20 transition-all">
                        <span class="text-[10px] font-black text-white uppercase tracking-widest">View Claims</span>
                        <svg class="h-4 w-4 text-white translate-x-0 group-hover:translate-x-1.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
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
                            <span class="text-[11px] font-black text-white uppercase tracking-[0.2em] opacity-90">Renewal Module</span>
                        </div>
                        <div class="text-6xl font-black text-white mb-2 tracking-tighter">{{ $stats['upcoming_renewals'] }}</div>
                        <div class="text-xs font-bold text-emerald-50 uppercase tracking-widest opacity-80">Due Renewals</div>
                    </div>
                    <div class="px-9 py-5 bg-black/10 flex items-center justify-between group-hover:bg-black/20 transition-all">
                        <span class="text-[10px] font-black text-white uppercase tracking-widest">View Renewals</span>
                        <svg class="h-4 w-4 text-white translate-x-0 group-hover:translate-x-1.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                    </div>
                </a>
            </div>

            <!-- 2. Main Dashboard Grid (Aligned 2:1 Layout) -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
                
                <!-- Left Column: Primary Data (2/3 width) -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Monthly Performance Chart -->
                    <div class="premium-card bg-white border-none shadow-xl">
                        <div class="flex items-center justify-between mb-8">
                            <div>
                                <h3 class="text-lg font-black text-slate-900 uppercase tracking-tight">Monthly Performance</h3>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Claims vs Queries (Last 6 Months)</p>
                            </div>
                            <div class="flex gap-4">
                                <div class="flex items-center gap-1.5">
                                    <div class="w-3 h-3 rounded-full bg-rose-500"></div>
                                    <span class="text-[9px] font-black text-slate-500 uppercase tracking-widest">Queries</span>
                                </div>
                                <div class="flex items-center gap-1.5">
                                    <div class="w-3 h-3 rounded-full bg-amber-500"></div>
                                    <span class="text-[9px] font-black text-slate-500 uppercase tracking-widest">Claims</span>
                                </div>
                            </div>
                        </div>
                        <div class="h-72">
                            <canvas id="performanceChart"></canvas>
                        </div>
                    </div>

                    <!-- Live Activity Feed -->
                    <div class="premium-card bg-white border-none shadow-xl">
                        <div class="flex items-center justify-between mb-8">
                            <div>
                                <h3 class="text-lg font-black text-slate-900 uppercase tracking-tight">Live Activity Feed</h3>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Real-time status updates across modules</p>
                            </div>
                        </div>
                        <div class="space-y-4">
                            @forelse($activities as $activity)
                            <a href="{{ $activity->activity_url }}" class="flex items-center gap-4 p-4 rounded-2xl bg-slate-50/50 border border-slate-50 group hover:border-indigo-100 hover:bg-white hover:shadow-lg hover:scale-[1.01] transition-all duration-300">
                                <div class="h-12 w-12 rounded-xl bg-{{ $activity->activity_color }}-100 text-{{ $activity->activity_color }}-600 flex items-center justify-center transition-transform group-hover:scale-110">
                                    {!! $activity->activity_icon !!}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between mb-0.5">
                                        <h4 class="text-[11px] font-black text-slate-900 uppercase tracking-wide truncate group-hover:text-indigo-600 transition-colors">
                                            {{ $activity->activity_type }}: {{ $activity->client->name ?? 'External' }}
                                        </h4>
                                        <span class="text-[9px] font-bold text-slate-400 uppercase">{{ $activity->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-tight truncate">{{ $activity->subject ?? 'Record Update' }}</p>
                                </div>
                                <div class="opacity-0 group-hover:opacity-100 transition-opacity">
                                    <svg class="h-4 w-4 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                                </div>
                            </a>
                            @empty
                            <div class="text-center py-12">
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">No recent activities observed</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Right Column: Sidebar & Actions (1/3 width) -->
                <div class="space-y-8">
                    <!-- Priority Alerts / Attention Required -->
                    @if($urgent_items->count() > 0)
                    <div class="premium-card bg-rose-50 border-rose-100 shadow-xl shadow-rose-100/30">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="h-10 w-10 rounded-xl bg-rose-600 flex items-center justify-center animate-pulse shadow-lg shadow-rose-200">
                                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                            </div>
                            <div>
                                <h3 class="text-[11px] font-black text-rose-900 uppercase tracking-[0.2em] leading-tight">Attention Required</h3>
                                <p class="text-[9px] font-bold text-rose-600 uppercase">{{ $urgent_items->count() }} Critical Items</p>
                            </div>
                        </div>
                        <div class="space-y-3">
                            @foreach($urgent_items as $item)
                            <a href="{{ $item->url }}" class="flex flex-col p-4 rounded-2xl bg-white/70 border border-white hover:bg-white hover:shadow-md transition-all group">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-[10px] font-black text-{{ $item->color }}-600 uppercase tracking-widest">{{ $item->type }}</span>
                                    <span class="text-[9px] font-bold text-slate-400 uppercase">{{ $item->created_at->diffForHumans() }}</span>
                                </div>
                                <h4 class="text-xs font-black text-slate-900 uppercase tracking-tight group-hover:text-indigo-600 transition-colors">{{ $item->client->name ?? 'External System' }}</h4>
                                <div class="mt-3 flex items-center justify-between">
                                    <span class="text-[9px] font-bold text-rose-500 uppercase flex items-center gap-1">
                                        <div class="h-1 w-1 rounded-full bg-rose-500"></div>
                                        Action Delayed
                                    </span>
                                    <svg class="h-3 w-3 text-slate-300 group-hover:text-indigo-500 transition-all transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @else
                    <div class="premium-card bg-emerald-50 border-emerald-100 shadow-sm border-dashed">
                        <div class="flex flex-col items-center text-center py-6">
                            <div class="h-10 w-10 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center mb-3">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                            </div>
                            <h3 class="text-[10px] font-black text-emerald-900 uppercase tracking-widest">All Clear</h3>
                            <p class="text-[9px] font-bold text-emerald-600 uppercase mt-1">No urgent attention required</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

        </div>
    </div>

    <!-- Chart.js and Data Implementation -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('performanceChart').getContext('2d');
            
            // Premium Indigo Theme Gradient
            const primaryGradient = ctx.createLinearGradient(0, 0, 0, 400);
            primaryGradient.addColorStop(0, 'rgba(79, 70, 229, 0.1)');
            primaryGradient.addColorStop(1, 'rgba(79, 70, 229, 0)');

            const secondaryGradient = ctx.createLinearGradient(0, 0, 0, 400);
            secondaryGradient.addColorStop(0, 'rgba(244, 63, 94, 0.1)');
            secondaryGradient.addColorStop(1, 'rgba(244, 63, 94, 0)');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json($chartData['labels']),
                    datasets: [
                        {
                            label: 'Queries',
                            data: @json($chartData['queries']),
                            borderColor: '#f43f5e',
                            backgroundColor: secondaryGradient,
                            borderWidth: 4,
                            pointBackgroundColor: '#f43f5e',
                            pointBorderColor: '#fff',
                            pointHoverRadius: 6,
                            tension: 0.4,
                            fill: true
                        },
                        {
                            label: 'Claims',
                            data: @json($chartData['claims']),
                            borderColor: '#f59e0b',
                            backgroundColor: primaryGradient,
                            borderWidth: 4,
                            pointBackgroundColor: '#f59e0b',
                            pointBorderColor: '#fff',
                            pointHoverRadius: 6,
                            tension: 0.4,
                            fill: true
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            suggestedMax: 10,
                            grid: { color: 'rgba(0,0,0,0.05)', drawBorder: false },
                            ticks: { 
                                color: '#94a3b8', 
                                font: { size: 10, weight: '800' },
                                padding: 10
                            }
                        },
                        x: {
                            grid: { display: false },
                            ticks: { 
                                color: '#94a3b8', 
                                font: { size: 10, weight: '800' },
                                padding: 10
                            }
                        }
                    }
                }
            });
        });

        // Alpine.js Calendar Logic
        function calendarData(initialEvents) {
            return {
                date: new Date(),
                currentMonth: new Date().getMonth(),
                currentYear: new Date().getFullYear(),
                selectedDate: new Date().getDate(),
                selectedMonth: new Date().getMonth() + 1,
                events: initialEvents,
                get days() {
                    let days = [];
                    let firstDay = new Date(this.currentYear, this.currentMonth, 1).getDay();
                    let daysInMonth = new Date(this.currentYear, this.currentMonth + 1, 0).getDate();
                    
                    for (let i = 0; i < firstDay; i++) {
                        days.push({ day: null });
                    }
                    
                    for (let i = 1; i <= daysInMonth; i++) {
                        let hasBirthday = this.events.some(e => e.day === i && e.month === (this.currentMonth + 1) && e.type === 'birthday');
                        let hasRenewal = this.events.some(e => e.day === i && e.month === (this.currentMonth + 1) && hasRenewal === true); // Note: Fix here if needed
                         let hasRenewalReal = this.events.some(e => e.day === i && e.month === (this.currentMonth + 1) && e.type === 'renewal');
                        days.push({ 
                            day: i, 
                            hasBirthday, 
                            hasRenewal: hasRenewalReal,
                            isToday: i === new Date().getDate() && this.currentMonth === new Date().getMonth() && this.currentYear === new Date().getFullYear()
                        });
                    }
                    return days;
                },
                get monthName() {
                    return new Intl.DateTimeFormat('en-US', { month: 'long' }).format(new Date(this.currentYear, this.currentMonth));
                },
                get dailyEvents() {
                    return this.events.filter(e => e.day === this.selectedDate && e.month === this.selectedMonth);
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
