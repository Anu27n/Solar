@props(['title', 'icon' => null, 'description' => null])

<div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-sm hover:shadow-2xl hover:shadow-emerald-900/5 transition-all duration-300 group">
    @if($icon)
        <div class="w-16 h-16 bg-slate-50 rounded-2xl flex items-center justify-center mb-6 text-emerald-500 group-hover:scale-110 group-hover:bg-emerald-50 transition-all duration-300 border border-slate-100 group-hover:border-emerald-100">
            {!! $icon !!}
        </div>
    @endif
    
    <h3 class="text-xl font-black text-slate-900 mb-4">{{ $title }}</h3>
    
    @if($description)
        <p class="text-slate-500 font-medium leading-relaxed">
            {{ $description }}
        </p>
    @endif
    
    {{ $slot }}
</div>
