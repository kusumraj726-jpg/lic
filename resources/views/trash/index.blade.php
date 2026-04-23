<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-8">
            <h2 class="font-black text-3xl text-slate-900 uppercase tracking-tight dark:text-slate-100">
                TRASH
            </h2>
            
            <div class="flex items-center gap-2.5 px-4 h-11 rounded-[1.25rem] bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 shadow-sm relative overflow-hidden group">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rose-500 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-rose-500"></span>
                </span>
                <span class="relative text-[10px] font-black text-slate-900 dark:text-slate-100 uppercase tracking-[0.15em]">Simulation Active</span>
            </div>
        </div>
    </x-slot>

    <div class="py-6" x-data="{ tab: 'clients' }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-10 px-2">
                <div>
                    <h2 class="text-3xl font-black text-slate-900 uppercase tracking-tight dark:text-white">Data Recovery Hub</h2>
                    <p class="text-slate-400 dark:text-slate-500 text-[10px] font-bold uppercase tracking-widest mt-1">Review and restore recently deleted records from the system.</p>
                </div>
                <div>
                    <button class="inline-flex items-center gap-2 bg-rose-600 text-white px-6 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-lg shadow-rose-200 hover:bg-rose-500 transition-all">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                        Empty Bin
                    </button>
                </div>
            </div>

            <!-- Tab Navigation (Simulation Style) -->
            <div class="flex items-center flex-wrap gap-2 mb-8 bg-slate-50 dark:bg-slate-900/50 p-1 rounded-[1.25rem] w-fit border border-slate-100 dark:border-slate-800">
                <button @click="tab = 'clients'" 
                    :class="tab === 'clients' ? 'bg-white dark:bg-slate-800 shadow-sm text-rose-600 dark:text-rose-400' : 'text-slate-400 hover:text-slate-600 dark:text-slate-500'"
                    class="px-6 py-2 rounded-xl text-[9px] font-black uppercase tracking-[0.2em] transition-all duration-300">
                    Clients
                </button>
                <button @click="tab = 'queries'" 
                    :class="tab === 'queries' ? 'bg-white dark:bg-slate-800 shadow-sm text-rose-600 dark:text-rose-400' : 'text-slate-400 hover:text-slate-600 dark:text-slate-500'"
                    class="px-6 py-2 rounded-xl text-[9px] font-black uppercase tracking-[0.2em] transition-all duration-300">
                    Queries
                </button>
                <button @click="tab = 'claims'" 
                    :class="tab === 'claims' ? 'bg-white dark:bg-slate-800 shadow-sm text-rose-600 dark:text-rose-400' : 'text-slate-400 hover:text-slate-600 dark:text-slate-500'"
                    class="px-6 py-2 rounded-xl text-[9px] font-black uppercase tracking-[0.2em] transition-all duration-300">
                    Claims
                </button>
                <button @click="tab = 'renewals'" 
                    :class="tab === 'renewals' ? 'bg-white dark:bg-slate-800 shadow-sm text-rose-600 dark:text-rose-400' : 'text-slate-400 hover:text-slate-600 dark:text-slate-500'"
                    class="px-6 py-2 rounded-xl text-[9px] font-black uppercase tracking-[0.2em] transition-all duration-300">
                    Renewals
                </button>
                <button @click="tab = 'staff'" 
                    :class="tab === 'staff' ? 'bg-white dark:bg-slate-800 shadow-sm text-rose-600 dark:text-rose-400' : 'text-slate-400 hover:text-slate-600 dark:text-slate-500'"
                    class="px-6 py-2 rounded-xl text-[9px] font-black uppercase tracking-[0.2em] transition-all duration-300">
                    Staff
                </button>
            </div>

            <!-- Tab Content -->
            <div class="premium-card overflow-hidden !p-0 border-none shadow-2xl">
                <!-- Clients Tab -->
                <div x-show="tab === 'clients'" x-cloak>
                    @include('trash.partials.table', ['items' => $deletedClients, 'type' => 'client', 'title' => 'Deleted Clients'])
                </div>

                <!-- Queries Tab -->
                <div x-show="tab === 'queries'" x-cloak>
                    @include('trash.partials.table', ['items' => $deletedQueries, 'type' => 'query', 'title' => 'Deleted Queries'])
                </div>

                <!-- Claims Tab -->
                <div x-show="tab === 'claims'" x-cloak>
                    @include('trash.partials.table', ['items' => $deletedClaims, 'type' => 'claim', 'title' => 'Deleted Claims'])
                </div>

                <!-- Renewals Tab -->
                <div x-show="tab === 'renewals'" x-cloak>
                    @include('trash.partials.table', ['items' => $deletedRenewals, 'type' => 'renewal', 'title' => 'Deleted Renewals'])
                </div>

                <!-- Staff Tab -->
                <div x-show="tab === 'staff'" x-cloak>
                    @if(isset($deletedStaff))
                        @include('trash.partials.table', ['items' => $deletedStaff, 'type' => 'staff', 'title' => 'Deleted Staff'])
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
