<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Velora Control Panel</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>body { font-family: 'Outfit', sans-serif; }</style>
</head>
<body class="bg-slate-950 text-slate-300 antialiased min-h-screen">

    <!-- Top Bar -->
    <header class="bg-slate-900 border-b border-slate-800 px-6 py-4 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <img src="{{ asset('images/logo.png') }}" class="h-8 w-auto" alt="Velora">
            <div>
                <h1 class="text-white font-black uppercase tracking-widest text-sm">Velora Control Panel</h1>
                <p class="text-slate-500 text-xs">Super Admin — Restricted Access</p>
            </div>
        </div>
        <div class="flex items-center gap-4">
            <span class="text-slate-400 text-sm font-medium">{{ auth()->user()->email }}</span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-xs bg-slate-800 hover:bg-slate-700 text-slate-300 px-4 py-2 rounded-lg font-bold uppercase tracking-widest transition-colors">
                    Logout
                </button>
            </form>
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="mb-6 bg-emerald-900/50 border border-emerald-500 text-emerald-300 px-6 py-3 rounded-xl text-sm font-medium">
                ✅ {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-6 bg-red-900/50 border border-red-500 text-red-300 px-6 py-3 rounded-xl text-sm font-medium">
                ❌ {{ session('error') }}
            </div>
        @endif

        <!-- Revenue Stats -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-10">
            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-5">
                <p class="text-slate-400 text-xs font-bold uppercase tracking-widest mb-1">Total Tenants</p>
                <p class="text-3xl font-black text-white">{{ $stats['total'] }}</p>
            </div>
            <div class="bg-emerald-900/30 border border-emerald-800 rounded-2xl p-5">
                <p class="text-emerald-400 text-xs font-bold uppercase tracking-widest mb-1">Active</p>
                <p class="text-3xl font-black text-white">{{ $stats['active'] }}</p>
            </div>
            <div class="bg-red-900/30 border border-red-800 rounded-2xl p-5">
                <p class="text-red-400 text-xs font-bold uppercase tracking-widest mb-1">Expired / Inactive</p>
                <p class="text-3xl font-black text-white">{{ $stats['expired'] }}</p>
            </div>
            <div class="bg-indigo-900/30 border border-indigo-800 rounded-2xl p-5">
                <p class="text-indigo-400 text-xs font-bold uppercase tracking-widest mb-1">Est. Revenue</p>
                <p class="text-3xl font-black text-white">₹{{ number_format($stats['total_revenue']) }}</p>
            </div>
        </div>

        <!-- Revenue Breakdown -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-10">
            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-5 flex items-center justify-between">
                <div>
                    <p class="text-slate-400 text-xs font-bold uppercase tracking-widest">Monthly MRR</p>
                    <p class="text-2xl font-black text-white mt-1">₹{{ number_format($stats['monthly_mrr']) }}</p>
                </div>
                <span class="bg-indigo-500/20 text-indigo-400 text-xs font-black px-3 py-1 rounded-full uppercase">@ ₹999/mo</span>
            </div>
            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-5 flex items-center justify-between">
                <div>
                    <p class="text-slate-400 text-xs font-bold uppercase tracking-widest">Yearly ARR</p>
                    <p class="text-2xl font-black text-white mt-1">₹{{ number_format($stats['yearly_arr']) }}</p>
                </div>
                <span class="bg-amber-500/20 text-amber-400 text-xs font-black px-3 py-1 rounded-full uppercase">@ ₹9,990/yr</span>
            </div>
            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-5 flex items-center justify-between">
                <div>
                    <p class="text-slate-400 text-xs font-bold uppercase tracking-widest">Trial Revenue</p>
                    <p class="text-2xl font-black text-white mt-1">₹{{ number_format($stats['trial_revenue']) }}</p>
                </div>
                <span class="bg-emerald-500/20 text-emerald-400 text-xs font-black px-3 py-1 rounded-full uppercase">@ ₹99/trial</span>
            </div>
        </div>

        <!-- Tenants Table -->
        <div class="bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-800 flex items-center justify-between">
                <h2 class="text-white font-black uppercase tracking-widest text-sm">All Registered Tenants</h2>
                <span class="text-slate-500 text-xs font-medium">{{ $tenants->where('role', 'admin')->count() }} total</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-slate-800">
                            <th class="px-6 py-3 text-left text-xs font-black text-slate-400 uppercase tracking-widest">Company</th>
                            <th class="px-6 py-3 text-left text-xs font-black text-slate-400 uppercase tracking-widest">Admin Name</th>
                            <th class="px-6 py-3 text-left text-xs font-black text-slate-400 uppercase tracking-widest">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-black text-slate-400 uppercase tracking-widest">Plan</th>
                            <th class="px-6 py-3 text-left text-xs font-black text-slate-400 uppercase tracking-widest">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-black text-slate-400 uppercase tracking-widest">Expires</th>
                            <th class="px-6 py-3 text-left text-xs font-black text-slate-400 uppercase tracking-widest">Joined</th>
                            <th class="px-6 py-3 text-left text-xs font-black text-slate-400 uppercase tracking-widest">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800">
                        @forelse($tenants->where('role', 'admin') as $tenant)
                        <tr class="hover:bg-slate-800/50 transition-colors">
                            <td class="px-6 py-4 font-bold text-white">{{ $tenant->company_name ?? '—' }}</td>
                            <td class="px-6 py-4 text-slate-300">{{ $tenant->name }}</td>
                            <td class="px-6 py-4 text-slate-400 font-mono text-xs">{{ $tenant->email }}</td>
                            <td class="px-6 py-4">
                                @php
                                    $planColors = [
                                        'monthly' => 'bg-indigo-500/20 text-indigo-400',
                                        'yearly'  => 'bg-amber-500/20 text-amber-400',
                                        'trial'   => 'bg-emerald-500/20 text-emerald-400',
                                        default   => 'bg-slate-700 text-slate-400',
                                    ];
                                    $plan = $tenant->subscription_plan ?? 'none';
                                    $color = $planColors[$plan] ?? $planColors['default'];
                                @endphp
                                <span class="px-2 py-1 rounded text-[11px] font-black uppercase {{ $color }}">{{ $plan }}</span>
                            </td>
                            <td class="px-6 py-4">
                                @if($tenant->hasActiveSubscription())
                                    <span class="flex items-center gap-1.5 text-emerald-400 font-bold text-xs">
                                        <span class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></span>Active
                                    </span>
                                @else
                                    <span class="flex items-center gap-1.5 text-red-400 font-bold text-xs">
                                        <span class="w-2 h-2 bg-red-400 rounded-full"></span>Inactive
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-slate-400 text-xs">
                                @if($tenant->subscription_ends_at)
                                    @php
                                        try {
                                            $endsAt = \Illuminate\Support\Carbon::parse($tenant->subscription_ends_at);
                                        } catch (\Exception $e) {
                                            $endsAt = null;
                                        }
                                    @endphp

                                    @if($endsAt)
                                        <span class="{{ $endsAt->isPast() ? 'text-red-400' : 'text-slate-300' }}">
                                            {{ $endsAt->format('d M Y') }}
                                        </span>
                                        <br>
                                        <span class="text-slate-600 text-[10px]">
                                            {{ $endsAt->isPast() ? 'Expired ' . $endsAt->diffForHumans() : 'Expires ' . $endsAt->diffForHumans() }}
                                        </span>
                                    @else
                                        <span class="text-slate-400">{{ $tenant->subscription_ends_at }}</span>
                                    @endif
                                @else
                                    <span class="text-slate-600">Not set</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-slate-500 text-xs">
                                @php
                                    try {
                                        $joinedLabel = \Illuminate\Support\Carbon::parse($tenant->created_at)->format('d M Y');
                                    } catch (\Exception $e) {
                                        $joinedLabel = '—';
                                    }
                                @endphp
                                {{ $joinedLabel }}
                            </td>
                            <td class="px-6 py-4">
                                <form method="POST" action="{{ route('superadmin.toggle', $tenant) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                        onclick="return confirm('Toggle subscription status for {{ $tenant->company_name }}?')"
                                        class="{{ $tenant->hasActiveSubscription() ? 'bg-red-900/50 hover:bg-red-800 text-red-400 border-red-800' : 'bg-emerald-900/50 hover:bg-emerald-800 text-emerald-400 border-emerald-800' }} px-3 py-1.5 rounded-lg text-xs font-black uppercase tracking-widest border transition-colors">
                                        {{ $tenant->hasActiveSubscription() ? 'Suspend' : 'Activate' }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center text-slate-600 font-medium">No tenants registered yet.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</body>
</html>
