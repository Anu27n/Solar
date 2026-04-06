@extends('layouts.dashboard')

@section('title', 'Edit Package')

@section('sidebar')
    @include('admin.partials.sidebar')
@endsection

@section('page-title', 'Edit Package')

@section('content')
    <div class="max-w-2xl">
        <form method="POST" action="{{ route('admin.packages.update', $package) }}" class="space-y-6 glass rounded-2xl p-6 sm:p-8">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-xs font-medium t-muted mb-1.5">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $package->name) }}" required
                    class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm placeholder:text-[var(--text-faint)] focus:outline-none focus:ring-2 focus:ring-solar-500 focus:border-transparent">
            </div>

            <div>
                <label for="system_size_kw" class="block text-xs font-medium t-muted mb-1.5">System Size (kW)</label>
                <input type="number" name="system_size_kw" id="system_size_kw" value="{{ old('system_size_kw', $package->system_size_kw) }}" step="0.01" min="0.1" required
                    class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm placeholder:text-[var(--text-faint)] focus:outline-none focus:ring-2 focus:ring-solar-500 focus:border-transparent">
            </div>

            <div>
                <label for="price" class="block text-xs font-medium t-muted mb-1.5">Price (₹)</label>
                <input type="number" name="price" id="price" value="{{ old('price', $package->price) }}" step="0.01" min="0" required
                    class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm placeholder:text-[var(--text-faint)] focus:outline-none focus:ring-2 focus:ring-solar-500 focus:border-transparent">
            </div>

            <div>
                <label for="estimated_generation" class="block text-xs font-medium t-muted mb-1.5">Estimated Generation</label>
                <input type="text" name="estimated_generation" id="estimated_generation" value="{{ old('estimated_generation', $package->estimated_generation) }}"
                    class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm placeholder:text-[var(--text-faint)] focus:outline-none focus:ring-2 focus:ring-solar-500 focus:border-transparent">
            </div>

            <div>
                <label for="warranty_details" class="block text-xs font-medium t-muted mb-1.5">Warranty Details</label>
                <input type="text" name="warranty_details" id="warranty_details" value="{{ old('warranty_details', $package->warranty_details) }}"
                    class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm placeholder:text-[var(--text-faint)] focus:outline-none focus:ring-2 focus:ring-solar-500 focus:border-transparent">
            </div>

            <div>
                <label for="description" class="block text-xs font-medium t-muted mb-1.5">Description</label>
                <textarea name="description" id="description" rows="4"
                    class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm placeholder:text-[var(--text-faint)] focus:outline-none focus:ring-2 focus:ring-solar-500 focus:border-transparent">{{ old('description', $package->description) }}</textarea>
            </div>

            <div>
                <label for="type" class="block text-xs font-medium t-muted mb-1.5">Type</label>
                <select name="type" id="type" required
                    class="w-full rounded-xl bg-input border border-theme t-primary px-4 py-2.5 text-sm placeholder:text-[var(--text-faint)] focus:outline-none focus:ring-2 focus:ring-solar-500 focus:border-transparent">
                    <option value="domestic" @selected(old('type', $package->type) === 'domestic')>Domestic</option>
                    <option value="commercial" @selected(old('type', $package->type) === 'commercial')>Commercial</option>
                </select>
            </div>

            <div class="flex flex-wrap items-center gap-3 pt-2">
                <button type="submit" class="inline-flex rounded-xl bg-solar-500 px-5 py-2.5 text-sm font-semibold text-dark-900 shadow-sm hover:bg-solar-600 transition">
                    Save Changes
                </button>
                <a href="{{ route('admin.packages.index') }}" class="inline-flex rounded-xl border border-theme bg-white/5 px-5 py-2.5 text-sm font-semibold t-secondary hover:bg-white/10 transition">
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection
