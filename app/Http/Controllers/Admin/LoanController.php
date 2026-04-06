<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Loan;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function store(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'bank_name' => 'required|string|max:255',
            'down_payment' => 'required|numeric|min:0',
            'loan_amount' => 'required|numeric|min:1',
            'emi_amount' => 'required|numeric|min:0',
            'total_emis' => 'required|integer|min:1',
            'notes' => 'nullable|string',
        ]);

        $validated['customer_id'] = $customer->id;
        $validated['emis_pending'] = $validated['total_emis'];
        $validated['emis_paid'] = 0;
        $validated['status'] = 'applied';

        Loan::updateOrCreate(
            ['customer_id' => $customer->id],
            $validated
        );

        if ($customer->status === 'kyc_approved') {
            $customer->update(['status' => 'loan_applied']);
        }

        return back()->with('success', 'Loan record saved.');
    }

    public function update(Request $request, Loan $loan)
    {
        $validated = $request->validate([
            'bank_name' => 'required|string|max:255',
            'down_payment' => 'required|numeric|min:0',
            'loan_amount' => 'required|numeric|min:1',
            'emi_amount' => 'required|numeric|min:0',
            'total_emis' => 'required|integer|min:1',
            'emis_paid' => 'required|integer|min:0',
            'status' => 'required|in:applied,under_review,approved,rejected,disbursed',
            'notes' => 'nullable|string',
        ]);

        $validated['emis_pending'] = max(0, $validated['total_emis'] - $validated['emis_paid']);
        $loan->update($validated);

        if ($validated['status'] === 'approved' && $loan->customer->status === 'loan_applied') {
            $loan->customer->update(['status' => 'loan_approved']);
        }

        return back()->with('success', 'Loan updated.');
    }
}
