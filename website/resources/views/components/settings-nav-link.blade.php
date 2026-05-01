@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center gap-4 px-6 py-4 rounded-[1.5rem] bg-white dark:bg-slate-800 shadow-xl text-indigo-600 dark:text-indigo-400 font-black border border-indigo-50 dark:border-indigo-500/20 transition-all duration-300 group'
            : 'flex items-center gap-4 px-6 py-4 rounded-[1.5rem] text-slate-500 dark:text-slate-400 font-bold hover:bg-white dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white hover:shadow-lg transition-all duration-300 group';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    <div class="shrink-0 transition-transform duration-300 group-hover:scale-110">
        {{ $slot->preview ?? '' }}
        {{ $slot }}
    </div>
</a>
