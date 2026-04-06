@extends('layouts.dashboard')

@section('title', 'Employee Attendance')

@section('sidebar')
    @include('admin.partials.sidebar')
@endsection

@section('page-title', 'Employee Attendance')

@section('content')
    <form method="GET" action="{{ route('admin.attendance.index') }}" class="mb-6 flex flex-wrap items-end gap-4">
        <div>
            <label for="date-picker" class="block text-[10px] font-semibold t-muted uppercase tracking-widest mb-1.5">Date</label>
            <input type="date" name="date" id="date-picker" value="{{ $date }}"
                class="border border-theme bg-input t-primary rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-solar-500 focus:ring-2 focus:ring-solar-500/20"
                onchange="this.form.submit()">
        </div>
    </form>

    <form method="POST" action="{{ route('admin.attendance.store') }}" class="space-y-6">
        @csrf
        <input type="hidden" name="date" value="{{ $date }}">

        <div class="glass rounded-2xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="border-b border-subtle">
                            <th class="px-6 py-4 text-left text-[10px] font-semibold t-faint uppercase tracking-widest">Employee Name</th>
                            <th class="px-6 py-4 text-left text-[10px] font-semibold t-faint uppercase tracking-widest">Status</th>
                            <th class="px-6 py-4 text-left text-[10px] font-semibold t-faint uppercase tracking-widest">Check In</th>
                            <th class="px-6 py-4 text-left text-[10px] font-semibold t-faint uppercase tracking-widest">Check Out</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[var(--border-subtle)]">
                        @foreach($employees as $index => $employee)
                            @php
                                $rec = $attendance[$employee->id] ?? null;
                                $timeIn = $rec && $rec->check_in ? \Illuminate\Support\Carbon::parse($rec->check_in)->format('H:i') : '';
                                $timeOut = $rec && $rec->check_out ? \Illuminate\Support\Carbon::parse($rec->check_out)->format('H:i') : '';
                            @endphp
                            <tr class="hover:bg-[var(--bg-card-hover)] transition-colors">
                                <td class="px-6 py-4 font-medium t-primary">
                                    <input type="hidden" name="attendance[{{ $index }}][user_id]" value="{{ $employee->id }}">
                                    {{ $employee->name }}
                                </td>
                                <td class="px-6 py-4">
                                    <select name="attendance[{{ $index }}][status]"
                                        class="w-full min-w-[140px] rounded-xl border border-theme bg-input px-3 py-2 text-sm t-primary focus:outline-none focus:border-solar-500 focus:ring-2 focus:ring-solar-500/20">
                                        <option value="present" @selected(old('attendance.'.$index.'.status', $rec?->status ?? 'present') === 'present')>Present</option>
                                        <option value="absent" @selected(old('attendance.'.$index.'.status', $rec?->status) === 'absent')>Absent</option>
                                        <option value="half_day" @selected(old('attendance.'.$index.'.status', $rec?->status) === 'half_day')>Half day</option>
                                        <option value="leave" @selected(old('attendance.'.$index.'.status', $rec?->status) === 'leave')>Leave</option>
                                    </select>
                                </td>
                                <td class="px-6 py-4">
                                    <input type="time" name="attendance[{{ $index }}][check_in]"
                                        value="{{ old('attendance.'.$index.'.check_in', $timeIn) }}"
                                        class="w-full min-w-[120px] rounded-xl border border-theme bg-input px-3 py-2 text-sm t-primary focus:outline-none focus:border-solar-500 focus:ring-2 focus:ring-solar-500/20">
                                </td>
                                <td class="px-6 py-4">
                                    <input type="time" name="attendance[{{ $index }}][check_out]"
                                        value="{{ old('attendance.'.$index.'.check_out', $timeOut) }}"
                                        class="w-full min-w-[120px] rounded-xl border border-theme bg-input px-3 py-2 text-sm t-primary focus:outline-none focus:border-solar-500 focus:ring-2 focus:ring-solar-500/20">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @if($employees->isEmpty())
            <p class="text-sm t-faint">No employees found. Add users with the employee role first.</p>
        @else
            <button type="submit" class="inline-flex rounded-xl bg-solar-500 px-5 py-2.5 text-sm font-semibold text-dark-900 hover:bg-solar-400 transition">
                Save attendance
            </button>
        @endif
    </form>
@endsection
