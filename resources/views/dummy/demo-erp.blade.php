<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NexoraByte ERP | Performance Command Center</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/premium.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 4px; height: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
        
        .aura { position: absolute; width: 100%; height: 100%; filter: blur(140px); opacity: 0.25; pointer-events: none; }
        .grid-overlay {
            position: fixed; inset: 0;
            background-image: radial-gradient(#e2e8f0 1px, transparent 1px);
            background-size: 32px 32px; opacity: 0.4; pointer-events: none;
        }

        /* Sync with Production Layout but standalone */
        .demo-layout { display: flex; min-height: 100vh; background: #fdfdff; }
        .demo-content { flex: 1; margin-left: 280px; padding: 40px; }
        
        /* Glass Sidebar Sync */
        .glass-sidebar {
            width: 280px; height: 100vh; position: fixed; left: 0; top: 0;
            background: white; border-right: 1px solid #f1f5f9;
            padding: 24px 20px; display: flex; flex-direction: column; z-index: 50;
        }

        .nav-item {
            display: flex; items-center: center; gap: 12px; padding: 12px 16px;
            border-radius: 12px; color: #64748b; font-weight: 600; font-size: 14px;
            transition: all 0.3s; margin-bottom: 4px; border: 1px solid transparent;
        }
        .nav-item:hover { background: #f8fafc; color: #0f172a; }
        .nav-item.active { background: #fff1f2; color: #e11d48; border-color: #ffe4e6; }
        .nav-item svg { width: 20px; height: 20px; }

        /* Interface Container Styling */
        .interface-wrapper {
            background: white; border-radius: 3rem;
            box-shadow: 0 50px 100px -20px rgba(0,0,0,0.05);
            border: 1px solid rgba(0,0,0,0.02);
            overflow: hidden; min-height: 800px; display: flex; flex-direction: column;
        }
    </style>
</head>

<body class="font-sans antialiased text-slate-900 overflow-x-hidden" x-data="{ 
    activeTab: 'dashboard',
    calendarSelected: {{ date('d') }},
    monthName: '{{ date('F') }}'
}">
    
    <!-- Production Background System -->
    <div class="fixed inset-0 z-[-1] overflow-hidden pointer-events-none">
        <div class="absolute inset-0 bg-[#fdfdff]"></div>
        <div class="absolute top-[-10%] left-[-10%] w-[60%] h-[60%] bg-indigo-500/20 rounded-full blur-[140px] animate-pulse"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[50%] h-[50%] bg-rose-500/20 rounded-full blur-[120px] animate-pulse"></div>
        <div class="grid-overlay"></div>
    </div>

    <!-- Standalone Header Navigation (NexoraByte Branding) -->
    <nav class="fixed w-full z-50 bg-white/80 backdrop-blur-md border-b border-gray-100 h-16 flex items-center">
        <div class="max-w-[1440px] mx-auto w-full px-10 flex justify-between items-center">
            <div class="flex items-center gap-10">
                <a href="/" class="flex items-center gap-3">
                    <div class="h-8 w-8 rounded-lg bg-slate-900 flex items-center justify-center text-white font-black text-sm uppercase">N</div>
                    <span class="text-lg font-black text-slate-900 tracking-[0.2em] uppercase">nexorabyte</span>
                </a>
                <a href="{{ route('services') }}" class="flex items-center gap-2 text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 hover:text-rose-600 transition-colors group">
                    <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
                    Back to Services
                </a>
            </div>
            <div class="flex items-center gap-8">
                <a href="#" class="text-[11px] font-semibold uppercase tracking-widest text-slate-700 hover:text-rose-600">Sign In</a>
                <a href="#" class="bg-rose-600 text-white text-[11px] font-bold px-6 py-2.5 rounded-full uppercase tracking-widest hover:bg-rose-500 shadow-lg shadow-rose-200">Subscription Models</a>
            </div>
        </div>
    </nav>

    <!-- UI Implementation -->
    <div class="pt-24 pb-20 px-10 max-w-[1600px] mx-auto">
        <div class="interface-wrapper">
            <div class="flex flex-1">
                <!-- Exact Replica Sidebar -->
                <aside class="w-[280px] bg-white border-r border-slate-100 flex flex-col p-8 shrink-0">
                    <div class="mb-10">
                        <div class="flex items-center gap-4">
                            <div class="h-10 w-10 rounded-xl bg-rose-600 text-white flex items-center justify-center font-black text-xl shadow-lg">V</div>
                            <div>
                                <h2 class="text-sm font-black text-slate-900 uppercase tracking-tight">Vantage ERP</h2>
                                <div class="flex items-center gap-1.5 mt-0.5">
                                    <div class="h-1 w-1 rounded-full bg-emerald-500 animate-pulse"></div>
                                    <p class="text-[8px] font-bold text-slate-400 uppercase tracking-widest">Live Digital Replica</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <nav class="flex-1 space-y-1">
                        <template x-for="item in [
                            { id: 'dashboard', label: 'Dashboard', icon: 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6' },
                            { id: 'clients', label: 'Clients', icon: 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z' },
                            { id: 'queries', label: 'Queries', icon: 'M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z' },
                            { id: 'claims', label: 'Claims', icon: 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z' },
                            { id: 'renewals', label: 'Renewals', icon: 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z' },
                            { id: 'commissions', label: 'Commissions', icon: 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z' },
                            { id: 'staff', label: 'Staff Management', icon: 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z' },
                            { id: 'trash', label: 'Trash Bin', icon: 'M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16' }
                        ]">
                            <button @click="activeTab = item.id" 
                                    class="nav-item w-full"
                                    :class="activeTab === item.id ? 'active' : ''">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="item.icon" /></svg>
                                <span x-text="item.label"></span>
                            </button>
                        </template>
                    </nav>

                    <div class="mt-auto pt-6 border-t border-slate-100">
                        <div class="flex items-center gap-3">
                            <div class="h-9 w-9 rounded-lg bg-indigo-500 text-white flex items-center justify-center font-black text-xs uppercase">D</div>
                            <div>
                                <h3 class="text-[11px] font-black text-slate-900 uppercase">Demo User</h3>
                                <p class="text-[8px] font-bold text-slate-400">Guest Access</p>
                            </div>
                        </div>
                    </div>
                </aside>

                <main class="flex-1 bg-white p-12 overflow-y-auto custom-scrollbar h-[880px]">
                    <!-- Header -->
                    <div class="flex items-center justify-between mb-12">
                        <h1 class="text-2xl font-black text-slate-900 uppercase tracking-tight" x-text="activeTab"></h1>
                        <div class="flex items-center gap-2.5 px-4 h-11 rounded-2xl border border-slate-100 shadow-sm">
                            <span class="flex h-2 w-2 relative">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rose-500 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-rose-500"></span>
                            </span>
                            <span class="text-[10px] font-black text-slate-900 uppercase tracking-widest">Simulation Active</span>
                        </div>
                    </div>

                    <!-- DASHBOARD -->
                    <div x-show="activeTab === 'dashboard'" class="space-y-10">
                        <!-- Stats Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-5 gap-6">
                            @foreach([
                                ['label' => 'Clients', 'value' => $stats['clients_count'], 'desc' => 'Total Clients', 'color' => 'from-indigo-600 to-indigo-800', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z'],
                                ['label' => 'Queries', 'value' => $stats['open_queries'], 'desc' => 'Open Queries', 'color' => 'from-rose-500 to-rose-700', 'icon' => 'M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z'],
                                ['label' => 'Claims', 'value' => $stats['pending_claims'], 'desc' => 'Active Claims', 'color' => 'from-amber-500 to-orange-700', 'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'],
                                ['label' => 'Renewals', 'value' => $stats['upcoming_renewals'], 'desc' => 'Active Renewals', 'color' => 'from-emerald-600 to-teal-800', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                                ['label' => 'Revenue', 'value' => '₹12.4M', 'desc' => 'Total Revenue', 'color' => 'from-fuchsia-500 to-pink-700', 'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z']
                            ] as $stat)
                            <div class="p-6 rounded-[2rem] bg-gradient-to-br {{ $stat['color'] }} text-white relative overflow-hidden shadow-xl">
                                <div class="absolute -right-4 -top-4 w-16 h-16 bg-white/10 rounded-full blur-2xl"></div>
                                <div class="flex items-center gap-3 mb-6">
                                    <div class="h-9 w-9 rounded-xl bg-white/20 flex items-center justify-center backdrop-blur-sm">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $stat['icon'] }}" /></svg>
                                    </div>
                                    <span class="text-[9px] font-black uppercase tracking-widest opacity-80">{{ $stat['label'] }}</span>
                                </div>
                                <div class="text-3xl font-black mb-1">{{ $stat['value'] }}</div>
                                <div class="text-[8px] font-bold uppercase tracking-widest opacity-60">{{ $stat['desc'] }}</div>
                            </div>
                            @endforeach
                        </div>

                        <div class="grid lg:grid-cols-12 gap-8">
                            <!-- Left: Priority Diagnostic -->
                            <div class="lg:col-span-8 space-y-8">
                                <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl p-8">
                                    <div class="flex items-center justify-between mb-8">
                                        <h3 class="text-sm font-black text-slate-900 uppercase tracking-tight flex items-center gap-3">
                                            Priority Diagnostic
                                            <span class="px-2 py-0.5 rounded-full bg-rose-50 text-[8px] font-black text-rose-600 uppercase tracking-widest border border-rose-100">Live Pulse</span>
                                        </h3>
                                        <div class="text-[10px] font-black px-4 py-1.5 rounded-xl bg-slate-50 border border-slate-100">3 ALERTS</div>
                                    </div>
                                    <div class="space-y-4">
                                        @foreach($urgent_items as $item)
                                        <div class="flex items-center justify-between p-5 bg-slate-50/50 rounded-3xl border border-slate-100 group transition-all hover:bg-white hover:shadow-lg">
                                            <div class="flex items-center gap-5">
                                                <div class="h-10 w-10 rounded-xl bg-{{ $item->color }}-100 text-{{ $item->color }}-600 flex items-center justify-center text-lg">
                                                    @if($item->type === 'Query') 💬 @elseif($item->type === 'Claim') 🛡️ @else ⏳ @endif
                                                </div>
                                                <div>
                                                    <h4 class="text-[13px] font-black text-slate-900 uppercase">{{ $item->client_name }}</h4>
                                                    <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">{{ $item->type }} • Pending {{ $item->time }}</p>
                                                </div>
                                            </div>
                                            <button class="text-[9px] font-black text-rose-600 uppercase bg-rose-50 px-4 py-1.5 rounded-lg opacity-0 group-hover:opacity-100 transition-all">Resolve Case</button>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Charts Grid -->
                                <div class="grid md:grid-cols-2 gap-8">
                                    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl p-8">
                                        <div class="flex items-center justify-between mb-8">
                                            <div>
                                                <h3 class="text-xs font-black text-slate-900 uppercase tracking-tight">Query Intelligence</h3>
                                                <p class="text-[8px] font-bold text-slate-400 uppercase tracking-widest mt-0.5">7-Day Volume</p>
                                            </div>
                                            <div class="text-rose-500">💬</div>
                                        </div>
                                        <div class="h-48"><canvas id="queryChart"></canvas></div>
                                    </div>
                                    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl p-8">
                                        <div class="flex items-center justify-between mb-8">
                                            <div>
                                                <h3 class="text-xs font-black text-slate-900 uppercase tracking-tight">Claim Analytics</h3>
                                                <p class="text-[8px] font-bold text-slate-400 uppercase tracking-widest mt-0.5">Processing Metrics</p>
                                            </div>
                                            <div class="text-amber-500">🛡️</div>
                                        </div>
                                        <div class="h-48"><canvas id="claimChart"></canvas></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Right: Intelligence Sidebar -->
                            <div class="lg:col-span-4 space-y-8">
                                <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl p-8 min-h-[350px]">
                                    <div class="flex items-center justify-between mb-8">
                                        <h3 class="text-[10px] font-black text-slate-900 uppercase tracking-[0.2em] flex items-center gap-3">
                                            <div class="h-1.5 w-1.5 rounded-full bg-indigo-500 animate-pulse"></div>
                                            Relationship Intel
                                        </h3>
                                        <span class="text-[9px] font-black text-indigo-600 px-3 py-1 bg-indigo-50 rounded-full" x-text="calendarSelected + ' ' + monthName"></span>
                                    </div>
                                    <div class="space-y-4">
                                        @foreach($calendar_events as $event)
                                        <div class="p-4 rounded-3xl bg-slate-50 border border-slate-100 flex items-center gap-4 group transition-all hover:bg-white hover:shadow-lg">
                                            <div class="h-10 w-10 rounded-xl bg-{{ $event['c'] }}-100 text-{{ $event['c'] }}-600 flex items-center justify-center text-lg shadow-sm">
                                                {{ $event['i'] }}
                                            </div>
                                            <div>
                                                <h5 class="text-[12px] font-black text-slate-900 uppercase">{{ $event['name'] }}</h5>
                                                <p class="text-[9px] font-bold text-{{ $event['c'] }}-600 uppercase tracking-widest">{{ $event['title'] }}</p>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Mini Calendar -->
                                <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl p-8">
                                    <h3 class="text-xs font-black text-slate-900 uppercase tracking-widest mb-6" x-text="monthName"></h3>
                                    <div class="grid grid-cols-7 gap-1">
                                        <template x-for="i in Array.from({length: 31}, (_, i) => i + 1)">
                                            <div @click="calendarSelected = i"
                                                 class="aspect-square rounded-lg flex items-center justify-center text-[10px] font-bold cursor-pointer transition-all"
                                                 :class="calendarSelected === i ? 'bg-slate-900 text-white' : 'text-slate-400 hover:bg-slate-50'"
                                                 x-text="i"></div>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Placeholder for other tabs -->
                    <div x-show="activeTab !== 'dashboard'" class="py-20 text-center">
                        <div class="text-slate-300 text-4xl mb-4">⚙️</div>
                        <h3 class="text-xl font-black text-slate-900 uppercase tracking-tight" x-text="activeTab + ' Module Simulation'"></h3>
                        <p class="text-slate-500 font-medium">Detailed interface simulation available in production build.</p>
                    </div>
                </main>
            </div>
        </div>
    </div>

    <!-- Chart Implementation clones production behavior -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const chartOptions = {
                responsive: true, maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: { 
                    y: { display: false },
                    x: { grid: { display: false }, ticks: { font: { weight: 'bold', size: 9 }, color: '#94a3b8' } }
                }
            };

            const qCtx = document.getElementById('queryChart').getContext('2d');
            new Chart(qCtx, {
                type: 'line',
                data: {
                    labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                    datasets: [{
                        data: [12, 19, 8, 15, 12, 9, 14], borderColor: '#e11d48', borderWidth: 3, tension: 0.4, pointRadius: 0
                    }]
                },
                options: chartOptions
            });

            const cCtx = document.getElementById('claimChart').getContext('2d');
            new Chart(cCtx, {
                type: 'line',
                data: {
                    labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                    datasets: [{
                        data: [5, 8, 12, 7, 10, 15, 11], borderColor: '#f59e0b', borderWidth: 3, tension: 0.4, pointRadius: 0
                    }]
                },
                options: chartOptions
            });
        });
    </script>
</body>
</html>
