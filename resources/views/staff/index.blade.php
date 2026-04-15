<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
            {{ __('Staff Management') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-3xl font-extrabold text-gray-900 dark:text-gray-100">Team Members</h2>
                    <p class="text-gray-500 mt-1 dark:text-slate-400">Manage your agency staff and their access status.</p>
                </div>
                <div class="flex items-center gap-4">
                    <form action="{{ route('staff.index') }}" method="GET" class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-400 group-focus-within:text-indigo-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search team members..." class="search-input pl-11 pr-4 py-2.5 rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white shadow-sm w-64 transition-all dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500">
                    </form>
                    <a href="{{ route('staff.create') }}" class="premium-btn premium-btn-primary flex items-center gap-2">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" /></svg>
                        Add Staff Member
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl font-bold flex items-center gap-3">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="premium-card overflow-hidden !p-0 border-none shadow-xl">
                <div class="overflow-x-auto">
                    <table class="premium-table">
                        <thead>
                            <tr>
                                <th>Name / Email</th>
                                <th>Phone</th>
                                <th>Designation</th>
                                <th>Status</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($staff as $member)
                                <tr class="hover:bg-slate-50 transition-colors dark:hover:bg-slate-800/50">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="h-10 w-10 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 p-0.5 shadow-sm border border-slate-100 flex-shrink-0">
                                                <div class="h-full w-full rounded-[9px] bg-white flex items-center justify-center overflow-hidden">
                                                    @if($member->staffUser && $member->staffUser->avatar_url)
                                                        <img src="{{ $member->staffUser->avatar_url }}" class="h-full w-full object-cover">
                                                    @else
                                                        <span class="text-indigo-600 font-black text-xs uppercase">{{ substr($member->name, 0, 1) }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="min-w-0">
                                                <div class="font-bold text-gray-900 truncate dark:text-gray-100">{{ $member->name }}</div>
                                                <div class="text-[10px] font-bold text-indigo-500 uppercase tracking-tight truncate">{{ $member->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300">
                                        {{ $member->phone ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-medium text-slate-700">{{ $member->designation ?? 'Staff' }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold {{ $member->status == 'active' ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700' }}">
                                            {{ ucfirst($member->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-5 text-sm font-bold uppercase tracking-wider">
                                            <a href="{{ route('staff.show', $member) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300 flex items-center gap-1.5 group transition-transform hover:scale-105">
                                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                                View
                                            </a>
                                            <a href="{{ route('staff.edit', $member) }}" class="text-amber-600 dark:text-amber-400 hover:text-amber-900 dark:hover:text-amber-300 flex items-center gap-1.5 group transition-transform hover:scale-105">
                                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                                Edit
                                            </a>
                                            <form action="{{ route('staff.destroy', $member) }}" method="POST" class="inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-rose-600 dark:text-rose-400 hover:text-rose-900 dark:hover:text-rose-300 flex items-center gap-1.5 group transition-transform hover:scale-105" onclick="return confirm('Move staff member to trash?')">
                                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-gray-500 italic dark:text-slate-400">
                                        No staff members found. Start by adding your team!
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($staff->hasPages())
                    <div class="bg-gray-50 px-6 py-4 border-t border-gray-100 dark:bg-slate-800/50">
                        {{ $staff->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
