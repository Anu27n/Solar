<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;

class DashboardController extends Controller
{
    public function index()
    {
        $customer = Customer::where('user_id', auth()->id())
            ->with(['installation', 'subsidy', 'kycDocuments', 'loan', 'payments'])
            ->first();

        return view('customer.dashboard', compact('customer'));
    }
}
