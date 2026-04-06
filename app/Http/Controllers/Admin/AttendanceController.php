<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmployeeAttendance;
use App\Models\User;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->input('date', now()->toDateString());
        $employees = User::where('role', 'employee')->get();
        $attendance = EmployeeAttendance::where('date', $date)->get()->keyBy('user_id');

        return view('admin.attendance.index', compact('employees', 'attendance', 'date'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'attendance' => 'required|array',
            'attendance.*.user_id' => 'required|exists:users,id',
            'attendance.*.status' => 'required|in:present,absent,half_day,leave',
        ]);

        foreach ($request->attendance as $record) {
            EmployeeAttendance::updateOrCreate(
                ['user_id' => $record['user_id'], 'date' => $request->date],
                [
                    'status' => $record['status'],
                    'check_in' => $record['check_in'] ?? null,
                    'check_out' => $record['check_out'] ?? null,
                ]
            );
        }

        return back()->with('success', 'Attendance saved.');
    }
}
