@props(['label', 'name', 'type' => 'text', 'required' => false, 'value' => null])

<div class="form-group {{ $attributes->get('class') }}">
    <label for="{{ $name }}" class="block text-[11px] font-black text-slate-900 dark:text-white uppercase tracking-widest mb-2">{{ $label }} @if($required)<span class="text-rose-500">*</span>@endif</label>
    <input type="{{ $type }}" id="{{ $name }}" name="{{ $name }}" 
           class="form-control @error($name) border-rose-500 @enderror dark:bg-slate-800 dark:border-slate-700 dark:text-slate-100 dark:placeholder-slate-500"
           value="{{ old($name, $value) }}" {{ $required ? 'required' : '' }} {{ $attributes->except(['label', 'name', 'type', 'required', 'value']) }}>
    @error($name)
        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>
