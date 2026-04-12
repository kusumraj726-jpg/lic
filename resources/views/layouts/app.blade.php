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

                            <!-- User Profile Dropdown -->
                            <div class="flex items-center gap-4" x-data="{ open: false }" @click.away="open = false">
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
    </body>
</html>
