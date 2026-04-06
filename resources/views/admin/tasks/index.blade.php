@extends('layouts.dashboard')

@section('title', 'Task Management')

@section('sidebar')
    @include('admin.partials.sidebar')
@endsection

@section('page-title', 'Task Management')

@section('header-actions')
    <a href="{{ route('admin.tasks.create') }}" class="inline-flex items-center gap-2 rounded-xl bg-solar-500 px-4 py-2.5 text-sm font-semibold text-dark-900 transition hover:bg-solar-600">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
        Assign Task
    </a>
@endsection

@section('content')
    @php
        $priorityBadge = fn(string $p): string => match($p) {
            'urgent' => 'bg-red-500/10 text-red-600 dark:text-red-400',
            'high' => 'bg-amber-500/10 text-amber-600 dark:text-amber-400',
            'medium' => 'bg-blue-500/10 text-blue-600 dark:text-blue-400',
            'low' => 'bg-gray-500/10 text-gray-600 dark:text-gray-400',
            default => 'bg-gray-500/10 text-gray-600 dark:text-gray-400',
        };

        $typeBadge = fn(string $t): string => match($t) {
            'kyc' => 'bg-violet-500/10 text-violet-600 dark:text-violet-400',
            'installation' => 'bg-cyan-500/10 text-cyan-600 dark:text-cyan-400',
            'loan' => 'bg-indigo-500/10 text-indigo-600 dark:text-indigo-400',
            'visit' => 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400',
            'emi_collection' => 'bg-orange-500/10 text-orange-600 dark:text-orange-400',
            default => 'bg-white/5 t-muted',
        };

        $statusBadge = fn(string $s): string => match($s) {
            'completed' => 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400',
            'in_progress' => 'bg-blue-500/10 text-blue-600 dark:text-blue-400',
            'pending' => 'bg-amber-500/10 text-amber-600 dark:text-amber-400',
            'cancelled' => 'bg-white/5 text-gray-600 dark:text-gray-400',
            default => 'bg-gray-500/10 text-gray-600 dark:text-gray-400',
        };

        $typeLabel = fn(string $t): string => match($t) {
            'kyc' => 'KYC',
            'emi_collection' => 'EMI collection',
            default => ucfirst(str_replace('_', ' ', $t)),
        };
    @endphp

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
        <div class="stat-card animate-fade-in">
            <span class="text-[11px] font-medium t-faint uppercase tracking-wider">Matching tasks</span>
            <div class="text-2xl font-bold t-primary mt-1.5 tabular-nums">{{ $tasks->total() }}</div>
        </div>
        <div class="stat-card animate-fade-in delay-1">
            <span class="text-[11px] font-medium t-faint uppercase tracking-wider">Showing</span>
            <div class="text-lg font-semibold t-secondary mt-1.5 tabular-nums">
                @if($tasks->total() > 0)
                    {{ $tasks->firstItem() }}–{{ $tasks->lastItem() }} <span class="t-muted font-normal text-sm">of {{ $tasks->total() }}</span>
                @else
                    <span class="t-muted">—</span>
                @endif
            </div>
        </div>
    </div>

    <form method="GET" action="{{ route('admin.tasks.index') }}" class="mb-6 glass rounded-2xl p-4 sm:p-5">
        <div class="flex flex-col gap-3 lg:flex-row lg:flex-wrap lg:items-end">
            <div class="flex-1 min-w-[180px]">
                <label for="assigned_to" class="block text-[11px] font-medium t-muted mb-1.5">Assigned to</label>
                <select name="assigned_to" id="assigned_to"
                    class="w-full rounded-xl border border-theme bg-input px-4 py-2.5 text-sm t-primary focus:border-solar-500 focus:outline-none focus:ring-2 focus:ring-solar-500/20">
                    <option value="">All employees</option>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}" @selected(request('assigned_to') == $employee->id)>{{ $employee->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="min-w-[160px]">
                <label for="status" class="block text-[11px] font-medium t-muted mb-1.5">Status</label>
                <select name="status" id="status"
                    class="w-full rounded-xl border border-theme bg-input px-4 py-2.5 text-sm t-primary focus:border-solar-500 focus:outline-none focus:ring-2 focus:ring-solar-500/20">
                    <option value="">All statuses</option>
                    <option value="pending" @selected(request('status') === 'pending')>Pending</option>
                    <option value="in_progress" @selected(request('status') === 'in_progress')>In progress</option>
                    <option value="completed" @selected(request('status') === 'completed')>Completed</option>
                    <option value="cancelled" @selected(request('status') === 'cancelled')>Cancelled</option>
                </select>
            </div>
            <div class="min-w-[160px]">
                <label for="type" class="block text-[11px] font-medium t-muted mb-1.5">Type</label>
                <select name="type" id="type"
                    class="w-full rounded-xl border border-theme bg-input px-4 py-2.5 text-sm t-primary focus:border-solar-500 focus:outline-none focus:ring-2 focus:ring-solar-500/20">
                    <option value="">All types</option>
                    <option value="kyc" @selected(request('type') === 'kyc')>KYC</option>
                    <option value="installation" @selected(request('type') === 'installation')>Installation</option>
                    <option value="loan" @selected(request('type') === 'loan')>Loan</option>
                    <option value="visit" @selected(request('type') === 'visit')>Visit</option>
                    <option value="emi_collection" @selected(request('type') === 'emi_collection')>EMI collection</option>
                    <option value="other" @selected(request('type') === 'other')>Other</option>
                </select>
            </div>
            <div class="min-w-[140px]">
                <label for="priority" class="block text-[11px] font-medium t-muted mb-1.5">Priority</label>
                <select name="priority" id="priority"
                    class="w-full rounded-xl border border-theme bg-input px-4 py-2.5 text-sm t-primary focus:border-solar-500 focus:outline-none focus:ring-2 focus:ring-solar-500/20">
                    <option value="">All priorities</option>
                    <option value="low" @selected(request('priority') === 'low')>Low</option>
                    <option value="medium" @selected(request('priority') === 'medium')>Medium</option>
                    <option value="high" @selected(request('priority') === 'high')>High</option>
                    <option value="urgent" @selected(request('priority') === 'urgent')>Urgent</option>
                </select>
            </div>
            <div class="flex flex-wrap gap-2 pb-0.5">
                <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-solar-500 px-4 py-2.5 text-sm font-semibold text-dark-900 hover:bg-solar-400 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg>
                    Filter
                </button>
                @if(request()->hasAny(['assigned_to', 'status', 'type', 'priority']))
                    <a href="{{ route('admin.tasks.index') }}" class="inline-flex items-center justify-center rounded-2xl border border-theme bg-white/5 px-4 py-2.5 text-sm font-medium t-secondary hover:bg-white/10 transition">Reset</a>
                @endif
            </div>
        </div>
    </form>

    <div class="glass rounded-2xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="border-b border-subtle text-left text-[10px] font-semibold t-faint uppercase tracking-widest">
                        <th class="px-4 py-3">Title</th>
                        <th class="px-4 py-3">Assigned to</th>
                        <th class="px-4 py-3">Customer</th>
                        <th class="px-4 py-3">Type</th>
                        <th class="px-4 py-3">Priority</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Due date</th>
                        <th class="px-4 py-3 text-right">Update</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[var(--border-subtle)]">
                    @forelse($tasks as $task)
                        <tr class="hover:bg-[var(--bg-card-hover)] transition-colors align-top">
                            <td class="px-4 py-3 font-medium t-primary max-w-[200px]">
                                <span class="line-clamp-2">{{ $task->title }}</span>
                            </td>
                            <td class="px-4 py-3 t-secondary">{{ $task->assignee?->name ?? '—' }}</td>
                            <td class="px-4 py-3 t-secondary">{{ $task->customer?->name ?? '—' }}</td>
                            <td class="px-4 py-3">
                                <span class="inline-flex rounded-lg px-2.5 py-1 text-xs font-medium {{ $typeBadge($task->type) }}">
                                    {{ $typeLabel($task->type) }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <span class="inline-flex rounded-lg px-2.5 py-1 text-xs font-semibold capitalize {{ $priorityBadge($task->priority) }}">
                                    {{ $task->priority }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <span class="inline-flex rounded-lg px-2.5 py-1 text-xs font-semibold capitalize {{ $statusBadge($task->status) }}">
                                    {{ str_replace('_', ' ', $task->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 t-muted whitespace-nowrap">{{ $task->due_date?->format('d M Y') ?? '—' }}</td>
                            <td class="px-4 py-3 text-right">
                                @if($task->status !== 'completed')
                                    <form method="POST" action="{{ route('admin.tasks.update', $task) }}" class="inline-flex flex-wrap items-center justify-end gap-2">
                                        @csrf
                                        @method('PUT')
                                        <select name="status"
                                            class="max-w-[140px] rounded-lg border border-theme bg-input px-2 py-1.5 text-xs t-primary focus:border-solar-500 focus:outline-none focus:ring-1 focus:ring-solar-500/30">
                                            <option value="pending" @selected($task->status === 'pending')>Pending</option>
                                            <option value="in_progress" @selected($task->status === 'in_progress')>In progress</option>
                                            <option value="completed" @selected($task->status === 'completed')>Completed</option>
                                            <option value="cancelled" @selected($task->status === 'cancelled')>Cancelled</option>
                                        </select>
                                        <button type="submit" class="inline-flex rounded-lg bg-solar-500 px-2.5 py-1.5 text-xs font-semibold text-dark-900 hover:bg-solar-400 transition">
                                            Save
                                        </button>
                                    </form>
                                @else
                                    <span class="text-[11px] t-faint">—</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-12 text-center t-faint">No tasks found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($tasks->hasPages())
            <div class="border-t border-subtle px-4 py-4">
                {{ $tasks->withQueryString()->links() }}
            </div>
        @endif
    </div>
@endsection
