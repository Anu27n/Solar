@extends('layouts.dashboard')

@section('title', 'Edit Quotation')
@section('page-title', 'Edit Quotation #' . $quotation->reference_number)
@section('page-subtitle', 'Update line items, terms or customer')

@section('sidebar')
    @include('admin.partials.sidebar')
@endsection

@section('content')
    <div class="max-w-5xl">
        @include('admin.quotations._form')
    </div>
@endsection
