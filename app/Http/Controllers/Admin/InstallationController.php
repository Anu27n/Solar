<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Installation;
use Illuminate\Http\Request;

class InstallationController extends Controller
{
    public function store(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'scheduled_date' => 'required|date',
            'assigned_team' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $validated['customer_id'] = $customer->id;
        $validated['status'] = 'installation_scheduled';

        Installation::updateOrCreate(
            ['customer_id' => $customer->id],
            $validated
        );

        $customer->update(['status' => 'installation_scheduled']);

        return back()->with('success', 'Installation scheduled.');
    }

    public function update(Request $request, Installation $installation)
    {
        $validated = $request->validate([
            'status' => 'required|in:installation_scheduled,installation_completed,installation_rejected',
            'scheduled_date' => 'nullable|date',
            'completed_date' => 'nullable|date',
            'assigned_team' => 'nullable|string|max:255',
            'rejection_reason' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        if ($validated['status'] === 'installation_completed') {
            $validated['completed_date'] = $validated['completed_date'] ?? now()->toDateString();
            $validated['approved_by'] = auth()->id();
        }

        $installation->update($validated);
        $installation->customer->update(['status' => $validated['status']]);

        return back()->with('success', 'Installation updated.');
    }
}
