<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-extrabold text-2xl text-slate-900 uppercase tracking-tight dark:text-slate-100">
                {{ __('Client Profile') }}
            </h2>
            <div class="flex gap-3">
                <a href="{{ route('clients.index') }}" class="premium-btn text-xs bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-300 border border-slate-200 dark:border-slate-700">
                    Back to List
                </a>
                <a href="{{ route('clients.edit', $client) }}" class="premium-btn premium-btn-primary !px-6 flex items-center gap-2">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                    Edit Profile
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Column: Profile Card -->
                <div class="lg:col-span-1">
                    <div class="premium-card text-center relative overflow-hidden">
                        <div class="absolute top-0 inset-x-0 h-24 bg-gradient-to-r from-indigo-500 to-purple-600 opacity-10"></div>
                        
                        <div class="relative pt-8 pb-6 flex flex-col items-center">
                            <div class="h-32 w-32 rounded-[2.5rem] bg-indigo-100 dark:bg-slate-800 p-1 mb-4 shadow-xl">
                                @if($client->photo)
                                    <img src="{{ $client->photo_url }}" class="h-full w-full object-cover rounded-[2.25rem] border-4 border-white dark:border-slate-900">
                                @else
                                    <div class="h-full w-full flex items-center justify-center bg-indigo-50 dark:bg-slate-900 rounded-[2.25rem] text-indigo-500 text-4xl font-black border-4 border-white dark:border-slate-800 uppercase">
                                        {{ substr($client->name, 0, 1) }}
                                    </div>
                                @endif
                            </div>
                            <h3 class="text-2xl font-black text-slate-900 dark:text-white">{{ $client->name }}</h3>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">Policyholder</p>
                            
                            <div class="mt-8 grid grid-cols-2 gap-4 w-full px-4">
                                <div class="p-3 bg-slate-50 dark:bg-slate-800/50 rounded-2xl border border-slate-100 dark:border-slate-700">
                                    <p class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase">Gender</p>
                                    <p class="text-sm font-bold text-slate-700 dark:text-slate-200 mt-0.5">{{ $client->gender ?: 'N/A' }}</p>
                                </div>
                                <div class="p-3 bg-slate-50 dark:bg-slate-800/50 rounded-2xl border border-slate-100 dark:border-slate-700">
                                    <p class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase">Status</p>
                                    <div class="flex items-center justify-center gap-1.5 mt-1">
                                        <div class="h-2 w-2 rounded-full bg-emerald-500"></div>
                                        <p class="text-xs font-black text-emerald-600 dark:text-emerald-400 tracking-tight">ACTIVE</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Card -->
                    <div class="premium-card mt-8 p-6">
                        <h4 class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-[0.2em] mb-6">Contact & Details</h4>
                        
                        <div class="space-y-6">
                            <div class="flex items-start gap-4">
                                <div class="h-10 w-10 flex-shrink-0 bg-indigo-50 dark:bg-indigo-900/20 rounded-xl flex items-center justify-center text-indigo-500">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                                </div>
                                <div>
                                    <p class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Email Address</p>
                                    <p class="text-sm font-bold text-slate-700 dark:text-slate-100 break-all">{{ $client->email ?: 'Not provided' }}</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <div class="h-10 w-10 flex-shrink-0 bg-emerald-50 dark:bg-emerald-900/20 rounded-xl flex items-center justify-center text-emerald-500">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 5z" /></svg>
                                </div>
                                <div>
                                    <p class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Phone Number</p>
                                    <p class="text-sm font-bold text-slate-700 dark:text-slate-100">{{ $client->phone ?: 'Not provided' }}</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <div class="h-10 w-10 flex-shrink-0 bg-amber-50 dark:bg-amber-900/20 rounded-xl flex items-center justify-center text-amber-500">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                </div>
                                <div>
                                    <p class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Date of Birth</p>
                                    <p class="text-sm font-bold text-slate-700 dark:text-slate-100">
                                        {{ $client->dob ? \Carbon\Carbon::parse($client->dob)->format('d M Y') : 'Not provided' }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4 pt-4 border-t border-slate-50 dark:border-slate-800">
                                <div class="h-10 w-10 flex-shrink-0 bg-blue-50 dark:bg-blue-900/20 rounded-xl flex items-center justify-center text-blue-500">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                </div>
                                <div>
                                    <p class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Address</p>
                                    <p class="text-sm font-bold text-slate-700 dark:text-slate-200 italic leading-relaxed">{{ $client->address ?: 'No address specified' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Policy Details -->
                <div class="lg:col-span-2">
                    <div class="premium-card p-8 h-full">
                        <div class="flex items-center gap-4 mb-10">
                            <div class="h-14 w-14 rounded-2xl bg-indigo-500 flex items-center justify-center text-white shadow-xl shadow-indigo-200 dark:shadow-none">
                                <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                            </div>
                            <div>
                                <h3 class="text-2xl font-black text-slate-900 dark:text-white uppercase tracking-tighter">Insurance Master Policy</h3>
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">THE SOURCE OF TRUTH FOR ALL FUTURE ENTRIES</p>
                            </div>
                        </div>

                        @if($latestPolicy)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="p-6 bg-slate-50 dark:bg-slate-900/50 rounded-[2rem] border border-slate-100 dark:border-slate-800 transition-all hover:bg-white dark:hover:bg-slate-800 hover:shadow-xl group">
                                <p class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2 group-hover:text-indigo-500">Policy Number</p>
                                <p class="text-3xl font-black text-slate-900 dark:text-white font-mono tracking-tighter">{{ $latestPolicy->policy_number }}</p>
                            </div>
                            
                            <div class="p-6 bg-slate-50 dark:bg-slate-900/50 rounded-[2rem] border border-slate-100 dark:border-slate-800 transition-all hover:bg-white dark:hover:bg-slate-800 hover:shadow-xl group">
                                <p class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2 group-hover:text-indigo-500">Premium Amount</p>
                                <p class="text-3xl font-black text-slate-900 dark:text-white tracking-tighter">₹{{ number_format($latestPolicy->premium_amount, 2) }}</p>
                            </div>

                            <div class="p-6 bg-slate-50 dark:bg-slate-900/50 rounded-[2rem] border border-slate-100 dark:border-slate-800 transition-all hover:bg-white dark:hover:bg-slate-800 hover:shadow-xl group">
                                <p class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2 group-hover:text-amber-500">Commission Rate</p>
                                <div class="flex items-end gap-2">
                                    <p class="text-5xl font-black text-amber-500 tracking-tighter">{{ $latestPolicy->custom_commission_rate ?: (auth()->user()->commission_rates[$latestPolicy->policy_type] ?? '0') }}</p>
                                    <span class="text-2xl font-black text-amber-500 mb-1">%</span>
                                </div>
                                <p class="text-[9px] font-bold text-slate-400 uppercase mt-4 tracking-widest">
                                    {{ $latestPolicy->custom_commission_rate ? 'CUSTOM OVERRIDE ACTIVE' : 'SYSTEM GLOBAL DEFAULT' }}
                                </p>
                            </div>

                            <div class="p-6 bg-slate-50 dark:bg-slate-900/50 rounded-[2rem] border border-slate-100 dark:border-slate-800 transition-all hover:bg-white dark:hover:bg-slate-800 hover:shadow-xl group border-l-4 border-l-indigo-500">
                                <p class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2 group-hover:text-indigo-500">Policy Category</p>
                                <p class="text-2xl font-black text-slate-800 dark:text-slate-100 uppercase italic">{{ $latestPolicy->policy_type }}</p>
                                <p class="text-[9px] font-bold text-indigo-400 uppercase mt-4 tracking-widest leading-relaxed">
                                    Renewals and Claims created for this client will automatically inherit these settings.
                                </p>
                            </div>
                        </div>

                        <div class="mt-12 p-8 bg-indigo-500 rounded-[2.5rem] text-white shadow-2xl shadow-indigo-300 dark:shadow-none flex flex-col md:flex-row items-center justify-between gap-6">
                            <div class="text-center md:text-left">
                                <h4 class="text-xl font-black uppercase italic tracking-tighter line-clamp-1">Quick Shortcut</h4>
                                <p class="text-sm font-bold text-indigo-100 mt-1">Manage this client's finances in the main tracker</p>
                            </div>
                            <div class="flex gap-4">
                                <a href="{{ route('commissions.index') }}" class="px-8 py-3 bg-white text-indigo-600 rounded-xl font-black text-sm uppercase tracking-widest hover:scale-105 transition-transform">
                                    Go to Commissions
                                </a>
                            </div>
                        </div>
                        @else
                        <div class="flex flex-col items-center justify-center py-20 text-center">
                            <div class="h-20 w-20 bg-slate-50 dark:bg-slate-800 rounded-full flex items-center justify-center text-slate-300 dark:text-slate-600 mb-4">
                                <svg class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </div>
                            <h4 class="text-lg font-black text-slate-800 dark:text-slate-300 uppercase italic">No Master Policy Found</h4>
                            <p class="text-sm font-bold text-slate-400 mt-2 max-w-xs">Register a policy in the Edit profile page to enable automatic tracking features.</p>
                            <a href="{{ route('clients.edit', $client) }}" class="mt-8 text-indigo-500 font-black uppercase text-xs tracking-widest border-b-2 border-indigo-500 pb-1 hover:text-indigo-600 transition-colors">Setup Master Record Now</a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
