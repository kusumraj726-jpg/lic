<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Staff Member Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Navigation -->
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center gap-4">
                    <a href="{{ route('staff.index') }}" class="p-2 hover:bg-white rounded-full transition-colors text-slate-400 hover:text-indigo-600">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                    </a>
                    <div>
                        <h2 class="text-3xl font-extrabold text-gray-900">Staff Profile</h2>
                        <p class="text-gray-500">Detailed information and access rights for this member.</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('staff.edit', $staff) }}" class="premium-btn bg-white text-amber-600 border border-amber-100 hover:bg-amber-50 flex items-center gap-2 px-6 py-3 shadow-sm">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                        Edit Member
                    </a>
                </div>
            </div>

            <!-- Main Content Card -->
            <div class="premium-card border-none shadow-2xl overflow-hidden">
                <div class="p-8 space-y-12">
                    
                    <!-- 1. Profile Header Section -->
                    <div class="flex flex-col md:flex-row items-center gap-10 bg-slate-50/50 p-8 rounded-[2.5rem] border border-slate-100">
                        <div class="h-40 w-40 rounded-[2.5rem] bg-gradient-to-br from-indigo-500 to-purple-600 p-1.5 shadow-2xl shadow-indigo-100 flex-shrink-0">
                            <div class="h-full w-full rounded-[2.1rem] bg-white flex items-center justify-center overflow-hidden border-4 border-white">
                                @if($staff->staffUser && $staff->staffUser->avatar)
                                    <img src="{{ asset('storage/' . $staff->staffUser->avatar) }}" class="h-full w-full object-cover">
                                @else
                                    <div class="h-full w-full flex items-center justify-center bg-slate-50 text-indigo-200">
                                        <svg class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="flex-1 text-center md:text-left">
                            <div class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest {{ $staff->status == 'active' ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700' }} mb-4">
                                {{ $staff->status }}
                            </div>
                            <h3 class="text-4xl font-black text-slate-900 tracking-tight leading-none mb-2">{{ $staff->name }}</h3>
                            <p class="text-lg font-bold text-indigo-600 uppercase tracking-[0.1em]">{{ $staff->designation ?? 'Staff Member' }}</p>
                            <div class="mt-6 flex flex-wrap justify-center md:justify-start gap-4 text-sm font-medium text-slate-500 uppercase tracking-widest">
                                <div class="flex items-center gap-2">
                                    <svg class="h-4 w-4 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                                    {{ $staff->email }}
                                </div>
                                @if($staff->phone)
                                <div class="flex items-center gap-2">
                                    <svg class="h-4 w-4 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                                    {{ $staff->phone }}
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                        <!-- 2. Security & Log Details -->
                        <div class="space-y-8">
                            <div>
                                <div class="flex items-center gap-3 mb-6">
                                    <div class="h-1.5 w-1.5 rounded-full bg-indigo-600"></div>
                                    <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em]">Account Security</h3>
                                </div>
                                <div class="p-6 bg-slate-50 rounded-3xl border border-slate-100 space-y-4">
                                    <div class="flex justify-between items-center py-2 border-b border-slate-200/50">
                                        <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Login Email</span>
                                        <span class="text-sm font-black text-slate-900">{{ $staff->email }}</span>
                                    </div>
                                    <div class="flex justify-between items-center py-2 border-b border-slate-200/50">
                                        <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Agency ID</span>
                                        <span class="text-sm font-black text-slate-900">#{{ $staff->advisor_id }}</span>
                                    </div>
                                    <div class="flex justify-between items-center py-2">
                                        <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Joined Agency</span>
                                        <span class="text-sm font-black text-slate-900">{{ $staff->created_at->format('d M, Y') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 3. Module Permissions -->
                        <div>
                            <div class="flex items-center gap-3 mb-6">
                                <div class="h-1.5 w-1.5 rounded-full bg-emerald-600"></div>
                                <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em]">Module Access Status</h3>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <!-- Permission Cards -->
                                <div class="p-4 rounded-2xl border-2 {{ $staff->access_clients ? 'border-indigo-500 bg-indigo-50/30' : 'border-slate-100 bg-slate-50/50 grayscale' }} flex items-center gap-3">
                                    <div class="h-8 w-8 rounded-lg bg-white flex items-center justify-center {{ $staff->access_clients ? 'text-indigo-600' : 'text-slate-300' }} shadow-sm">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                                    </div>
                                    <span class="text-[10px] font-black uppercase tracking-widest {{ $staff->access_clients ? 'text-indigo-700' : 'text-slate-400' }}">Clients</span>
                                </div>

                                <div class="p-4 rounded-2xl border-2 {{ $staff->access_queries ? 'border-rose-500 bg-rose-50/30' : 'border-slate-100 bg-slate-50/50 grayscale' }} flex items-center gap-3">
                                    <div class="h-8 w-8 rounded-lg bg-white flex items-center justify-center {{ $staff->access_queries ? 'text-rose-600' : 'text-slate-300' }} shadow-sm">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" /></svg>
                                    </div>
                                    <span class="text-[10px] font-black uppercase tracking-widest {{ $staff->access_queries ? 'text-rose-700' : 'text-slate-400' }}">Queries</span>
                                </div>

                                <div class="p-4 rounded-2xl border-2 {{ $staff->access_claims ? 'border-amber-500 bg-amber-50/30' : 'border-slate-100 bg-slate-50/50 grayscale' }} flex items-center gap-3">
                                    <div class="h-8 w-8 rounded-lg bg-white flex items-center justify-center {{ $staff->access_claims ? 'text-amber-600' : 'text-slate-300' }} shadow-sm">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                                    </div>
                                    <span class="text-[10px] font-black uppercase tracking-widest {{ $staff->access_claims ? 'text-amber-700' : 'text-slate-400' }}">Claims</span>
                                </div>

                                <div class="p-4 rounded-2xl border-2 {{ $staff->access_renewals ? 'border-emerald-500 bg-emerald-50/30' : 'border-slate-100 bg-slate-50/50 grayscale' }} flex items-center gap-3">
                                    <div class="h-8 w-8 rounded-lg bg-white flex items-center justify-center {{ $staff->access_renewals ? 'text-emerald-600' : 'text-slate-300' }} shadow-sm">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    </div>
                                    <span class="text-[10px] font-black uppercase tracking-widest {{ $staff->access_renewals ? 'text-emerald-700' : 'text-slate-400' }}">Renewals</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer Stats -->
                <div class="p-8 bg-slate-50 border-t border-slate-100 flex items-center justify-between">
                    <div class="flex gap-8">
                        <div class="text-center">
                            <div class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Status</div>
                            <div class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest {{ $staff->status == 'active' ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700' }}">
                                {{ $staff->status }}
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <form action="{{ route('staff.destroy', $staff) }}" method="POST" onsubmit="return confirm('Archive this staff member?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-xs font-black text-rose-400 uppercase tracking-widest hover:text-rose-600 transition-colors">Archive Profile</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
