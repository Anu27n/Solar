{{--
    Full-viewport backdrop: page-specific photo + shared overlay / grid / glows.
    Pass $marketingAtmosphereImage (URL) and optionally $marketingAtmospherePosition (e.g. center 42%).

    @include('partials.marketing-page-atmosphere', ['marketingAtmosphereImage' => $url, 'marketingAtmospherePosition' => 'center 35%'])
--}}
@php
    $bgUrl = $marketingAtmosphereImage ?? '/assets/images/hero-solar-sky.jpg';
    $bgPos = $marketingAtmospherePosition ?? 'center 40%';
@endphp
<div class="marketing-page-atmosphere fixed inset-0 z-0 pointer-events-none overflow-hidden" aria-hidden="true">
    <div class="absolute inset-0 marketing-atmosphere-photo" style="background-image: url('{{ $bgUrl }}'); background-position: {{ $bgPos }};"></div>
    <div class="absolute inset-0 hero-photo-overlay"></div>
    <div class="absolute inset-0 opacity-[0.028] dark:opacity-[0.038]" style="background-image: linear-gradient(rgba(0,223,130,0.32) 1px, transparent 1px), linear-gradient(90deg, rgba(0,223,130,0.32) 1px, transparent 1px); background-size: 56px 56px;"></div>
    <div class="absolute inset-0 opacity-[0.018] dark:opacity-[0.03]" style="background-image: radial-gradient(#00DF82 1px, transparent 1px); background-size: 52px 52px;"></div>
    <div class="absolute -top-24 left-[10%] w-[min(420px,92vw)] h-[min(420px,92vw)] max-w-[460px] max-h-[460px] bg-solarGreen/[0.07] rounded-full blur-[130px]"></div>
    <div class="absolute top-1/2 -translate-y-1/2 right-[-8%] w-[min(380px,88vw)] h-[min(380px,88vw)] max-w-[400px] max-h-[400px] bg-emerald-500/[0.06] rounded-full blur-[115px]"></div>
    <div class="absolute -bottom-16 left-1/3 w-[min(320px,80vw)] h-[min(320px,80vw)] bg-solarGreen/[0.05] rounded-full blur-[100px]"></div>
</div>
