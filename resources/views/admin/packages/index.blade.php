@extends('layouts.dashboard')

@section('title', 'Solar Packages')

@section('sidebar')
    @include('admin.partials.sidebar')
@endsection

@section('page-title', 'Solar Packages')

@section('header-actions')
    <a href="{{ route('admin.packages.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-solar-500 px-4 py-2.5 text-sm font-semibold text-dark-900 transition hover:bg-solar-600">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
        Create Package
    </a>
@endsection

@section('content')
    <div class="glass rounded-2xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="border-b border-subtle text-left text-[10px] font-semibold t-faint uppercase tracking-widest">
                        <th class="px-6 py-4">Name</th>
                        <th class="px-6 py-4">System Size (kW)</th>
                        <th class="px-6 py-4">Price (₹)</th>
                        <th class="px-6 py-4">Type</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[var(--border-subtle)]">
                    @forelse($packages as $package)
                        <tr class="hover:bg-[var(--bg-card-hover)] transition-colors">
                            <td class="px-6 py-4 font-medium t-primary">{{ $package->name }}</td>
                            <td class="px-6 py-4 t-secondary">{{ number_format((float) $package->system_size_kw, 2) }}</td>
                            <td class="px-6 py-4 t-secondary">{{ number_format((float) $package->price, 2) }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex rounded-lg px-2.5 py-1 text-xs font-medium {{ $package->type === 'commercial' ? 'bg-violet-500/10 text-violet-600 dark:text-violet-400' : 'bg-blue-500/10 text-blue-600 dark:text-blue-400' }}">
                                    {{ ucfirst($package->type) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if($package->is_active)
                                    <span class="inline-flex rounded-lg bg-emerald-500/10 px-2.5 py-1 text-xs font-semibold text-emerald-600 dark:text-emerald-400">Active</span>
                                @else
                                    <span class="inline-flex rounded-lg bg-white/5 px-2.5 py-1 text-xs font-semibold t-muted">Inactive</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex flex-wrap items-center justify-end gap-2">
                                    <a href="{{ route('admin.packages.edit', $package) }}" class="inline-flex rounded-lg border border-theme bg-white/5 px-3 py-1.5 text-xs font-semibold t-secondary hover:bg-white/10">Edit</a>
                                    <form method="POST" action="{{ route('admin.packages.toggle', $package) }}" class="inline">
                                        @csrf
                                        <button type="submit" class="inline-flex rounded-lg border border-theme bg-white/5 px-3 py-1.5 text-xs font-semibold t-secondary hover:bg-white/10">
                                            Toggle
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center t-faint">No packages yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6 border-t border-subtle pt-6 flex flex-wrap items-center justify-center gap-2 sm:justify-end">
        {{ $packages->links() }}
    </div>
@endsection
