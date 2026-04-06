@extends('layouts.dashboard')

@section('title', 'User Management')

@section('sidebar')
    @include('admin.partials.sidebar')
@endsection

@section('page-title', 'User Management')

@section('header-actions')
    <a href="{{ route('admin.users.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-solar-500 px-4 py-2.5 text-sm font-semibold text-dark-900 transition hover:bg-solar-600">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
        Create User
    </a>
@endsection

@section('content')
    <form method="GET" action="{{ route('admin.users.index') }}" class="mb-6 flex flex-col gap-3 sm:flex-row sm:flex-wrap sm:items-end">
        <div class="flex-1 min-w-[180px]">
            <label for="role" class="block text-[10px] font-semibold t-muted uppercase tracking-widest mb-1.5">Role</label>
            <select name="role" id="role"
                class="w-full rounded-xl border border-theme bg-input px-4 py-2.5 text-sm t-primary placeholder:text-[var(--text-faint)] focus:border-solar-500 focus:outline-none focus:ring-2 focus:ring-solar-500/20">
                <option value="">All roles</option>
                <option value="admin" @selected(request('role') === 'admin')>Admin</option>
                <option value="channel_partner" @selected(request('role') === 'channel_partner')>Channel partner</option>
                <option value="employee" @selected(request('role') === 'employee')>Employee</option>
                <option value="customer" @selected(request('role') === 'customer')>Customer</option>
            </select>
        </div>
        <div class="flex-1 min-w-[200px]">
            <label for="search" class="block text-[10px] font-semibold t-muted uppercase tracking-widest mb-1.5">Search</label>
            <input type="search" name="search" id="search" value="{{ request('search') }}" placeholder="Name or email"
                class="w-full rounded-xl border border-theme bg-input px-4 py-2.5 text-sm t-primary placeholder:text-[var(--text-faint)] focus:border-solar-500 focus:outline-none focus:ring-2 focus:ring-solar-500/20">
        </div>
        <div class="flex gap-2">
            <button type="submit" class="inline-flex rounded-xl bg-solar-500 px-4 py-2.5 text-sm font-semibold text-dark-900 transition hover:bg-solar-600">
                Apply
            </button>
            <a href="{{ route('admin.users.index') }}" class="inline-flex items-center rounded-xl border border-theme bg-white/5 px-4 py-2.5 text-sm font-semibold t-secondary transition hover:bg-white/10">
                Reset
            </a>
        </div>
    </form>

    <div class="glass rounded-2xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="border-b border-subtle text-left text-[10px] font-semibold t-faint uppercase tracking-widest">
                        <th class="px-6 py-4">Name</th>
                        <th class="px-6 py-4">Email</th>
                        <th class="px-6 py-4">Phone</th>
                        <th class="px-6 py-4">Role</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[var(--border-subtle)]">
                    @forelse($users as $user)
                        <tr class="hover:bg-[var(--bg-card-hover)] transition-colors">
                            <td class="px-6 py-4 font-medium t-primary">{{ $user->name }}</td>
                            <td class="px-6 py-4 t-secondary">{{ $user->email }}</td>
                            <td class="px-6 py-4 t-secondary">{{ $user->phone ?: '—' }}</td>
                            <td class="px-6 py-4">
                                @php
                                    $roleClass = match ($user->role) {
                                        'admin' => 'bg-violet-500/10 text-violet-600 dark:text-violet-400',
                                        'channel_partner' => 'bg-blue-500/10 text-blue-600 dark:text-blue-400',
                                        'employee' => 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400',
                                        default => 'bg-white/5 t-muted',
                                    };
                                @endphp
                                <span class="inline-flex rounded-lg px-2.5 py-1 text-xs font-semibold {{ $roleClass }}">
                                    {{ ucwords(str_replace('_', ' ', $user->role)) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if($user->is_active)
                                    <span class="inline-flex rounded-lg bg-emerald-500/10 px-2.5 py-1 text-xs font-semibold text-emerald-600 dark:text-emerald-400">Active</span>
                                @else
                                    <span class="inline-flex rounded-lg bg-white/5 px-2.5 py-1 text-xs font-semibold t-muted">Inactive</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <form method="POST" action="{{ route('admin.users.toggle', $user) }}" class="inline">
                                    @csrf
                                    <button type="submit" class="inline-flex rounded-lg border border-theme bg-white/5 px-3 py-1.5 text-xs font-semibold t-secondary transition hover:bg-white/10">
                                        Toggle
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center t-faint">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">{{ $users->links() }}</div>
@endsection
