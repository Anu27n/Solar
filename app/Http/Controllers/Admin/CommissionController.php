<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Commission;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;

class CommissionController extends Controller
{
    public function index(Request $request)
    {
        $query = Commission::with(['channelPartner', 'customer']);

        if ($request->filled('partner_id')) {
            $query->where('channel_partner_id', $request->partner_id);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('month')) {
            $query->whereMonth('created_at', date('m', strtotime($request->month)))
                  ->whereYear('created_at', date('Y', strtotime($request->month)));
        }

        $commissions = $query->latest()->paginate(20)->withQueryString();
        $partners = User::where('role', 'channel_partner')->orderBy('name')->get();

        $totals = [
            'total' => Commission::sum('amount'),
            'paid' => Commission::where('status', 'paid')->sum('amount'),
            'pending' => Commission::where('status', 'pending')->sum('amount'),
            'approved' => Commission::where('status', 'approved')->sum('amount'),
        ];

        return view('admin.commissions.index', compact('commissions', 'partners', 'totals'));
    }

    public function create()
    {
        $partners = User::where('role', 'channel_partner')->orderBy('name')->get();
        $customers = Customer::orderBy('name')->get();
        return view('admin.commissions.create', compact('partners', 'customers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'channel_partner_id' => 'required|exists:users,id',
            'customer_id' => 'required|exists:customers,id',
            'amount' => 'required|numeric|min:0',
            'type' => 'required|in:per_installation,monthly,yearly,bonus',
            'status' => 'required|in:pending,approved,paid',
            'period_month' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);

        Commission::create($validated);
        return redirect()->route('admin.commissions.index')->with('success', 'Commission created.');
    }

    public function update(Request $request, Commission $commission)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:pending,approved,paid',
            'notes' => 'nullable|string',
        ]);

        $commission->update($validated);
        return back()->with('success', 'Commission updated.');
    }

    public function markPaid(Commission $commission)
    {
        $commission->update(['status' => 'paid']);
        return back()->with('success', 'Commission marked as paid.');
    }
}
