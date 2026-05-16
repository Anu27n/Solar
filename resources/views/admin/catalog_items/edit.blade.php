@extends('layouts.dashboard')

@section('title', 'Edit catalog item')

@section('sidebar')
    @include('admin.partials.sidebar')
@endsection

@section('page-title', 'Edit catalog item')

@section('content')
    <div class="max-w-xl">
        <form method="POST" action="{{ route('admin.catalog-items.update', $item) }}" class="space-y-5 glass rounded-2xl p-6 sm:p-8">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-xs font-medium t-muted mb-1.5">Company <span class="text-red-500">*</span></label>
                <select name="company_profile_id" required class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm">
                    @foreach($companies as $c)
                        <option value="{{ $c->id }}" @selected(old('company_profile_id', $item->company_profile_id) == $c->id)>{{ $c->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium t-muted mb-1.5">Name <span class="text-red-500">*</span></label>
                <input type="text" name="name" value="{{ old('name', $item->name) }}" required class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm">
            </div>
            <div>
                <label class="block text-xs font-medium t-muted mb-1.5">Description</label>
                <textarea name="description" rows="3" class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm">{{ old('description', $item->description) }}</textarea>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-medium t-muted mb-1.5">SKU</label>
                    <input type="text" name="sku" value="{{ old('sku', $item->sku) }}" class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm">
                </div>
                <div>
                    <label class="block text-xs font-medium t-muted mb-1.5">Unit</label>
                    <input type="text" name="unit" value="{{ old('unit', $item->unit) }}" required class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm">
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-medium t-muted mb-1.5">List price (₹)</label>
                    <input type="number" step="0.01" min="0" name="list_price" value="{{ old('list_price', $item->list_price) }}" class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm">
                </div>
                <div>
                    <label class="block text-xs font-medium t-muted mb-1.5">Stock quantity <span class="text-red-500">*</span></label>
                    <input type="number" min="0" name="stock_quantity" value="{{ old('stock_quantity', $item->stock_quantity) }}" required class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm">
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-medium t-muted mb-1.5">Sort position</label>
                    <input type="number" min="0" name="position" value="{{ old('position', $item->position) }}" class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm">
                </div>
                <div class="flex items-end pb-2">
                    <label class="inline-flex items-center gap-2 cursor-pointer text-sm t-secondary">
                        <input type="checkbox" name="is_published" value="1" @checked(old('is_published', $item->is_published))>
                        Published on website
                    </label>
                </div>
            </div>
            <div class="flex gap-3 pt-2">
                <button type="submit" class="rounded-xl bg-solar-500 px-5 py-2.5 text-sm font-semibold text-dark-900">Update</button>
                <a href="{{ route('admin.catalog-items.index') }}" class="rounded-xl border border-theme px-5 py-2.5 text-sm t-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection
