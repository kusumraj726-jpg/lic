<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <a href="{{ route('dashboard') }}" class="p-2 rounded-xl bg-slate-100 text-slate-500 hover:bg-slate-200 transition-all">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                </a>
                <h2 class="text-2xl font-black text-slate-800 uppercase tracking-tight">
                    {{ __('Claim Details') }}
                </h2>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('claims.edit', $claim->id) }}" class="px-6 py-2.5 rounded-2xl bg-indigo-600 text-white text-xs font-black uppercase tracking-widest hover:bg-indigo-700 shadow-lg shadow-indigo-100 transition-all">
                    Edit Record
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Main Details -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Status Header Card -->
                    <div class="premium-card bg-gradient-to-br from-indigo-600 to-indigo-900 border-none shadow-xl text-white">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                            <div>
                                <p class="text-[10px] font-black uppercase tracking-[0.2em] opacity-70 mb-2">Policy Number</p>
                                <h3 class="text-4xl font-black tracking-tighter">{{ $claim->policy_number }}</h3>
                            </div>
                            <div class="px-8 py-4 rounded-[2rem] bg-white/10 backdrop-blur-md border border-white/20">
                                <p class="text-[10px] font-black uppercase tracking-[0.2em] opacity-70 mb-1 text-center">Current Status</p>
                                <div class="text-xl font-black uppercase tracking-widest text-center
                                    @if($claim->status == 'approved') text-emerald-300 @elseif($claim->status == 'rejected') text-rose-300 @else text-amber-300 @endif">
                                    {{ $claim->status }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Details Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="premium-card bg-white border-none shadow-xl">
                            <h4 class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] mb-6">Financial Overview</h4>
                            <div class="space-y-6">
                                <div>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase mb-1">Claim Amount</p>
                                    <p class="text-2xl font-black text-slate-900 tracking-tight">₹ {{ number_format($claim->claim_amount, 2) }}</p>
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase mb-1">Policy Type</p>
                                    <p class="text-lg font-black text-indigo-600 uppercase tracking-wide">{{ $claim->policy_type }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="premium-card bg-white border-none shadow-xl">
                            <h4 class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] mb-6">Timeline</h4>
                            <div class="space-y-6">
                                <div>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase mb-1">Incident Date</p>
                                    <p class="text-lg font-black text-slate-900">{{ \Carbon\Carbon::parse($claim->incident_date)->format('d M, Y') }}</p>
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase mb-1">Logged At</p>
                                    <p class="text-lg font-black text-slate-900">{{ $claim->created_at->format('d M, Y H:i') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="premium-card bg-white border-none shadow-xl">
                        <h4 class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] mb-6">Claim Description & Notes</h4>
                        <div class="p-6 rounded-2xl bg-slate-50 border border-slate-100 text-slate-600 leading-relaxed italic">
                            {{ $claim->description ?? 'No detailed description provided for this claim.' }}
                        </div>
                    </div>
                </div>

                <!-- Sidebar Info -->
                <div class="space-y-8">
                    <!-- Client Card -->
                    <div class="premium-card bg-white border-none shadow-xl">
                        <h4 class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] mb-6">Associated Client</h4>
                        <div class="flex items-center gap-4 mb-6">
                            <div class="h-16 w-16 rounded-2xl bg-indigo-100 text-indigo-600 flex items-center justify-center text-2xl font-black">
                                {{ substr($claim->client->name, 0, 1) }}
                            </div>
                            <div>
                                <h4 class="text-lg font-black text-slate-900 uppercase tracking-tight">{{ $claim->client->name }}</h4>
                                <p class="text-xs font-bold text-slate-400">{{ $claim->client->email }}</p>
                            </div>
                        </div>
                        <div class="pt-6 border-t border-slate-50">
                            <a href="{{ route('clients.show', $claim->client_id) }}" class="flex items-center justify-center w-full py-3 rounded-xl bg-slate-50 text-[10px] font-black text-slate-600 uppercase tracking-[0.2em] hover:bg-indigo-50 hover:text-indigo-600 transition-all">
                                View Full Profile
                            </a>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="premium-card bg-slate-900 border-none shadow-2xl text-white">
                        <h4 class="text-[11px] font-black text-white/40 uppercase tracking-[0.2em] mb-6">System Info</h4>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between text-[10px]">
                                <span class="font-bold text-white/50 uppercase">Internal ID</span>
                                <span class="font-black">#CLM-{{ str_pad($claim->id, 5, '0', STR_PAD_LEFT) }}</span>
                            </div>
                            <div class="flex items-center justify-between text-[10px]">
                                <span class="font-bold text-white/50 uppercase">Database Record</span>
                                <span class="font-black text-emerald-400 uppercase tracking-widest">Active</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
