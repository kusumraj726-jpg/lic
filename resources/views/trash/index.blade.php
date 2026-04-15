<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-slate-900 uppercase tracking-tight dark:text-slate-100">
            {{ __('System Trash Bin') }}
        </h2>
    </x-slot>

    <div class="py-6" x-data="{ tab: 'clients' }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <h1 class="text-3xl font-black text-slate-900 dark:text-slate-100">Data Recovery Hub</h1>
                <p class="text-slate-500 mt-1 dark:text-slate-400">Review, restore, or permanently purge your soft-deleted records.</p>
            </div>

            <!-- Tab Navigation (Elite Design) -->
            <div class="flex items-center flex-wrap gap-2 mb-8 bg-slate-100/50 dark:bg-slate-800/80 p-1.5 rounded-2xl w-fit">
                <button @click="tab = 'clients'" 
                    :class="tab === 'clients' ? 'bg-white dark:bg-slate-700 shadow-md text-indigo-600 dark:text-indigo-400' : 'text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-200'"
                    class="px-6 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest transition-all duration-300">
                    Clients ({{ $deletedClients->count() }})
                </button>
                <button @click="tab = 'queries'" 
                    :class="tab === 'queries' ? 'bg-white dark:bg-slate-700 shadow-md text-indigo-600 dark:text-indigo-400' : 'text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-200'"
                    class="px-6 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest transition-all duration-300">
                    Queries ({{ $deletedQueries->count() }})
                </button>
                <button @click="tab = 'claims'" 
                    :class="tab === 'claims' ? 'bg-white dark:bg-slate-700 shadow-md text-indigo-600 dark:text-indigo-400' : 'text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-200'"
                    class="px-6 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest transition-all duration-300">
                    Claims ({{ $deletedClaims->count() }})
                </button>
                <button @click="tab = 'renewals'" 
                    :class="tab === 'renewals' ? 'bg-white dark:bg-slate-700 shadow-md text-indigo-600 dark:text-indigo-400' : 'text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-200'"
                    class="px-6 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest transition-all duration-300">
                    Renewals ({{ $deletedRenewals->count() }})
                </button>
                <button @click="tab = 'staff'" 
                    :class="tab === 'staff' ? 'bg-white dark:bg-slate-700 shadow-md text-indigo-600 dark:text-indigo-400' : 'text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-200'"
                    class="px-6 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest transition-all duration-300">
                    Staff Profiles ({{ isset($deletedStaff) ? $deletedStaff->count() : 0 }})
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
