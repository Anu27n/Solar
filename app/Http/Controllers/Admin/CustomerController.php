<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerKyc;
use App\Models\Installation;
use App\Models\Loan;
use App\Models\Subsidy;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = Customer::with(['channelPartner', 'installation', 'loan', 'subsidy']);

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(fn($q) => $q->where('name', 'like', "%$s%")->orWhere('phone', 'like', "%$s%")->orWhere('email', 'like', "%$s%"));
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('type')) {
            $query->where('installation_type', $request->type);
        }

        $customers = $query->latest()->paginate(15);
        return view('admin.customers.index', compact('customers'));
    }

    public function show(Customer $customer)
    {
        $customer->load(['channelPartner', 'kycDocuments', 'loan', 'installation', 'subsidy', 'payments', 'quotations']);
        return view('admin.customers.show', compact('customer'));
    }

    public function approveKyc(CustomerKyc $kyc)
    {
        $kyc->update([
            'status' => 'approved',
            'reviewed_by' => auth()->id(),
            'reviewed_at' => now(),
        ]);

        $allApproved = $kyc->customer->kycDocuments()->where('status', '!=', 'approved')->doesntExist();
        if ($allApproved) {
            $kyc->customer->update(['status' => 'kyc_approved']);
        }

        return back()->with('success', 'KYC document approved.');
    }

    public function rejectKyc(Request $request, CustomerKyc $kyc)
    {
        $request->validate(['rejection_reason' => 'required|string']);

        $kyc->update([
            'status' => 'rejected',
            'rejection_reason' => $request->rejection_reason,
            'reviewed_by' => auth()->id(),
            'reviewed_at' => now(),
        ]);

        $kyc->customer->update(['status' => 'kyc_rejected']);
        return back()->with('success', 'KYC document rejected.');
    }

    public function approveInstallation(Installation $installation)
    {
        $installation->update([
            'status' => 'installation_completed',
            'completed_date' => now(),
            'approved_by' => auth()->id(),
        ]);

        $installation->customer->update(['status' => 'installation_completed']);
        return back()->with('success', 'Installation approved.');
    }

    public function rejectInstallation(Request $request, Installation $installation)
    {
        $request->validate(['rejection_reason' => 'required|string']);

        $installation->update([
            'status' => 'installation_rejected',
            'rejection_reason' => $request->rejection_reason,
            'approved_by' => auth()->id(),
        ]);

        $installation->customer->update(['status' => 'installation_rejected']);
        return back()->with('success', 'Installation rejected.');
    }

    public function approveLoan(Loan $loan)
    {
        $loan->update(['status' => 'approved']);
        $loan->customer->update(['status' => 'loan_approved']);
        return back()->with('success', 'Loan approved.');
    }

    public function rejectLoan(Request $request, Loan $loan)
    {
        $request->validate(['notes' => 'nullable|string']);
        $loan->update(['status' => 'rejected', 'notes' => $request->notes]);
        $loan->customer->update(['status' => 'loan_rejected']);
        return back()->with('success', 'Loan rejected.');
    }

    public function approveSubsidy(Subsidy $subsidy)
    {
        $subsidy->update(['status' => 'approved']);
        return back()->with('success', 'Subsidy approved.');
    }

    public function rejectSubsidy(Request $request, Subsidy $subsidy)
    {
        $request->validate(['notes' => 'nullable|string']);
        $subsidy->update(['status' => 'rejected', 'notes' => $request->notes]);
        return back()->with('success', 'Subsidy rejected.');
    }
}
