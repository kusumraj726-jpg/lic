@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-slate-200 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-100 dark:placeholder-slate-500 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm transition-all']) }}>
