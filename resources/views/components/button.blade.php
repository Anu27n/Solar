@props(['href' => '#', 'variant' => 'primary', 'type' => 'button'])

@php
    $baseClasses = 'inline-flex items-center justify-center font-bold px-8 py-4 rounded-xl transition-all duration-300 transform hover:-translate-y-0.5 shadow-lg';
    
    $variants = [
        'primary' => 'bg-emerald-500 hover:bg-emerald-400 text-slate-900 shadow-emerald-500/30',
        'secondary' => 'bg-white hover:bg-slate-50 text-slate-900 border border-slate-200 shadow-slate-200/50',
        'dark' => 'bg-slate-900 hover:bg-slate-800 text-white shadow-slate-900/30',
        'outline-light' => 'bg-transparent border-2 border-emerald-500/50 hover:bg-emerald-500/10 text-emerald-400 shadow-none'
    ];

    $classes = $baseClasses . ' ' . ($variants[$variant] ?? $variants['primary']);
@endphp

@if($type === 'link' || $href !== '#')
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif
