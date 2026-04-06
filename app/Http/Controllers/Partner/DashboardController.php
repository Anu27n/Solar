<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\Commission;
use App\Models\Customer;
use App\Models\Installation;
use App\Models\KycDocument;
use App\Models\Loan;
use App\Models\Subsidy;

class DashboardController extends Controller
{
    public function index()
    {
        $partnerId = auth()->id();
        $myCustomers = Customer::where('channel_partner_id', $partnerId);

        $stats = [
            'total_customers' => (clone $myCustomers)->count(),
            'cash_customers' => (clone $myCustomers)->where('payment_method', 'cash')->count(),
            'loan_customers' => (clone $myCustomers)->where('payment_method', 'loan')->count(),
            'domestic_customers' => (clone $myCustomers)->where('installation_type', 'domestic')->count(),
            'commercial_customers' => (clone $myCustomers)->where('installation_type', 'commercial')->count(),
            'installations_completed' => (clone $myCustomers)
                ->whereHas('installation', fn($q) => $q->where('status', 'installation_completed'))->count(),
            'installations_pending' => (clone $myCustomers)
                ->whereHas('installation', fn($q) => $q->whereNotIn('status', ['installation_completed', 'installation_rejected']))->count(),
            'installations_rejected' => (clone $myCustomers)
                ->whereHas('installation', fn($q) => $q->where('status', 'installation_rejected'))->count(),
            'subsidy_received' => (clone $myCustomers)
                ->whereHas('subsidy', fn($q) => $q->where('status', 'received'))->count(),
            'subsidy_pending' => (clone $myCustomers)
                ->whereHas('subsidy', fn($q) => $q->whereIn('status', ['pending', 'applied']))->count(),
            'total_commission_paid' => Commission::where('channel_partner_id', $partnerId)->where('status', 'paid')->sum('amount'),
            'total_commission_pending' => Commission::where('channel_partner_id', $partnerId)->where('status', 'pending')->sum('amount'),
            'total_emi_paid' => Loan::whereHas('customer', fn($q) => $q->where('channel_partner_id', $partnerId))->sum('emis_paid'),
            'total_emi_pending' => Loan::whereHas('customer', fn($q) => $q->where('channel_partner_id', $partnerId))->sum('emis_pending'),
            'kyc_pending' => (clone $myCustomers)->where('status', 'kyc_pending')->count(),
        ];

        $recentCustomers = Customer::where('channel_partner_id', $partnerId)
            ->with(['installation', 'loan', 'subsidy'])->latest()->take(10)->get();

        $commissions = Commission::where('channel_partner_id', $partnerId)
            ->with('customer')->latest()->take(10)->get();

        // Loan tracking
        $loanCustomers = Customer::where('channel_partner_id', $partnerId)
            ->whereHas('loan')
            ->with('loan')
            ->latest()
            ->take(5)
            ->get();

        // Installation pipeline
        $installationPipeline = Customer::where('channel_partner_id', $partnerId)
            ->whereHas('installation')
            ->with('installation')
            ->latest()
            ->take(5)
            ->get();

        // Subsidy tracking
        $subsidyCustomers = Customer::where('channel_partner_id', $partnerId)
            ->whereHas('subsidy')
            ->with('subsidy')
            ->latest()
            ->take(5)
            ->get();

        // Commission summary (monthly/yearly)
        $monthlyCommission = Commission::where('channel_partner_id', $partnerId)
            ->where('status', 'paid')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('amount');

        $yearlyCommission = Commission::where('channel_partner_id', $partnerId)
            ->where('status', 'paid')
            ->whereYear('created_at', now()->year)
            ->sum('amount');

        return view('partner.dashboard', compact(
            'stats', 'recentCustomers', 'commissions', 'loanCustomers',
            'installationPipeline', 'subsidyCustomers', 'monthlyCommission', 'yearlyCommission'
        ));
    }
}
