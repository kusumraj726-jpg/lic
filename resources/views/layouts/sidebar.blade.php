<aside class="glass-sidebar shadow-xl transition-colors duration-300">
    <div class="sidebar-header border-b border-gray-100/50 dark:border-slate-700 mb-4 pb-4 px-2 transition-colors duration-300">
        @php
            $sidebarContext = auth()->user()->context();
        @endphp
        <a href="{{ route('dashboard') }}" class="sidebar-logo flex items-center gap-3 py-2">
            @if(Auth::user()->logo_url)
                <img src="{{ Auth::user()->logo_url }}" alt="Logo" class="h-10 w-10 object-cover rounded-[0.5rem] shadow-sm bg-white">
            @else
                <div class="h-10 w-10 rounded-[0.5rem] bg-brand text-white flex shrink-0 items-center justify-center font-black text-xl shadow-lg">
                    {{ substr($sidebarContext->company_name ?? 'V', 0, 1) }}
                </div>
            @endif
            
            <div class="flex flex-col overflow-hidden">
                <span class="tracking-tight text-[11px] font-black uppercase text-slate-900 dark:text-slate-100 group-hover:text-brand transition-colors whitespace-nowrap overflow-hidden text-ellipsis">{{ $sidebarContext->company_name ?? config('app.name', 'NexoraByte ERP') }}</span>
                <span class="text-[8px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest">Command Center</span>
            </div>
        </a>
    </div>

    <nav class="sidebar-nav">
        @php
            $user = auth()->user();
            $isAdvisor = $user->isAdvisor();
            $staffProfile = $user->linkedStaffProfile;
        @endphp

        <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            Dashboard
        </a>

        @if($isAdvisor || ($staffProfile && $staffProfile->access_clients))
            <a href="{{ route('clients.index') }}" class="nav-item {{ request()->routeIs('clients.*') ? 'active' : '' }}">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                Clients
            </a>
        @endif

        @if($isAdvisor || ($staffProfile && $staffProfile->access_queries))
            <a href="{{ route('queries.index') }}" class="nav-item {{ request()->routeIs('queries.*') ? 'active' : '' }}">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                </svg>
                Queries
            </a>
        @endif

        @if($isAdvisor || ($staffProfile && $staffProfile->access_claims))
            <a href="{{ route('claims.index') }}" class="nav-item {{ request()->routeIs('claims.*') ? 'active' : '' }}">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
                Claims
            </a>
        @endif

        @if($isAdvisor || ($staffProfile && $staffProfile->access_renewals))
            <a href="{{ route('renewals.index') }}" class="nav-item {{ request()->routeIs('renewals.*') ? 'active' : '' }}">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Renewals
            </a>

            <a href="{{ route('commissions.index') }}" class="nav-item {{ request()->routeIs('commissions.*') ? 'active' : '' }}">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Commissions
            </a>
        @endif

        @if($isAdvisor)
            <a href="{{ route('staff.index') }}" class="nav-item {{ request()->routeIs('staff.*') ? 'active' : '' }}">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                Staff Management
            </a>
            
            <a href="{{ route('trash.index') }}" class="nav-item {{ request()->routeIs('trash.*') ? 'active' : '' }}">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
                Trash Bin
            </a>
        @endif

        @if(auth()->user()->role === 'superadmin')
            <div class="mt-6 pt-6 border-t border-gray-100/50">
                <a href="{{ route('superadmin.index') }}"
                    class="nav-item bg-indigo-50 text-indigo-700 font-bold border border-indigo-100 hover:bg-indigo-100 shadow-sm transition-all">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" class="text-indigo-600">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                    Master Control
                </a>
            </div>
        @endif
    </nav>

    <div class="sidebar-footer mt-auto border-t border-gray-100 pt-4 px-2 space-y-1">
        <a href="{{ route('settings.index') }}" class="nav-item {{ request()->routeIs('settings.*') ? 'active' : '' }} mb-2">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            Settings
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="nav-item w-full text-left hover:bg-rose-50 hover:text-rose-600 transition-colors">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                Logout
            </button>
        </form>
    </div>
</aside>