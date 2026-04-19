@extends('layouts.dashboard')

@section('title', 'Create Quotation')
@section('page-title', 'Create Quotation')
@section('page-subtitle', 'Pick a company, add line items, generate a PDF')

@section('sidebar')
    @include('admin.partials.sidebar')
@endsection

@section('content')
    <div class="max-w-5xl">
        @include('admin.quotations._form')
    </div>
@endsection
