@extends('layouts.dashboard')

@section('title', 'Quotation ' . $quotation->reference_number)
@section('page-title', 'Quotation ' . $quotation->reference_number)
@section('page-subtitle', $quotation->company?->name)

@section('sidebar')
    @include('partner.partials.sidebar')
@endsection

@section('header-actions')
    <a href="{{ route('partner.quotations.pdf', $quotation) }}" target="_blank" class="inline-flex items-center gap-2 rounded-xl bg-solar-500 px-4 py-2.5 text-sm font-semibold text-dark-900 hover:bg-solar-400 transition">
        Download PDF
    </a>
    <a href="{{ route('partner.quotations.index') }}" class="inline-flex rounded-xl border border-theme bg-white/5 px-4 py-2.5 text-sm font-semibold t-secondary hover:bg-white/10 transition">Back</a>
@endsection

@section('content')
    @include('admin.quotations._preview', ['quotation' => $quotation])
@endsection
