@extends('layouts.dashboard')

@section('title', 'Catalog & inventory')
@section('page-title', 'Catalog & inventory')
@section('page-subtitle', 'Published items on the website + stock counts')

@section('sidebar')
    @include('admin.partials.sidebar')
@endsection

@section('header-actions')
    <a href="{{ route('admin.catalog-items.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-solar-500 px-4 py-2.5 text-sm font-semibold text-dark-900 hover:bg-solar-400">
        Add item
    </a>
@endsection

@section('content')
    <form method="GET" class="mb-6 flex flex-col gap-3 sm:flex-row sm:flex-wrap sm:items-end">
        <div>
            <label class="block text-[10px] font-semibold t-muted uppercase mb-1">Company</label>
            <select name="company" class="rounded-xl border border-theme bg-input px-4 py-2.5 text-sm t-primary">
                <option value="">All</option>
                @foreach($companies as $c)
                    <option value="{{ $c->code }}" @selected(request('company') === $c->code)>{{ $c->name }}</option>
                @endforeach
            </select>
        </div>
        <label class="inline-flex items-center gap-2 text-sm t-secondary cursor-pointer">
            <input type="checkbox" name="low_stock" value="1" @checked(request()->boolean('low_stock'))>
            Low stock (&lt; 10)
        </label>
        <button type="submit" class="rounded-xl bg-solar-500 px-4 py-2.5 text-sm font-semibold text-dark-900">Filter</button>
        <a href="{{ route('admin.catalog-items.index') }}" class="rounded-xl border border-theme px-4 py-2.5 text-sm t-secondary">Reset</a>
    </form>

    <div class="glass rounded-2xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="border-b border-subtle text-left text-[10px] font-semibold t-faint uppercase tracking-widest">
                        <th class="px-4 py-3">Company</th>
                        <th class="px-4 py-3">Item</th>
                        <th class="px-4 py-3">SKU</th>
                        <th class="px-4 py-3 text-right">List price</th>
                        <th class="px-4 py-3 text-right">Stock</th>
                        <th class="px-4 py-3">Web</th>
                        <th class="px-4 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[var(--border-subtle)]">
                    @forelse($items as $item)
                        <tr>
                            <td class="px-4 py-3 text-xs t-secondary">{{ $item->company->name }}</td>
                            <td class="px-4 py-3 font-medium t-primary">{{ $item->name }}</td>
                            <td class="px-4 py-3 t-muted">{{ $item->sku ?: '—' }}</td>
                            <td class="px-4 py-3 text-right tabular-nums">{{ $item->list_price !== null ? '₹'.number_format((float) $item->list_price, 2) : '—' }}</td>
                            <td class="px-4 py-3 text-right tabular-nums {{ $item->stock_quantity < 10 ? 'text-amber-600 dark:text-amber-400 font-semibold' : '' }}">{{ $item->stock_quantity }}</td>
                            <td class="px-4 py-3">{{ $item->is_published ? 'Yes' : 'No' }}</td>
                            <td class="px-4 py-3 text-right space-x-2">
                                <a href="{{ route('admin.catalog-items.edit', $item) }}" class="text-solar-600 dark:text-solar-400 text-xs font-semibold">Edit</a>
                                <form action="{{ route('admin.catalog-items.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Delete this item?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-500 text-xs font-semibold">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="px-4 py-8 text-center t-muted">No catalog items. Add items per company for the public catalog and stock tracking.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-6">{{ $items->links() }}</div>
@endsection
