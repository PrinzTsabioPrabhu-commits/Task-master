@props(['active'])

@php
$classes = ($active ?? false)
            ? 'nav-link-refined text-slate-900 border-brand-500 font-black'
            : 'nav-link-refined text-slate-400 hover:text-slate-900 font-bold';
@endphp

<a {{ $attributes->merge(['class' => $classes . ' inline-flex items-center px-1 pt-1 text-xs uppercase tracking-widest transition-all duration-300']) }}>
    {{ $slot }}
</a>
