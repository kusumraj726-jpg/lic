<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="stylesheet" href="{{ asset('css/premium.css') }}">

        <!-- Dynamic Branding -->
        <style>
            :root {
                --brand-primary: {{ auth()->user()->context()->brand_color ?? '#4f46e5' }};
                --brand-primary-light: {{ (auth()->user()->context()->brand_color ?? '#4f46e5') . '15' }};
            }
            .text-brand { color: var(--brand-primary); }
            .bg-brand { background-color: var(--brand-primary); }
            .border-brand { border-color: var(--brand-primary); }
            .hover\:bg-brand:hover { background-color: var(--brand-primary); }
            .nav-item.active { 
                background-color: var(--brand-primary-light) !important; 
                color: var(--brand-primary) !important;
                border-color: var(--brand-primary) !important;
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-slate-50/50">
        <div class="erp-layout bg-[radial-gradient(#e5e7eb_1px,transparent_1px)] [background-size:24px_24px]">
            @auth
                @include('layouts.sidebar')
            @endauth

            <div class="erp-content">
                @auth
                    <!-- Persistent Top Bar -->
                    <header class="bg-white/80 backdrop-blur-md border-b border-gray-100 py-3 px-10 sticky top-0 z-30 shadow-sm">
                        <div class="max-w-7xl mx-auto flex items-center justify-between">
                            <div>
                                @isset($header)
                                    {{ $header }}
                                @else
                                    <h2 class="font-extrabold text-2xl text-slate-900 uppercase tracking-tight">
                                        {{ __('Dashboard') }}
                                    </h2>
                                @endisset
                            </div>

                            <!-- User Profile & Intelligence Hub Dropdown -->
                            <div class="flex items-center gap-4" x-data="{ open: false, intelOpen: false }" @click.away="open = false; intelOpen = false">
                                
                                <!-- Velora Intelligence Hub Pill (Shared Across Pages) -->
                                @if(isset($global_intel) && $global_intel->count() > 0)
                                <div class="relative">
                                    <button @click="intelOpen = !intelOpen" 
                                            class="flex items-center gap-2.5 px-4 h-11 rounded-[1.25rem] bg-white border border-slate-100 shadow-sm hover:shadow-md hover:scale-[1.02] transition-all group relative overflow-hidden">
                                        <div class="absolute inset-0 bg-brand/5 group-hover:bg-brand/10 transition-colors"></div>
                                        <span class="relative flex h-2 w-2">
                                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-brand opacity-75"></span>
                                            <span class="relative inline-flex rounded-full h-2 w-2 bg-brand shadow-[0_0_8px_rgba(var(--brand-primary-rgb),0.5)]"></span>
                                        </span>
                                        <span class="relative text-[10px] font-black text-slate-900 uppercase tracking-[0.15em]">Intelligence</span>
                                        <span class="relative flex items-center justify-center h-5 w-5 rounded-lg bg-brand text-[9px] font-black text-white ml-1">
                                            {{ $global_intel->count() }}
                                        </span>
                                    </button>

                                    <!-- Intelligence Dropdown Panel -->
                                    <div x-show="intelOpen" 
                                         x-transition:enter="transition ease-out duration-200"
                                         x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                                         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                         class="absolute right-0 mt-3 w-80 origin-top-right rounded-[2rem] bg-white shadow-2xl shadow-slate-200 border border-slate-100 p-8 z-50 overflow-hidden" 
                                         style="display: none;">
                                        
                                        <div class="flex items-center justify-between mb-8">
                                            <h4 class="text-[11px] font-black text-slate-900 uppercase tracking-[0.2em] flex items-center gap-2">
                                                Velora Intelligence
                                            </h4>
                                            <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Live Pulse</span>
                                        </div>

                                        <div class="space-y-4 max-h-[25rem] overflow-y-auto pr-2 custom-scrollbar">
                                            @foreach($global_intel as $brief)
                                            <div class="flex items-start gap-4 p-4 rounded-3xl bg-slate-50 border border-slate-50 hover:border-brand/20 transition-all group">
                                                <div class="h-10 w-10 shrink-0 rounded-2xl bg-{{ $brief['type'] === 'warning' ? 'rose' : ($brief['type'] === 'success' ? 'emerald' : ($brief['type'] === 'info' ? 'blue' : 'brand')) }}-100 text-{{ $brief['type'] === 'warning' ? 'rose' : ($brief['type'] === 'success' ? 'emerald' : ($brief['type'] === 'info' ? 'blue' : 'brand')) }}-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                                                    @if($brief['type'] === 'warning')
                                                        <!-- Query/Warning Icon -->
                                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                                        </svg>
                                                    @elseif($brief['type'] === 'success')
                                                        <!-- Renewal Continuity Icon (Synced with Sidebar) -->
                                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                    @elseif($brief['type'] === 'info')
                                                        <!-- Claim Case Icon -->
                                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                        </svg>
                                                    @else
                                                        <!-- Birthday Milestone (Isometric) -->
                                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 7l4 2m-4-2l-4 2m4-2V3" />
                                                        </svg>
                                                    @endif
                                                </div>
                                                <div>
                                                    <h5 class="text-xs font-black text-slate-800 uppercase tracking-tight">{{ $brief['title'] }}</h5>
                                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1 leading-relaxed">{{ $brief['message'] }}</p>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @endif

                                <div class="relative">
                                    <button @click="open = !open" class="flex items-center gap-3 p-1 rounded-xl hover:bg-slate-50 transition-all group">
                                        <div class="text-right hidden sm:block">
                                            <p class="text-[13px] font-black text-slate-900 leading-tight uppercase tracking-tight">{{ Auth::user()->name }}</p>
                                            <p class="text-[9px] font-bold text-slate-400 uppercase tracking-[0.1em]">{{ Auth::user()->role }}</p>
                                        </div>
                                        <div class="h-9 w-9 rounded-lg bg-gradient-to-br from-indigo-500 to-purple-600 p-0.5 shadow-md shadow-indigo-100 group-hover:shadow-indigo-200 transition-all">
                                            <div class="h-full w-full rounded-[6px] bg-white flex items-center justify-center overflow-hidden">
                                                @if(Auth::user()->avatar)
                                                    @php
                                                        $disk = config('filesystems.disks.s3.key') ? 's3' : config('filesystems.default');
                                                        $avatarUrl = $disk === 's3' 
                                                            ? Storage::disk($disk)->temporaryUrl(Auth::user()->avatar, now()->addMinutes(60))
                                                            : Storage::disk($disk)->url(Auth::user()->avatar);
                                                    @endphp
                                                    <img src="{{ $avatarUrl }}" class="h-full w-full object-cover">
                                                @else
                                                    <span class="text-indigo-600 font-black text-xs uppercase">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <svg class="h-3.5 w-3.5 text-slate-400 group-hover:text-indigo-500 transition-colors" :class="{'rotate-180': open}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>

                                    <!-- Dropdown Menu -->
                                    <div x-show="open" 
                                         x-transition:enter="transition ease-out duration-200"
                                         x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                                         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                         x-transition:leave="transition ease-in duration-75"
                                         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                                         x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                                         class="absolute right-0 mt-2 w-56 origin-top-right rounded-2xl bg-white shadow-2xl shadow-slate-200 border border-slate-100 py-2 z-50 overflow-hidden"
                                         style="display: none;">
                                        
                                        <div class="px-4 py-3 border-b border-slate-50 mb-1">
                                            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Authenticated As</p>
                                            <p class="text-sm font-black text-slate-800 truncate uppercase">{{ Auth::user()->name }}</p>
                                        </div>

                                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm font-bold text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                            My Profile
                                        </a>

                                        <div class="border-t border-slate-50 mt-1 pt-1">
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <button type="submit" class="flex items-center gap-3 w-full text-left px-4 py-2.5 text-sm font-bold text-rose-600 hover:bg-rose-50 transition-colors">
                                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                                                    Sign Out
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </header>
                @else
                    @include('layouts.navigation')
                @endauth

                <!-- Page Content -->
                <main class="p-10">
                    {{ $slot }}
                </main>
            </div>
        </div>

        <!-- 🛡️ Premium Command Palette (Ctrl+K) -->
        <div x-data="commandPalette()" 
             @keydown.window.ctrl.k.prevent="openPalette()" 
             @keydown.window.cmd.k.prevent="openPalette()"
             @keydown.window.escape="closePalette()"
             x-show="isOpen"
             class="fixed inset-0 z-[100] overflow-y-auto p-4 sm:p-6 md:p-20"
             role="dialog"
             aria-modal="true"
             style="display: none;">
            
            <!-- Backdrop -->
            <div x-show="isOpen" 
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity" 
                 @click="closePalette()"></div>

            <!-- Palette Interface -->
            <div x-show="isOpen"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 class="mx-auto max-w-2xl transform divide-y divide-slate-100 overflow-hidden rounded-3xl bg-white shadow-2xl ring-1 ring-black ring-opacity-5 transition-all">
                
                <div class="relative">
                    <svg class="pointer-events-none absolute left-6 top-5.5 h-6 w-6 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                    <input type="text" 
                           x-ref="searchInput"
                           @input.debounce.300ms="search()"
                           x-model="query"
                           class="h-16 w-full border-0 bg-transparent pl-16 pr-6 text-slate-800 placeholder-slate-400 focus:ring-0 text-lg font-bold" 
                           placeholder="Search Command Hub... (Clients, Staff, Claims)" 
                           role="combobox" 
                           aria-expanded="false" 
                           aria-controls="options">
                </div>

                <!-- Results Section -->
                <ul x-show="results.length > 0" class="max-h-96 scroll-py-3 overflow-y-auto p-3" id="options" role="listbox">
                    <template x-for="(result, index) in results">
                        <li>
                            <a :href="result.url" class="group flex cursor-default select-none items-center rounded-2xl p-4 hover:bg-slate-50 transition-all">
                                <div class="flex h-12 w-12 flex-none items-center justify-center rounded-xl bg-slate-50 text-slate-400 group-hover:bg-brand group-hover:text-white transition-all">
                                    <template x-if="result.icon === 'user'">
                                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                    </template>
                                    <template x-if="result.icon === 'shield'">
                                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                                    </template>
                                    <template x-if="result.icon === 'identification'">
                                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" /></svg>
                                    </template>
                                </div>
                                <div class="ml-4 flex-auto">
                                    <p class="text-xs font-black text-slate-900 uppercase tracking-tight" x-text="result.title"></p>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest" x-text="result.type + ' • ' + result.meta"></p>
                                </div>
                                <svg class="ml-3 h-5 w-5 flex-none text-slate-300 opacity-0 group-hover:opacity-100 group-hover:translate-x-1 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                            </a>
                        </li>
                    </template>
                </ul>

                <!-- Empty State -->
                <div x-show="query.length >= 2 && results.length === 0 && !loading" class="px-6 py-14 text-center sm:px-14">
                    <svg class="mx-auto h-10 w-10 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 9.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <p class="mt-4 text-[10px] font-black text-slate-900 uppercase tracking-widest leading-loose">No diagnostic results found for "<span x-text="query"></span>"</p>
                </div>

                <!-- Shortuct Help Footer -->
                <div class="flex flex-wrap items-center bg-slate-50 px-6 py-4 text-[9px] font-black uppercase text-slate-400 tracking-widest">
                    Press <kbd class="mx-1 rounded bg-white px-2 py-1 text-slate-900 shadow ring-1 ring-slate-200">ESC</kbd> to close •
                    <kbd class="mx-1 rounded bg-white px-2 py-1 text-slate-900 shadow ring-1 ring-slate-200">CTRL + K</kbd> to search from anywhere
                </div>
            </div>
        </div>

        <script>
            function commandPalette() {
                return {
                    isOpen: false,
                    query: '',
                    results: [],
                    loading: false,
                    openPalette() {
                        this.isOpen = true;
                        this.$nextTick(() => this.$refs.searchInput.focus());
                    },
                    closePalette() {
                        this.isOpen = false;
                        this.query = '';
                        this.results = [];
                    },
                    search() {
                        if (this.query.length < 2) {
                            this.results = [];
                            return;
                        }
                        this.loading = true;
                        fetch(`/api/search?q=${encodeURIComponent(this.query)}`)
                            .then(res => res.json())
                            .then(data => {
                                this.results = data;
                                this.loading = false;
                            });
                    }
                }
            }
        </script>

        <!-- 🛡️ Velora Global Toast Hub -->
        <div x-data="{ 
                show: false, 
                type: 'success', 
                message: '',
                init() {
                    @if(session('success'))
                        this.trigger('success', '{{ session('success') }}');
                    @elseif(session('error'))
                        this.trigger('error', '{{ session('error') }}');
                    @elseif(session('status'))
                        this.trigger('info', '{{ session('status') }}');
                    @endif
                },
                trigger(type, message) {
                    this.type = type;
                    this.message = message;
                    this.show = true;
                    setTimeout(() => this.show = false, 4000);
                }
             }"
             x-show="show"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-x-8"
             x-transition:enter-end="opacity-100 translate-x-0"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100 translate-x-0"
             x-transition:leave-end="opacity-0 translate-x-8"
             class="fixed top-8 right-8 z-[110] w-80"
             style="display: none;">
            
            <div class="bg-white/90 backdrop-blur-xl border rounded-3xl shadow-2xl p-5 flex items-start gap-4 ring-1 ring-black/5"
                 :class="{
                    'border-emerald-100 shadow-emerald-100/20': type === 'success',
                    'border-rose-100 shadow-rose-100/20': type === 'error',
                    'border-indigo-100 shadow-indigo-100/20': type === 'info'
                 }">
                
                <div class="h-10 w-10 shrink-0 rounded-2xl flex items-center justify-center"
                     :class="{
                        'bg-emerald-50 text-emerald-600': type === 'success',
                        'bg-rose-50 text-rose-600': type === 'error',
                        'bg-indigo-50 text-indigo-600': type === 'info'
                     }">
                    <template x-if="type === 'success'">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </template>
                    <template x-if="type === 'error'">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </template>
                    <template x-if="type === 'info'">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </template>
                </div>

                <div class="flex-auto">
                    <h4 class="text-[10px] font-black uppercase tracking-[0.2em] mb-1"
                        :class="{
                            'text-emerald-700': type === 'success',
                            'text-rose-700': type === 'error',
                            'text-indigo-700': type === 'info'
                        }" x-text="type === 'success' ? 'Success Diagnostic' : (type === 'error' ? 'Error Alert' : 'System Insight')"></h4>
                    <p class="text-xs font-bold text-slate-800 leading-relaxed" x-text="message"></p>
                </div>

                <button @click="show = false" class="text-slate-300 hover:text-slate-500 transition-colors">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
        </div>
    </body>
</html>
