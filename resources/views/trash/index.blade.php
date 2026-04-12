<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Trash Bin Management') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-3xl font-extrabold text-gray-900">Trash Bin</h2>
                    <p class="text-gray-500 mt-1">Manage archived records and recover deleted items.</p>
                </div>
                <div class="flex items-center gap-3">
                    <form action="{{ route('trash.index') }}" method="GET" class="relative group">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Filter trashed items..." class="pl-10 pr-4 py-2.5 rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white shadow-sm w-64 transition-all">
                        <svg class="h-5 w-5 absolute left-3 top-3 text-slate-400 group-focus-within:text-indigo-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                    </form>
                </div>
            </div>

            <div class="space-y-12">
                @foreach($trashed as $type => $records)
                    <div class="premium-card !p-0 overflow-hidden border-none shadow-lg">
                        <div class="bg-slate-50 px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                            <h3 class="text-lg font-black text-slate-800 uppercase tracking-tighter">{{ $type }} Archive</h3>
                            <span class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full text-xs font-bold">{{ count($records) }} items</span>
                        </div>
                        
                        <div class="overflow-x-auto">
                            <table class="premium-table">
                                <thead>
                                    <tr>
                                        <th>Details</th>
                                        <th>Deleted Date</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($records as $record)
                                        <tr class="hover:bg-slate-50 transition-colors">
                                            <td class="px-6 py-4">
                                                <div class="font-bold text-gray-900">
                                                    {{ $record->name ?? $record->subject ?? 'Record #' . $record->id }}
                                                </div>
                                                @if(isset($record->client))
                                                    <div class="text-xs text-indigo-600 mt-1">Client: {{ $record->client->name }}</div>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-500">
                                                {{ $record->deleted_at->format('M d, Y H:i') }}
                                                <div class="text-xs text-gray-400 mt-0.5">{{ $record->deleted_at->diffForHumans() }}</div>
                                            </td>
                                            <td class="px-6 py-4 text-right">
                                                <div class="flex items-center justify-end gap-3 text-sm font-bold uppercase tracking-wider">
                                                    <form action="{{ route('trash.restore', [$type, $record->id]) }}" method="POST" class="inline">
                                                        @csrf
                                                        <button type="submit" class="text-emerald-600 hover:text-emerald-900 flex items-center gap-1 group">
                                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg>
                                                            Restore
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('trash.force-delete', [$type, $record->id]) }}" method="POST" class="inline">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="text-rose-600 hover:text-rose-900 flex items-center gap-1 group" onclick="return confirm('Permanently delete this record? This cannot be undone.')">
                                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                                            Purge
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="px-6 py-8 text-center text-gray-400 italic">No deleted records in this module.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
