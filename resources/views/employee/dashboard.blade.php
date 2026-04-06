@extends('layouts.dashboard')

@section('title', 'Employee Dashboard')
@section('page-title', 'My Dashboard')
@section('page-subtitle', 'Tasks, queues, and attendance at a glance')

@section('sidebar')
    <a href="{{ route('employee.dashboard') }}" class="sidebar-link active">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></svg>
        Dashboard
    </a>
@endsection

@php
    $typeBadge = function (?string $type) {
        $t = strtolower((string) $type);
        return match (true) {
            str_contains($t, 'kyc') => 'bg-violet-500/10 text-violet-600 dark:text-violet-400 border-violet-500/20',
            str_contains($t, 'loan') => 'bg-blue-500/10 text-blue-600 dark:text-blue-400 border-blue-500/20',
            str_contains($t, 'install') => 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border-emerald-500/20',
            default => 'bg-slate-500/10 text-slate-600 dark:text-slate-400 border-slate-500/20',
        };
    };
    $priorityBadge = function (?string $p) {
        return match (strtolower((string) $p)) {
            'urgent' => 'bg-red-500/10 text-red-600 dark:text-red-400 border-red-500/20',
            'high' => 'bg-amber-500/10 text-amber-600 dark:text-amber-400 border-amber-500/20',
            'medium' => 'bg-blue-500/10 text-blue-600 dark:text-blue-400 border-blue-500/20',
            'low' => 'bg-slate-500/10 text-slate-600 dark:text-slate-400 border-slate-500/20',
            default => 'bg-slate-500/10 text-slate-600 dark:text-slate-400 border-slate-500/20',
        };
    };
@endphp

