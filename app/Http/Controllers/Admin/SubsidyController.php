<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Subsidy;
use Illuminate\Http\Request;

class SubsidyController extends Controller
{
    public function store(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'subsidy_amount' => 'required|numeric|min:0',
            'application_number' => 'nullable|string|max:255',
            'status_check_link' => 'nullable|url|max:500',
            'status' => 'required|in:applied,approved,received,pending,rejected',
            'notes' => 'nullable|string',
        ]);

        $validated['customer_id'] = $customer->id;

        Subsidy::updateOrCreate(
            ['customer_id' => $customer->id],
            $validated
        );

        return back()->with('success', 'Subsidy record saved.');
    }

    public function update(Request $request, Subsidy $subsidy)
    {
        $validated = $request->validate([
            'subsidy_amount' => 'required|numeric|min:0',
            'application_number' => 'nullable|string|max:255',
            'status_check_link' => 'nullable|url|max:500',
            'status' => 'required|in:applied,approved,received,pending,rejected',
            'notes' => 'nullable|string',
        ]);

        $subsidy->update($validated);
        return back()->with('success', 'Subsidy updated.');
    }
}
