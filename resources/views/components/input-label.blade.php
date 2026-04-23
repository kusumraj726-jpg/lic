@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-[11px] font-black text-slate-900 dark:text-white uppercase tracking-widest mb-2']) }}>
    {{ $value ?? $slot }}
</label>
