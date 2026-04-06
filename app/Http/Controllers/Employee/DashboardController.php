<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\EmployeeAttendance;
use App\Models\Installation;
use App\Models\Loan;
use App\Models\Task;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        // Task stats
        $myTasks = Task::where('assigned_to', $userId);
        $taskStats = [
            'total_today' => (clone $myTasks)->whereDate('due_date', today())->count(),
            'pending' => (clone $myTasks)->where('status', 'pending')->count(),
            'in_progress' => (clone $myTasks)->where('status', 'in_progress')->count(),
            'completed' => (clone $myTasks)->where('status', 'completed')->count(),
            'urgent' => (clone $myTasks)->where('priority', 'urgent')->whereIn('status', ['pending', 'in_progress'])->count(),
        ];

        // Today's tasks
        $todayTasks = Task::where('assigned_to', $userId)
            ->whereIn('status', ['pending', 'in_progress'])
            ->orderByRaw("CASE priority WHEN 'urgent' THEN 1 WHEN 'high' THEN 2 WHEN 'medium' THEN 3 WHEN 'low' THEN 4 ELSE 5 END")
            ->with('customer')
            ->take(15)
            ->get();

        // Work queues
        $kycPending = Customer::where('status', 'kyc_pending')->with('kycDocuments')->take(5)->get();
        $loanPending = Loan::whereIn('status', ['applied', 'under_review'])->with('customer')->take(5)->get();
        $installationsToday = Installation::where('status', 'installation_scheduled')
            ->whereDate('scheduled_date', today())
            ->with('customer')
            ->get();
        $upcomingInstallations = Installation::where('status', 'installation_scheduled')
            ->where('scheduled_date', '>', today())
            ->with('customer')
            ->orderBy('scheduled_date')
            ->take(5)
            ->get();

        // EMI due
        $overdueLoans = Loan::where('emis_pending', '>', 0)
            ->whereIn('status', ['approved', 'disbursed'])
            ->with('customer')
            ->take(10)
            ->get();

        // Attendance
        $attendance = EmployeeAttendance::where('user_id', $userId)->orderByDesc('date')->take(15)->get();
        $todayAttendance = EmployeeAttendance::where('user_id', $userId)->where('date', today())->first();

        $thisMonth = EmployeeAttendance::where('user_id', $userId)
            ->whereMonth('date', now()->month)->whereYear('date', now()->year)->get();
        $attendanceStats = [
            'present' => $thisMonth->where('status', 'present')->count(),
            'absent' => $thisMonth->where('status', 'absent')->count(),
            'half_day' => $thisMonth->where('status', 'half_day')->count(),
            'leave' => $thisMonth->where('status', 'leave')->count(),
        ];

        return view('employee.dashboard', compact(
            'taskStats', 'todayTasks', 'kycPending', 'loanPending',
            'installationsToday', 'upcomingInstallations', 'overdueLoans',
            'attendance', 'todayAttendance', 'attendanceStats'
        ));
    }

    public function updateTask(\Illuminate\Http\Request $request, Task $task)
    {
        abort_if($task->assigned_to !== auth()->id(), 403);

        $validated = $request->validate([
            'status' => 'required|in:pending,in_progress,completed',
            'remarks' => 'nullable|string',
        ]);

        $task->update($validated);
        return back()->with('success', 'Task updated.');
    }

    public function checkin()
    {
        EmployeeAttendance::updateOrCreate(
            ['user_id' => auth()->id(), 'date' => today()],
            ['status' => 'present', 'check_in' => now()->format('H:i:s')]
        );
        return back()->with('success', 'Checked in at ' . now()->format('h:i A'));
    }

    public function checkout()
    {
        $att = EmployeeAttendance::where('user_id', auth()->id())->where('date', today())->first();
        if ($att) {
            $att->update(['check_out' => now()->format('H:i:s')]);
        }
        return back()->with('success', 'Checked out at ' . now()->format('h:i A'));
    }
}
