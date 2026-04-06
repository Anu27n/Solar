<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Commission;
use App\Models\Customer;
use App\Models\Installation;
use App\Models\Loan;
use App\Models\Payment;
use App\Models\SiteSetting;
use App\Models\Subsidy;
use App\Models\Task;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_customers' => Customer::count(),
            'domestic_customers' => Customer::where('installation_type', 'domestic')->count(),
            'commercial_customers' => Customer::where('installation_type', 'commercial')->count(),
            'cash_customers' => Customer::where('payment_method', 'cash')->count(),
            'loan_customers' => Customer::where('payment_method', 'loan')->count(),
            'installations_completed' => Installation::where('status', 'installation_completed')->count(),
            'installations_pending' => Installation::whereNotIn('status', ['installation_completed', 'installation_rejected'])->count(),
            'installations_rejected' => Installation::where('status', 'installation_rejected')->count(),
            'total_loan_cases' => Loan::count(),
            'emi_pending' => Loan::sum('emis_pending'),
            'subsidy_received' => Subsidy::where('status', 'received')->count(),
            'subsidy_pending' => Subsidy::where('status', 'pending')->count(),
            'subsidy_applied' => Subsidy::where('status', 'applied')->count(),
            'subsidy_approved' => Subsidy::where('status', 'approved')->count(),
            'total_channel_partners' => User::where('role', 'channel_partner')->count(),
            'total_employees' => User::where('role', 'employee')->count(),
            'total_revenue' => Payment::where('status', 'completed')->sum('amount'),
            'total_commissions_paid' => Commission::where('status', 'paid')->sum('amount'),
            'total_commissions_pending' => Commission::where('status', 'pending')->sum('amount'),
            'pending_tasks' => Task::whereIn('status', ['pending', 'in_progress'])->count(),
            'kyc_pending_count' => Customer::where('status', 'kyc_pending')->count(),
        ];

        $commissionRule = [
            'type' => SiteSetting::get('commission_type', 'percentage'),
            'value' => SiteSetting::get('commission_value', '5'),
        ];

        $pendingKyc = Customer::where('status', 'kyc_pending')->latest()->take(5)->get();
        $pendingInstallations = Installation::whereNotIn('status', ['installation_completed', 'installation_rejected'])
            ->with('customer')->latest()->take(5)->get();
        $pendingLoans = Loan::whereIn('status', ['applied', 'under_review'])->with('customer')->latest()->take(5)->get();
        $recentCustomers = Customer::with('channelPartner')->latest()->take(10)->get();
        $recentPayments = Payment::with('customer')->latest()->take(5)->get();

        // Notifications
        $notifications = [];

        $kycPendingCustomers = Customer::where('status', 'kyc_pending')->get();
        foreach ($kycPendingCustomers as $cust) {
            $notifications[] = [
                'type' => 'warning', 'icon' => 'kyc',
                'title' => 'KYC Pending: ' . $cust->name,
                'detail' => 'Waiting for document approval',
                'link' => route('admin.customers.show', $cust->id),
            ];
        }

        $pendingEmiLoans = Loan::where('emis_pending', '>', 0)->whereIn('status', ['approved', 'disbursed'])->with('customer')->get();
        foreach ($pendingEmiLoans as $loan) {
            $notifications[] = [
                'type' => 'warning', 'icon' => 'emi',
                'title' => 'EMI Pending: ' . ($loan->customer->name ?? 'Unknown'),
                'detail' => $loan->emis_pending . ' EMIs pending (₹' . number_format($loan->emi_amount * $loan->emis_pending) . ')',
                'link' => route('admin.customers.show', $loan->customer_id),
            ];
        }

        $pendingInstalls = Installation::where('status', 'installation_scheduled')->with('customer')->get();
        foreach ($pendingInstalls as $inst) {
            $notifications[] = [
                'type' => 'info', 'icon' => 'install',
                'title' => 'Installation Scheduled: ' . ($inst->customer->name ?? 'Unknown'),
                'detail' => 'Scheduled for ' . ($inst->scheduled_date ? $inst->scheduled_date->format('d M Y') : 'TBD'),
                'link' => route('admin.customers.show', $inst->customer_id),
            ];
        }

        $loanApprovals = Loan::whereIn('status', ['applied', 'under_review'])->with('customer')->get();
        foreach ($loanApprovals as $loan) {
            $notifications[] = [
                'type' => 'alert', 'icon' => 'loan',
                'title' => 'Loan Review: ' . ($loan->customer->name ?? 'Unknown'),
                'detail' => '₹' . number_format($loan->loan_amount) . ' from ' . $loan->bank_name,
                'link' => route('admin.customers.show', $loan->customer_id),
            ];
        }

        $subsidyPending = Subsidy::whereIn('status', ['applied', 'pending'])->with('customer')->get();
        foreach ($subsidyPending as $sub) {
            $notifications[] = [
                'type' => 'info', 'icon' => 'subsidy',
                'title' => 'Subsidy Pending: ' . ($sub->customer->name ?? 'Unknown'),
                'detail' => '₹' . number_format($sub->subsidy_amount ?? 0) . ' — ' . ucfirst($sub->status),
                'link' => route('admin.customers.show', $sub->customer_id),
            ];
        }

        return view('admin.dashboard', compact(
            'stats', 'commissionRule', 'pendingKyc', 'pendingInstallations',
            'pendingLoans', 'recentCustomers', 'recentPayments', 'notifications'
        ));
    }
}
