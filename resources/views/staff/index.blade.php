<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-8">
            <h2 class="font-black text-3xl text-slate-900 uppercase tracking-tight dark:text-slate-100">
                STAFF
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

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-10 px-2">
                <div>
                    <h2 class="text-3xl font-black text-slate-900 uppercase tracking-tight dark:text-white">Team Members</h2>
                    <p class="text-slate-400 dark:text-slate-500 text-[10px] font-bold uppercase tracking-widest mt-1">Manage personnel, roles, and administrative access.</p>
                </div>
                <div class="flex items-center gap-4">
                    <form action="{{ route('staff.index') }}" method="GET" class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-slate-400 group-focus-within:text-slate-900 dark:group-focus-within:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search staff..." class="pl-10 pr-4 py-2.5 text-xs rounded-xl border-slate-100 dark:border-slate-700 focus:border-slate-900 dark:focus:border-white focus:ring-0 bg-white dark:bg-slate-800 dark:text-slate-100 dark:placeholder-slate-500 shadow-sm w-64 transition-all uppercase font-bold tracking-tight">
                    </form>
                    <a href="{{ route('staff.create') }}" class="inline-flex items-center gap-2 bg-slate-900 dark:bg-white text-white dark:text-slate-900 px-6 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-lg shadow-slate-200 dark:shadow-none hover:opacity-90 transition-all">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                        Add Member
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl font-bold flex items-center gap-3">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-slate-900 rounded-[2.5rem] border border-slate-100 dark:border-slate-800 shadow-xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-slate-50/50 dark:bg-slate-800/50 border-b border-slate-100 dark:border-slate-700">
                            <tr>
                                <th class="px-8 py-5 text-[10px] font-black text-slate-900 dark:text-slate-100 uppercase tracking-[0.2em]">Member Details</th>
                                <th class="px-8 py-5 text-[10px] font-black text-slate-900 dark:text-slate-100 uppercase tracking-[0.2em]">Contact Information</th>
                                <th class="px-8 py-5 text-[10px] font-black text-slate-900 dark:text-slate-100 uppercase tracking-[0.2em]">Designation</th>
                                <th class="px-8 py-5 text-[10px] font-black text-slate-900 dark:text-slate-100 uppercase tracking-[0.2em]">Status</th>
                                <th class="px-8 py-5 text-[10px] font-black text-slate-900 dark:text-slate-100 uppercase tracking-[0.2em] text-right">Action Hub</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50 dark:divide-slate-800">
                            @forelse($staff as $member)
                                <tr class="hover:bg-slate-50/80 dark:hover:bg-slate-800/80 transition-all duration-300 group">
                                    <td class="px-8 py-6">
                                        <div class="flex items-center gap-4">
                                            <div class="h-12 w-12 rounded-2xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center border border-slate-100 dark:border-slate-700 shadow-sm overflow-hidden group-hover:scale-110 transition-transform">
                                                @if($member->staffUser && $member->staffUser->avatar_url)
                                                    <img src="{{ $member->staffUser->avatar_url }}" class="h-full w-full object-cover">
                                                @else
                                                    <span class="text-xs font-black text-slate-400 uppercase">{{ substr($member->name, 0, 1) }}</span>
                                                @endif
                                            </div>
                                            <div>
                                                <div class="font-black text-slate-900 dark:text-slate-100 uppercase text-[13px]">{{ $member->name }}</div>
                                                <div class="text-[9px] font-mono font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest mt-0.5">EMP-ID: MB-10{{ $member->id }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="text-[11px] font-bold text-slate-900 dark:text-slate-100 tracking-tight">{{ $member->email }}</div>
                                        <div class="text-[10px] font-bold text-slate-400 dark:text-slate-500 mt-0.5">{{ $member->phone ?? '+91 90000 00000' }}</div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <span class="inline-flex items-center px-3 py-1 rounded-lg bg-slate-50 dark:bg-slate-800 text-[9px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest border border-slate-100 dark:border-slate-700">
                                            {{ $member->designation ?? 'Staff Member' }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="flex items-center gap-2">
                                            <span class="h-1.5 w-1.5 rounded-full {{ $member->status == 'active' ? 'bg-emerald-500 shadow-[0_0_8px_rgba(16,185,129,0.5)]' : 'bg-rose-500 shadow-[0_0_8px_rgba(244,63,94,0.5)]' }}"></span>
                                            <span class="text-[9px] font-black uppercase tracking-[0.2em] {{ $member->status == 'active' ? 'text-emerald-600 dark:text-emerald-400' : 'text-rose-600 dark:text-rose-400' }}">{{ $member->status }}</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6 text-right">
                                        <div class="flex items-center justify-end gap-3 text-[10px] font-black uppercase tracking-widest">
                                            <a href="{{ route('staff.edit', $member) }}" class="text-slate-900 dark:text-white hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">Edit</a>
                                            <span class="text-slate-200 dark:text-slate-800 text-xs">|</span>
                                            <form action="{{ route('staff.destroy', $member) }}" method="POST" class="inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-rose-600 dark:text-rose-400 hover:text-rose-900 dark:hover:text-rose-300 transition-colors" onclick="return confirm('Remove team member?')">Remove</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-8 py-20 text-center text-gray-500 dark:text-slate-500">
                                        <div class="flex flex-col items-center">
                                            <svg class="h-12 w-12 text-slate-200 dark:text-slate-800 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                                            <p class="text-[10px] font-black uppercase tracking-widest">No team members found.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($staff->hasPages())
                    <div class="bg-slate-50/50 dark:bg-slate-800/50 px-8 py-5 border-t border-slate-100 dark:border-slate-700">
                        {{ $staff->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