@section('content')
<div class="space-y-8 max-w-[1600px] mx-auto">
    {{-- 1. Check-in / Check-out --}}
    <div class="glass rounded-2xl p-4 sm:p-5 border border-theme animate-fade-in">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="flex items-start gap-3">
                <div class="p-2 rounded-xl bg-solar-500/10 border border-solar-500/20 shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-emerald-600 dark:text-emerald-400"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                </div>
                <div>
                    <h2 class="text-sm font-semibold t-primary">Attendance</h2>
                    @if(!$todayAttendance)
                        <p class="text-xs t-muted mt-0.5">You have not checked in today.</p>
                    @elseif(!$todayAttendance->check_out)
                        <p class="text-xs t-secondary mt-0.5">
                            Checked in at <span class="font-medium t-primary tabular-nums">{{ \Illuminate\Support\Carbon::parse($todayAttendance->check_in)->format('g:i A') }}</span>
                        </p>
                    @else
                        <p class="text-xs t-secondary mt-0.5">
                            Checked in at <span class="font-medium t-primary tabular-nums">{{ \Illuminate\Support\Carbon::parse($todayAttendance->check_in)->format('g:i A') }}</span>
                            <span class="t-faint mx-1">—</span>
                            Checked out at <span class="font-medium t-primary tabular-nums">{{ \Illuminate\Support\Carbon::parse($todayAttendance->check_out)->format('g:i A') }}</span>
                        </p>
                    @endif
                </div>
            </div>
            <div class="flex items-center gap-2 shrink-0">
                @if(!$todayAttendance)
                    <form method="POST" action="{{ route('employee.checkin') }}" class="inline">
                        @csrf
                        <button type="submit" class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-xl text-sm font-semibold bg-solar-500 hover:bg-solar-600 text-dark-900 shadow-lg shadow-solar-500/25 transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
                            Check In
                        </button>
                    </form>
                @elseif(!$todayAttendance->check_out)
                    <form method="POST" action="{{ route('employee.checkout') }}" class="inline">
                        @csrf
                        <button type="submit" class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-xl text-sm font-semibold border border-theme bg-input t-primary hover:border-solar-500/40 transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14"/></svg>
                            Check Out
                        </button>
                    </form>
                @else
                    <span class="text-[11px] font-medium px-3 py-1.5 rounded-lg bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/20">Day complete</span>
                @endif
            </div>
        </div>
    </div>

    {{-- 2. Daily overview --}}
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3 sm:gap-4">
        <div class="stat-card animate-fade-in">
            <p class="text-[10px] font-semibold uppercase tracking-wider t-muted">Tasks Today</p>
            <p class="text-2xl font-bold t-primary mt-2 tabular-nums" data-count="{{ $taskStats['total_today'] ?? 0 }}">0</p>
        </div>
        <div class="stat-card animate-fade-in delay-1 border-amber-500/10">
            <p class="text-[10px] font-semibold uppercase tracking-wider text-amber-600 dark:text-amber-400">Pending</p>
            <p class="text-2xl font-bold text-amber-600 dark:text-amber-400 mt-2 tabular-nums" data-count="{{ $taskStats['pending'] ?? 0 }}">0</p>
        </div>
        <div class="stat-card animate-fade-in delay-2 border-blue-500/10">
            <p class="text-[10px] font-semibold uppercase tracking-wider text-blue-600 dark:text-blue-400">In Progress</p>
            <p class="text-2xl font-bold text-blue-600 dark:text-blue-400 mt-2 tabular-nums" data-count="{{ $taskStats['in_progress'] ?? 0 }}">0</p>
        </div>
        <div class="stat-card animate-fade-in delay-3 border-emerald-500/10">
            <p class="text-[10px] font-semibold uppercase tracking-wider text-emerald-600 dark:text-emerald-400">Completed</p>
            <p class="text-2xl font-bold text-emerald-600 dark:text-emerald-400 mt-2 tabular-nums" data-count="{{ $taskStats['completed'] ?? 0 }}">0</p>
        </div>
        <div class="stat-card animate-fade-in delay-4 border-red-500/15 col-span-2 sm:col-span-1 lg:col-span-1 relative overflow-hidden">
            <span class="absolute top-2 right-2 flex h-2 w-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-red-500"></span>
            </span>
            <p class="text-[10px] font-semibold uppercase tracking-wider text-red-600 dark:text-red-400">Urgent</p>
            <p class="text-2xl font-bold text-red-600 dark:text-red-400 mt-2 tabular-nums animate-pulse" data-count="{{ $taskStats['urgent'] ?? 0 }}">0</p>
        </div>
    </div>

    {{-- 3. My Tasks --}}
    <section class="animate-fade-in delay-2">
        <div class="flex items-center justify-between gap-4 mb-4">
            <div>
                <h2 class="text-base font-semibold t-primary">My Tasks</h2>
                <p class="text-[11px] t-muted mt-0.5">Update status and add remarks for your assigned work.</p>
            </div>
        </div>
        <div class="glass rounded-2xl border border-theme overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm min-w-[720px]">
                    <thead>
                        <tr class="border-b border-subtle bg-input/50">
                            <th class="px-4 py-3 text-left text-[10px] font-semibold t-faint uppercase tracking-widest">Task</th>
                            <th class="px-3 py-3 text-left text-[10px] font-semibold t-faint uppercase tracking-widest">Type</th>
                            <th class="px-3 py-3 text-left text-[10px] font-semibold t-faint uppercase tracking-widest">Priority</th>
                            <th class="px-3 py-3 text-left text-[10px] font-semibold t-faint uppercase tracking-widest">Customer</th>
                            <th class="px-3 py-3 text-left text-[10px] font-semibold t-faint uppercase tracking-widest">Due</th>
                            <th class="px-4 py-3 text-left text-[10px] font-semibold t-faint uppercase tracking-widest min-w-[280px]">Update</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[color:var(--border-subtle)]">
                        @forelse($todayTasks as $task)
                            <tr class="align-top hover:bg-[var(--bg-card-hover)] transition-colors">
                                <td class="px-4 py-4">
                                    <p class="font-medium t-primary">{{ $task->title }}</p>
                                </td>
                                <td class="px-3 py-4">
                                    <span class="inline-flex text-[10px] px-2 py-0.5 rounded-md font-medium border {{ $typeBadge($task->type) }}">{{ $task->type ? str_replace('_', ' ', $task->type) : '—' }}</span>
                                </td>
                                <td class="px-3 py-4">
                                    <span class="inline-flex text-[10px] px-2 py-0.5 rounded-md font-medium border {{ $priorityBadge($task->priority) }}">{{ ucfirst($task->priority ?? '—') }}</span>
                                </td>
                                <td class="px-3 py-4 t-secondary">{{ $task->customer?->name ?? '—' }}</td>
                                <td class="px-3 py-4 t-muted tabular-nums text-xs">{{ $task->due_date ? $task->due_date->format('M j, Y') : '—' }}</td>
                                <td class="px-4 py-4">
                                    <form method="POST" action="{{ route('employee.tasks.update', $task) }}" class="space-y-2">
                                        @csrf
                                        @method('PUT')
                                        <div class="flex flex-wrap gap-2">
                                            <select name="status" class="text-xs rounded-lg border border-theme bg-input t-primary px-2 py-1.5 min-w-[120px] focus:ring-2 focus:ring-solar-500/30 focus:border-solar-500/40 outline-none">
                                                <option value="pending" @selected($task->status === 'pending')>Pending</option>
                                                <option value="in_progress" @selected($task->status === 'in_progress')>In progress</option>
                                                <option value="completed" @selected($task->status === 'completed')>Completed</option>
                                            </select>
                                            <button type="submit" class="text-xs font-semibold px-3 py-1.5 rounded-lg bg-solar-500/15 text-emerald-600 dark:text-emerald-400 border border-emerald-500/20 hover:bg-solar-500/25 transition-colors">Submit</button>
                                        </div>
                                        <textarea name="remarks" rows="2" placeholder="Remarks (optional)" class="w-full text-xs rounded-lg border border-theme bg-input t-secondary placeholder:t-faint px-2 py-1.5 resize-y min-h-[52px] focus:ring-2 focus:ring-solar-500/30 outline-none">{{ old('remarks', $task->remarks) }}</textarea>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-5 py-14 text-center">
                                    <p class="t-faint text-sm">No active tasks right now.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    {{-- 4. Work queue --}}
    <div class="grid lg:grid-cols-2 gap-6 animate-fade-in delay-3">
        <div class="glass rounded-2xl border border-theme flex flex-col min-h-[200px]">
            <div class="px-5 py-4 border-b border-subtle flex items-center justify-between">
                <h3 class="text-sm font-semibold t-primary">KYC Pending</h3>
                <span class="text-[10px] font-medium t-faint tabular-nums">{{ $kycPending->count() }}</span>
            </div>
            <ul class="divide-y divide-[color:var(--border-subtle)] flex-1">
                @forelse($kycPending as $customer)
                    <li class="px-5 py-3.5 flex items-start justify-between gap-3">
                        <div class="min-w-0">
                            <p class="text-sm font-medium t-primary truncate">{{ $customer->name }}</p>
                            <p class="text-xs t-muted tabular-nums mt-0.5">{{ $customer->phone ?? '—' }}</p>
                        </div>
                        <span class="text-[11px] shrink-0 px-2 py-0.5 rounded-md bg-violet-500/10 text-violet-600 dark:text-violet-400 font-medium border border-violet-500/20">{{ $customer->kycDocuments->count() }} docs</span>
                    </li>
                @empty
                    <li class="px-5 py-10 text-center text-sm t-faint">No pending KYC reviews.</li>
                @endforelse
            </ul>
        </div>
        <div class="glass rounded-2xl border border-theme flex flex-col min-h-[200px]">
            <div class="px-5 py-4 border-b border-subtle flex items-center justify-between">
                <h3 class="text-sm font-semibold t-primary">Loan Reviews</h3>
                <span class="text-[10px] font-medium t-faint tabular-nums">{{ $loanPending->count() }}</span>
            </div>
            <ul class="divide-y divide-[color:var(--border-subtle)] flex-1">
                @forelse($loanPending as $loan)
                    <li class="px-5 py-3.5">
                        <div class="flex items-start justify-between gap-2">
                            <p class="text-sm font-medium t-primary">{{ $loan->customer?->name ?? '—' }}</p>
                            <span class="text-[10px] px-2 py-0.5 rounded-md bg-blue-500/10 text-blue-600 dark:text-blue-400 font-medium border border-blue-500/20 shrink-0">{{ str_replace('_', ' ', $loan->status) }}</span>
                        </div>
                        <p class="text-xs t-muted mt-1">{{ $loan->bank_name ?? 'Bank' }} · <span class="tabular-nums">₹{{ number_format((float) $loan->loan_amount, 0) }}</span></p>
                    </li>
                @empty
                    <li class="px-5 py-10 text-center text-sm t-faint">No loans awaiting review.</li>
                @endforelse
            </ul>
        </div>
    </div>

    {{-- 5. Installations --}}
    <div class="grid lg:grid-cols-2 gap-6 animate-fade-in delay-4">
        <div class="glass rounded-2xl border border-theme">
            <div class="px-5 py-4 border-b border-subtle">
                <h3 class="text-sm font-semibold t-primary">Today's Installations</h3>
                <p class="text-[11px] t-muted mt-0.5">Scheduled for {{ now()->format('M j, Y') }}</p>
            </div>
            <ul class="divide-y divide-[color:var(--border-subtle)]">
                @forelse($installationsToday as $inst)
                    <li class="px-5 py-3.5 flex items-center justify-between gap-3">
                        <div class="min-w-0">
                            <p class="text-sm font-medium t-primary truncate">{{ $inst->customer?->name ?? '—' }}</p>
                            <p class="text-xs t-muted mt-0.5 tabular-nums">{{ $inst->scheduled_date ? $inst->scheduled_date->format('l, M j') : '—' }}</p>
                        </div>
                        <span class="text-[10px] font-medium px-2 py-0.5 rounded-md bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/20 shrink-0">Scheduled</span>
                    </li>
                @empty
                    <li class="px-5 py-10 text-center text-sm t-faint">No installations today.</li>
                @endforelse
            </ul>
        </div>
        <div class="glass rounded-2xl border border-theme">
            <div class="px-5 py-4 border-b border-subtle">
                <h3 class="text-sm font-semibold t-primary">Upcoming Installations</h3>
                <p class="text-[11px] t-muted mt-0.5">Next scheduled site visits</p>
            </div>
            <ul class="divide-y divide-[color:var(--border-subtle)]">
                @forelse($upcomingInstallations as $inst)
                    <li class="px-5 py-3.5 flex items-center justify-between gap-3">
                        <p class="text-sm font-medium t-primary truncate min-w-0">{{ $inst->customer?->name ?? '—' }}</p>
                        <span class="text-xs t-secondary tabular-nums shrink-0">{{ $inst->scheduled_date ? $inst->scheduled_date->format('M j, Y') : '—' }}</span>
                    </li>
                @empty
                    <li class="px-5 py-10 text-center text-sm t-faint">No upcoming installations.</li>
                @endforelse
            </ul>
        </div>
    </div>

    {{-- 6. EMI collection --}}
    <section class="animate-fade-in delay-5">
        <h2 class="text-base font-semibold t-primary mb-4">EMI Collection</h2>
        <div class="glass rounded-2xl border border-theme overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm min-w-[640px]">
                    <thead>
                        <tr class="border-b border-subtle bg-input/50">
                            <th class="px-4 py-3 text-left text-[10px] font-semibold t-faint uppercase tracking-widest">Customer</th>
                            <th class="px-4 py-3 text-left text-[10px] font-semibold t-faint uppercase tracking-widest">Bank</th>
                            <th class="px-4 py-3 text-right text-[10px] font-semibold t-faint uppercase tracking-widest">EMI</th>
                            <th class="px-4 py-3 text-right text-[10px] font-semibold t-faint uppercase tracking-widest">Pending</th>
                            <th class="px-4 py-3 text-right text-[10px] font-semibold t-faint uppercase tracking-widest">Total due</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[color:var(--border-subtle)]">
                        @forelse($overdueLoans as $loan)
                            @php
                                $emi = (float) $loan->emi_amount;
                                $pending = (int) $loan->emis_pending;
                                $totalDue = $emi * $pending;
                            @endphp
                            <tr class="hover:bg-[var(--bg-card-hover)] transition-colors">
                                <td class="px-4 py-3.5 t-secondary font-medium">{{ $loan->customer?->name ?? '—' }}</td>
                                <td class="px-4 py-3.5 t-muted">{{ $loan->bank_name ?? '—' }}</td>
                                <td class="px-4 py-3.5 text-right tabular-nums t-secondary">₹{{ number_format($emi, 0) }}</td>
                                <td class="px-4 py-3.5 text-right tabular-nums text-amber-600 dark:text-amber-400 font-medium">{{ $pending }}</td>
                                <td class="px-4 py-3.5 text-right tabular-nums font-semibold text-red-600 dark:text-red-400">₹{{ number_format($totalDue, 0) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-5 py-12 text-center t-faint text-sm">No overdue EMIs.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    {{-- 7. Attendance history --}}
    <section class="animate-fade-in delay-6">
        <h2 class="text-base font-semibold t-primary mb-4">Attendance History</h2>
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 mb-6">
            <div class="stat-card">
                <span class="text-[10px] font-medium text-emerald-600 dark:text-emerald-400 uppercase tracking-wider">Present</span>
                <div class="text-2xl font-bold t-primary mt-2 tabular-nums" data-count="{{ $attendanceStats['present'] ?? 0 }}">0</div>
            </div>
            <div class="stat-card">
                <span class="text-[10px] font-medium text-red-600 dark:text-red-400 uppercase tracking-wider">Absent</span>
                <div class="text-2xl font-bold t-primary mt-2 tabular-nums" data-count="{{ $attendanceStats['absent'] ?? 0 }}">0</div>
            </div>
            <div class="stat-card">
                <span class="text-[10px] font-medium text-amber-600 dark:text-amber-400 uppercase tracking-wider">Half Day</span>
                <div class="text-2xl font-bold t-primary mt-2 tabular-nums" data-count="{{ $attendanceStats['half_day'] ?? 0 }}">0</div>
            </div>
            <div class="stat-card">
                <span class="text-[10px] font-medium text-indigo-600 dark:text-indigo-400 uppercase tracking-wider">Leave</span>
                <div class="text-2xl font-bold t-primary mt-2 tabular-nums" data-count="{{ $attendanceStats['leave'] ?? 0 }}">0</div>
            </div>
        </div>
        <div class="glass rounded-2xl border border-theme overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-subtle">
                            <th class="px-5 py-3 text-left text-[10px] font-semibold t-faint uppercase tracking-widest">Date</th>
                            <th class="px-4 py-3 text-left text-[10px] font-semibold t-faint uppercase tracking-widest">Status</th>
                            <th class="px-4 py-3 text-left text-[10px] font-semibold t-faint uppercase tracking-widest">Check In</th>
                            <th class="px-4 py-3 text-left text-[10px] font-semibold t-faint uppercase tracking-widest">Check Out</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[color:var(--border-subtle)]">
                        @forelse($attendance as $row)
                            @php
                                $stColor = match($row->status) {
                                    'present' => 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400',
                                    'absent' => 'bg-red-500/10 text-red-600 dark:text-red-400',
                                    'half_day' => 'bg-amber-500/10 text-amber-600 dark:text-amber-400',
                                    'leave' => 'bg-indigo-500/10 text-indigo-600 dark:text-indigo-400',
                                    default => 'bg-white/5 t-muted',
                                };
                                $in = $row->check_in ? \Illuminate\Support\Carbon::parse($row->check_in)->format('g:i A') : '—';
                                $out = $row->check_out ? \Illuminate\Support\Carbon::parse($row->check_out)->format('g:i A') : '—';
                            @endphp
                            <tr class="hover:bg-[var(--bg-card-hover)] transition-colors">
                                <td class="px-5 py-3 text-sm t-secondary font-medium">{{ $row->date->format('M j, Y') }}</td>
                                <td class="px-4 py-3">
                                    <span class="text-[11px] px-2 py-0.5 rounded-md font-medium {{ $stColor }}">{{ ucwords(str_replace('_', ' ', $row->status)) }}</span>
                                </td>
                                <td class="px-4 py-3 text-sm t-muted tabular-nums">{{ $in }}</td>
                                <td class="px-4 py-3 text-sm t-muted tabular-nums">{{ $out }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="px-5 py-12 text-center t-faint text-sm">No attendance records yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
@endsection
