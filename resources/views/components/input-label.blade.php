@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-[11px] font-black text-slate-600 dark:text-slate-400 uppercase tracking-widest mb-2']) }}>
    {{ $value ?? $slot }}
</label>
