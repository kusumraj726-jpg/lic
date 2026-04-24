<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'NexoraByte') }}</title>
        <link rel="icon" type="image/png" href="{{ asset('images/favicon-nb.png') }}">

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
            .nav-item.active svg {
                color: var(--brand-primary) !important;
            }
            @media (max-width: 768px) {
                input, select, textarea {
                    font-size: 16px !important;
                }
            }
        </style>

        <!-- Theme Initialization Script (Prevents FOUC) -->
        <script>
            if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        </script>
    </head>
    <body x-data="{ 
            darkMode: false,
            toggleTheme() {
                this.darkMode = !this.darkMode;
                if(this.darkMode) {
                    document.documentElement.classList.add('dark');
                    localStorage.theme = 'dark';
                } else {
                    document.documentElement.classList.remove('dark');
                    localStorage.theme = 'light';
                }
            }
          }"
          x-init="darkMode = document.documentElement.classList.contains('dark')"
          class="font-sans antialiased text-slate-900 dark:text-slate-100 selection:bg-indigo-100 dark:selection:bg-indigo-900/50 selection:text-indigo-900 dark:selection:text-indigo-100 overflow-x-hidden transition-colors duration-300">
        
        <!-- Premium Aesthetic Background System -->
        <div class="fixed inset-0 z-[-1] overflow-hidden pointer-events-none">
            <!-- Base Surface -->
            <div class="absolute inset-0 bg-[#fdfdff] dark:bg-slate-900 transition-colors duration-300"></div>
            
            <!-- Global Intelligence Aura (Animated Blurred Orbs) -->
            <div class="absolute top-[-10%] left-[-10%] w-[60%] h-[60%] bg-indigo-500/25 dark:bg-indigo-600/10 rounded-full blur-[140px] animate-pulse" style="animation-duration: 10s;"></div>
            <div class="absolute top-[-5%] right-[0%] w-[55%] h-[55%] bg-amber-500/25 dark:bg-amber-600/10 rounded-full blur-[130px] animate-pulse" style="animation-duration: 15s;"></div>
            <div class="absolute top-[40%] right-[-5%] w-[50%] h-[60%] bg-indigo-600/20 dark:bg-indigo-500/10 rounded-full blur-[110px] animate-pulse" style="animation-duration: 18s;"></div>
            <div class="absolute bottom-[20%] right-[-10%] w-[55%] h-[55%] bg-emerald-500/15 dark:bg-emerald-600/10 rounded-full blur-[120px] animate-pulse" style="animation-duration: 14s;"></div>
            <div class="absolute bottom-[-10%] left-[-10%] w-[50%] h-[50%] bg-rose-500/20 dark:bg-rose-600/10 rounded-full blur-[120px] animate-pulse" style="animation-duration: 12s;"></div>
            <div class="absolute bottom-[-5%] right-[5%] w-[65%] h-[65%] bg-brand/30 dark:bg-brand/10 rounded-full blur-[150px] animate-pulse" style="animation-duration: 8s;"></div>

            <!-- Professional Grid Overlay -->
            <div class="absolute inset-0 bg-[radial-gradient(#e2e8f0_1px,transparent_1px)] dark:bg-[radial-gradient(#334155_1px,transparent_1px)] [background-size:32px_32px] opacity-[0.4] dark:opacity-[0.2]"></div>
        </div>

        <div class="erp-layout">
            @auth
                {{-- Hamburger toggle button (mobile only) --}}
                <button id="sidebar-toggle" class="sidebar-toggle-btn" aria-label="Toggle Sidebar">
                    <svg id="hamburger-icon" class="w-5 h-5 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                {{-- Sidebar overlay --}}
                <div id="sidebar-overlay" class="sidebar-overlay"></div>

                @include('layouts.sidebar')
            @endauth

            <div class="erp-content">
                @auth
                    <!-- Persistent Top Bar -->
                    <header class="bg-white/90 dark:bg-slate-900/90 backdrop-blur-md border-b border-gray-100 dark:border-slate-800 py-3 px-10 sticky top-0 z-30 transition-colors duration-300">
                        <div class="max-w-7xl mx-auto flex items-center justify-between">
                            <div>
                                @isset($header)
                                    {{ $header }}
                                @else
                                    <h2 class="font-extrabold text-2xl text-slate-900 dark:text-white uppercase tracking-tight">
                                        {{ __('Dashboard') }}
                                    </h2>
                                @endisset
                            </div>

                            <!-- User Profile & Intelligence Hub Dropdown -->
                            <div class="flex items-center gap-4" x-data="{ open: false, intelOpen: false }" @click.away="open = false; intelOpen = false">
                                
                                <!-- Theme Toggle Button -->
                                <button @click="toggleTheme()" class="h-11 w-11 rounded-[1.25rem] bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 shadow-sm hover:shadow-md hover:scale-[1.02] flex items-center justify-center text-slate-400 hover:text-indigo-600 dark:hover:text-amber-400 transition-all group">
                                    <svg x-show="!darkMode" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" /></svg>
                                    <svg x-show="darkMode" style="display: none;" class="h-5 w-5 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                                </button>

                                <!-- NexoraByte Intelligence Hub Pill (Shared Across Pages) -->
                                @if(isset($global_intel) && $global_intel->count() > 0)
                                <div class="relative">
                                    <button @click="intelOpen = !intelOpen" 
                                            class="flex items-center gap-2.5 px-4 h-11 rounded-[1.25rem] bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 shadow-sm hover:shadow-md hover:scale-[1.02] transition-all group relative overflow-hidden">
                                        <div class="absolute inset-0 bg-brand/5 dark:bg-brand/10 group-hover:bg-brand/10 dark:group-hover:bg-brand/20 transition-colors"></div>
                                        <span class="relative flex h-2 w-2">
                                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-brand opacity-75"></span>
                                            <span class="relative inline-flex rounded-full h-2 w-2 bg-brand"></span>
                                        </span>
                                        <span class="relative text-[10px] font-black text-slate-900 dark:text-slate-100 uppercase tracking-[0.15em]">Intelligence</span>
                                        <span class="relative flex items-center justify-center h-5 w-5 rounded-lg bg-brand text-[9px] font-black text-white ml-1">
                                            {{ $global_intel->count() }}
                                        </span>
                                    </button>

                                    <!-- Intelligence Dropdown Panel -->
                                    <div x-show="intelOpen" 
                                         x-transition:enter="transition ease-out duration-200"
                                         x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                                         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                         class="absolute right-0 mt-3 w-80 origin-top-right rounded-[2rem] bg-white dark:bg-slate-800 shadow-2xl dark:shadow-black/50 border border-slate-100 dark:border-slate-700 p-8 z-50 overflow-hidden" 
                                         style="display: none;">
                                        
                                        <div class="flex items-center justify-between mb-8">
                                            <h4 class="text-[11px] font-black text-slate-900 uppercase tracking-[0.2em] flex items-center gap-2 dark:text-slate-100">
                                                NexoraByte Intelligence
                                            </h4>
                                            <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Live Pulse</span>
                                        </div>

                                        <div class="space-y-4 max-h-[25rem] overflow-y-auto pr-2 custom-scrollbar">
                                            @foreach($global_intel as $brief)
                                            <a href="{{ $brief['url'] ?? '#' }}" 
                                               @if(isset($brief['action_type']) && $brief['action_type'] === 'message')
                                                   @click.prevent="$dispatch('open-messaging-modal', { name: '{{ addslashes($brief['name'] ?? '') }}', phone: '{{ $brief['phone'] ?? '' }}', type: '{{ $brief['event_type'] ?? '' }}' })"
                                               @endif
                                               {{ isset($brief['url']) && str_contains($brief['url'], 'wa.me') && !isset($brief['action_type']) ? 'target="_blank"' : '' }} class="flex items-start gap-4 p-4 rounded-3xl bg-slate-50 border border-slate-50 hover:border-brand/20 hover:shadow-sm transition-all group dark:bg-slate-800/50 block">
                                                <div class="h-10 w-10 shrink-0 rounded-2xl bg-{{ $brief['type'] === 'warning' ? 'rose' : ($brief['type'] === 'success' ? 'emerald' : ($brief['type'] === 'info' ? 'blue' : 'brand')) }}-100 text-{{ $brief['type'] === 'warning' ? 'rose' : ($brief['type'] === 'success' ? 'emerald' : ($brief['type'] === 'info' ? 'blue' : 'brand')) }}-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                                                    @if($brief['type'] === 'warning')
                                                        <!-- Query/Warning Icon -->
                                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                                        </svg>
                                                    @elseif($brief['type'] === 'danger')
                                                        <!-- Urgent Query Icon (Synced with Sidebar) -->
                                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                                        </svg>
                                                    @elseif($brief['type'] === 'success')
                                                        <!-- Renewal Continuity Icon (Synced with Sidebar) -->
                                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                    @elseif($brief['type'] === 'info')
                                                        <!-- Claim Case Icon (Synced with Sidebar) -->
                                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                                        </svg>
                                                    @else
                                                        @if(strpos(strtolower($brief['title']), 'anniversary') !== false || strpos(strtolower($brief['message']), 'anniv') !== false)
                                                            <!-- Anniversary Icon (Flower) -->
                                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10c-1.104 0-2-.896-2-2s.896-2 2-2 2 .896 2 2-.896 2-2 2zm0 0v10M12 10l-4-4M12 10l4-4M12 12l-4 4M12 12l4 4" />
                                                            </svg>
                                                        @else
                                                            <!-- Birthday Icon (Gift) -->
                                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V6a2 2 0 10-2 2h2zm0 0H7a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2V10a2 2 0 00-2-2h-5z" />
                                                            </svg>
                                                        @endif
                                                    @endif
                                                </div>
                                                <div>
                                                    <h5 class="text-xs font-black text-slate-800 uppercase tracking-tight dark:text-slate-200">{{ $brief['title'] }}</h5>
                                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1 leading-relaxed">{{ $brief['message'] }}</p>
                                                </div>
                                            </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @endif

                                <div class="relative">
                                    <div class="flex items-center gap-3 p-1 rounded-xl transition-all">
                                        <div class="text-right hidden sm:block">
                                            <p class="text-[13px] font-black text-slate-900 dark:text-slate-100 leading-tight uppercase tracking-tight">{{ Auth::user()->name }}</p>
                                            <div class="flex justify-end mt-0.5">
                                                @php
                                                    $role = Auth::user()->role;
                                                    $label = strtoupper($role);
                                                    $colorClass = 'bg-slate-100 text-slate-600 dark:bg-slate-700/60 dark:text-slate-300';
                                            
                                                    if ($role === 'superadmin') {
                                                        $label = 'MASTER ADMIN';
                                                        $colorClass = 'bg-amber-100 text-amber-700 dark:bg-amber-500/15 dark:text-amber-400';
                                                    } elseif ($role === 'advisor' || $role === 'admin') {
                                                        $label = 'ADMIN';
                                                        $colorClass = 'bg-indigo-100 text-indigo-700 dark:bg-indigo-500/15 dark:text-indigo-400';
                                                    } elseif ($role === 'staff') {
                                                        $staffProfile = Auth::user()->linkedStaffProfile;
                                                        $label = ($staffProfile && $staffProfile->designation) ? $staffProfile->designation : 'STAFF';
                                                        $colorClass = 'bg-emerald-100 text-emerald-700 dark:bg-emerald-500/15 dark:text-emerald-400';
                                                    }
                                                @endphp
                                                <span class="px-2 py-0.5 rounded-md text-[8px] font-black uppercase tracking-[0.1em] {{ $colorClass }}">
                                                    {{ $label }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="h-9 w-9 rounded-lg bg-gradient-to-br from-indigo-500 to-purple-600 p-0.5 shadow-md">
                                            <div class="h-full w-full rounded-[6px] bg-white dark:bg-slate-900 flex items-center justify-center overflow-hidden">
                                                @if(Auth::user()->avatar_url)
                                                    <img src="{{ Auth::user()->avatar_url }}" class="h-full w-full object-cover">
                                                @else
                                                    <span class="text-indigo-400 dark:text-indigo-300 font-black text-xs uppercase">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                                @endif
                                            </div>
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
                    <svg class="pointer-events-none absolute left-6 top-1/2 -translate-y-1/2 h-6 w-6 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                    <input type="text" 
                           x-ref="searchInput"
                           @input.debounce.300ms="search()"
                           x-model="query"
                           class="h-16 w-full border-0 bg-transparent pl-16 pr-6 text-slate-800 placeholder-slate-400 focus:ring-0 text-lg font-bold dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500" 
                           placeholder="Search Command Hub... (Clients, Staff, Claims)" 
                           role="combobox" 
                           aria-expanded="false" 
                           aria-controls="options">
                </div>

                <!-- Results Section -->
                <ul x-show="results.length > 0" class="max-h-96 scroll-py-3 overflow-y-auto p-3" id="options" role="listbox">
                    <template x-for="(result, index) in results">
                        <li>
                            <a :href="result.url" class="group flex cursor-default select-none items-center rounded-2xl p-4 hover:bg-slate-50 transition-all dark:hover:bg-slate-800/50">
                                <div class="flex h-12 w-12 flex-none items-center justify-center rounded-xl bg-slate-50 text-slate-400 group-hover:bg-brand group-hover:text-white transition-all dark:bg-slate-800/50">
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
                                    <p class="text-xs font-black text-slate-900 uppercase tracking-tight dark:text-slate-100" x-text="result.title"></p>
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
                    <p class="mt-4 text-[10px] font-black text-slate-900 uppercase tracking-widest leading-loose dark:text-slate-100">No diagnostic results found for "<span x-text="query"></span>"</p>
                </div>

                <!-- Shortuct Help Footer -->
                <div class="flex flex-wrap items-center bg-slate-50 px-6 py-4 text-[9px] font-black uppercase text-slate-400 tracking-widest dark:bg-slate-800/50">
                    Press <kbd class="mx-1 rounded bg-white px-2 py-1 text-slate-900 shadow ring-1 ring-slate-200 dark:text-slate-100">ESC</kbd> to close •
                    <kbd class="mx-1 rounded bg-white px-2 py-1 text-slate-900 shadow ring-1 ring-slate-200 dark:text-slate-100">CTRL + K</kbd> to search from anywhere
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

        <!-- 🛡️ NexoraByte Global Toast Hub -->
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
             class="fixed bottom-8 right-8 z-[110] w-80"
             style="display: none;">
            
            <div class="bg-white dark:bg-slate-800 backdrop-blur-xl border rounded-3xl shadow-2xl dark:shadow-black/40 p-5 flex items-start gap-4 ring-1 ring-black/5 dark:ring-white/5"
                 :class="{
                    'border-emerald-100 dark:border-emerald-500/30': type === 'success',
                    'border-rose-100 dark:border-rose-500/30': type === 'error',
                    'border-indigo-100 dark:border-indigo-500/30': type === 'info'
                 }">
                
                <div class="h-10 w-10 shrink-0 rounded-2xl flex items-center justify-center"
                     :class="{
                        'bg-emerald-50 dark:bg-emerald-500/15 text-emerald-600 dark:text-emerald-400': type === 'success',
                        'bg-rose-50 dark:bg-rose-500/15 text-rose-600 dark:text-rose-400': type === 'error',
                        'bg-indigo-50 dark:bg-indigo-500/15 text-indigo-600 dark:text-indigo-400': type === 'info'
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
                            'text-emerald-700 dark:text-emerald-400': type === 'success',
                            'text-rose-700 dark:text-rose-400': type === 'error',
                            'text-indigo-700 dark:text-indigo-400': type === 'info'
                        }"
                        x-text="type === 'success' ? 'Success Diagnostic' : (type === 'error' ? 'Error Alert' : 'System Insight')"></h4>
                    <p class="text-xs font-bold text-slate-800 dark:text-slate-200 leading-relaxed" x-text="message"></p>
                </div>

                <button @click="show = false" class="text-slate-300 dark:text-slate-600 hover:text-slate-500 dark:hover:text-slate-400 transition-colors mt-0.5">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
        </div>

        @auth
        <!-- Global Dynamic Messaging Hub (Modal) -->
        <div x-data="{
                 showModal: false,
                 modalData: { title: '', message: '', phone: '', name: '', type: '', template: '' },
                 isSaving: false,
                 openMessageModal(event) {
                     const b_template = '{{ addslashes($birthday_template ?? '') }}';
                     const a_template = '{{ addslashes($anniversary_template ?? '') }}';
                     let activeTemplate = event.type === 'anniversary' ? a_template : b_template;
                     let personalizedMessage = activeTemplate.replace(/\[NAME\]/g, event.name);
                     this.modalData = {
                         title: event.type === 'anniversary' ? 'Send Anniversary Greeting' : 'Send Birthday Greeting',
                         message: personalizedMessage,
                         phone: event.phone || '',
                         name: event.name,
                         type: event.type,
                         template: personalizedMessage
                     };
                     this.showModal = true;
                 },
                 async saveAsTemplate() {
                     this.isSaving = true;
                     let rawTemplate = this.modalData.message.replace(new RegExp(this.modalData.name, 'g'), '[NAME]');
                     try {
                         const response = await fetch('{{ route('dashboard.update-template') }}', {
                             method: 'POST',
                             headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                             body: JSON.stringify({ type: this.modalData.type, template: rawTemplate })
                         });
                         const res = await response.json();
                         if (res.success) {
                             alert('Template saved automatically as your new default!');
                         }
                     } catch (e) {
                         console.error('Error saving template:', e);
                     } finally {
                         this.isSaving = false;
                     }
                 },
                 sendWhatsApp() {
                     if (!this.modalData.phone) {
                         alert('No phone number is linked to this record.');
                         return;
                     }
                     const encodedMsg = encodeURIComponent(this.modalData.message);
                     const url = `https://wa.me/91${this.modalData.phone.replace(/\D/g, '')}?text=${encodedMsg}`;
                     window.open(url, '_blank');
                     this.showModal = false;
                 }
             }"
             @open-messaging-modal.window="openMessageModal($event.detail)"
             x-show="showModal" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="fixed inset-0 z-[150] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm"
             style="display: none;">
            
            <div class="relative w-full max-w-xl premium-card bg-white dark:bg-slate-900 shadow-2xl overflow-hidden p-8 border border-slate-100 dark:border-slate-700" @click.away="showModal = false">
                <div class="flex items-center justify-between mb-8">
                    <div class="flex items-center gap-4">
                        <div class="h-12 w-12 rounded-2xl bg-indigo-50 dark:bg-indigo-500/10 flex items-center justify-center text-indigo-600 dark:text-indigo-400">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-black text-slate-900 uppercase tracking-tight dark:text-slate-100" x-text="modalData.title"></h3>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-0.5">Edit greeting before sending</p>
                        </div>
                    </div>
                    <button @click="showModal = false" class="text-slate-400 hover:text-slate-600 dark:hover:text-amber-400">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l18 18" /></svg>
                    </button>
                </div>

                <div class="space-y-6">
                    <div class="relative">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 block">Your Message</label>
                        <textarea x-model="modalData.message" 
                                  class="w-full h-40 rounded-3xl bg-slate-50 border border-slate-100 p-6 text-sm text-slate-700 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500/20 transition-all outline-none resize-none dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500"
                                  placeholder="Type your message here..."></textarea>
                        <div class="absolute bottom-4 right-4 text-[9px] font-black text-slate-300 uppercase tracking-widest">
                            Auto-Personalized for <span class="text-indigo-500" x-text="modalData.name"></span>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 pt-4">
                        <button @click="saveAsTemplate()" 
                                :disabled="isSaving"
                                class="flex-1 px-6 py-4 rounded-2xl bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-black uppercase tracking-widest transition-all flex items-center justify-center gap-3 disabled:opacity-50 dark:text-slate-300 dark:bg-slate-800 dark:hover:bg-slate-700">
                            <span x-show="!isSaving">Save as Template</span>
                            <span x-show="isSaving">Saving...</span>
                            <svg x-show="!isSaving" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" /></svg>
                        </button>
                        <button @click="sendWhatsApp()" 
                                class="flex-[1.5] px-6 py-4 rounded-2xl bg-emerald-500 hover:bg-emerald-600 text-white text-xs font-black uppercase tracking-widest transition-all shadow-xl flex items-center justify-center gap-3">
                            Send via WhatsApp
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endauth
    @auth
    <script>
        (function() {
            const toggleBtn  = document.getElementById('sidebar-toggle');
            const sidebar    = document.querySelector('.glass-sidebar');
            const overlay    = document.getElementById('sidebar-overlay');

            if (!toggleBtn || !sidebar || !overlay) return;

            function openSidebar() {
                sidebar.classList.add('sidebar-open');
                overlay.classList.add('active');
                document.body.style.overflow = 'hidden';
            }

            function closeSidebar() {
                sidebar.classList.remove('sidebar-open');
                overlay.classList.remove('active');
                document.body.style.overflow = '';
            }

            toggleBtn.addEventListener('click', function() {
                sidebar.classList.contains('sidebar-open') ? closeSidebar() : openSidebar();
            });

            overlay.addEventListener('click', closeSidebar);

            // Close sidebar on nav-item click (mobile UX)
            sidebar.querySelectorAll('.nav-item').forEach(function(item) {
                item.addEventListener('click', function() {
                    if (window.innerWidth < 1024) closeSidebar();
                });
            });

            // Auto-close on resize to desktop
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 1024) {
                    closeSidebar();
                    document.body.style.overflow = '';
                }
            });
        })();
    </script>
    @endauth
    </body>
</html>
