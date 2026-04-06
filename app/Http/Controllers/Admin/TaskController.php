<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::with(['assignee', 'customer', 'creator']);

        if ($request->filled('assigned_to')) $query->where('assigned_to', $request->assigned_to);
        if ($request->filled('status')) $query->where('status', $request->status);
        if ($request->filled('type')) $query->where('type', $request->type);
        if ($request->filled('priority')) $query->where('priority', $request->priority);

        $tasks = $query->latest()->paginate(20)->withQueryString();
        $employees = User::where('role', 'employee')->orderBy('name')->get();

        return view('admin.tasks.index', compact('tasks', 'employees'));
    }

    public function create()
    {
        $employees = User::where('role', 'employee')->orderBy('name')->get();
        $customers = Customer::orderBy('name')->get();
        return view('admin.tasks.create', compact('employees', 'customers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'assigned_to' => 'required|exists:users,id',
            'customer_id' => 'nullable|exists:customers,id',
            'type' => 'required|in:kyc,installation,loan,visit,emi_collection,other',
            'priority' => 'required|in:low,medium,high,urgent',
            'due_date' => 'nullable|date',
            'description' => 'nullable|string',
        ]);

        $validated['created_by'] = auth()->id();
        $validated['status'] = 'pending';
        Task::create($validated);

        return redirect()->route('admin.tasks.index')->with('success', 'Task assigned.');
    }

    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,in_progress,completed,cancelled',
            'remarks' => 'nullable|string',
        ]);

        $task->update($validated);
        return back()->with('success', 'Task updated.');
    }
}
