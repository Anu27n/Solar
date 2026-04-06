<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $query = Payment::with('customer');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('search')) {
            $s = $request->search;
            $query->whereHas('customer', fn($q) => $q->where('name', 'like', "%$s%")->orWhere('phone', 'like', "%$s%"));
        }

        $payments = $query->latest()->paginate(20)->withQueryString();

        $totals = [
            'total' => Payment::where('status', 'completed')->sum('amount'),
            'pending' => Payment::where('status', 'pending')->sum('amount'),
            'today' => Payment::where('status', 'completed')->whereDate('created_at', today())->sum('amount'),
        ];

        return view('admin.payments.index', compact('payments', 'totals'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'amount' => 'required|numeric|min:1',
            'method' => 'required|in:online,cash,cheque,bank_transfer',
            'transaction_id' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $validated['status'] = $request->input('method') === 'online' ? 'pending' : 'completed';
        $validated['created_by'] = auth()->id();

        Payment::create($validated);
        return back()->with('success', 'Payment recorded.');
    }
}
