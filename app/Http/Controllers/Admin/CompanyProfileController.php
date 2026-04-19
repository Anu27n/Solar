<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use Illuminate\Http\Request;

class CompanyProfileController extends Controller
{
    public function index()
    {
        $profiles = CompanyProfile::orderBy('name')->get();
        return view('admin.company_profiles.index', compact('profiles'));
    }

    public function edit(CompanyProfile $companyProfile)
    {
        return view('admin.company_profiles.edit', ['profile' => $companyProfile]);
    }

    public function update(Request $request, CompanyProfile $companyProfile)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'tagline' => 'nullable|string|max:500',
            'address_office' => 'required|string',
            'address_factory' => 'nullable|string',
            'city' => 'nullable|string|max:120',
            'state' => 'nullable|string|max:120',
            'pincode' => 'nullable|string|max:20',
            'gstin' => 'nullable|string|max:30',
            'phones' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|string|max:255',
            'bank_name' => 'nullable|string|max:255',
            'bank_branch' => 'nullable|string|max:255',
            'bank_ac_no' => 'nullable|string|max:50',
            'bank_ifsc' => 'nullable|string|max:20',
            'bank_pin' => 'nullable|string|max:20',
            'signatory_name' => 'nullable|string|max:120',
            'signatory_title' => 'nullable|string|max:150',
            'signatory_phone' => 'nullable|string|max:30',
            'ref_prefix' => 'required|string|max:20',
            'ref_year_mode' => 'required|in:calendar,fiscal',
            'next_quotation_seq' => 'required|integer|min:1',
            'default_gst_percent' => 'required|numeric|min:0|max:100',
            'default_validity_days' => 'required|integer|min:1|max:365',
            'default_payment_terms' => 'nullable|string',
            'default_delivery_terms' => 'nullable|string',
            'default_warranty_terms' => 'nullable|string',
            'default_freight' => 'nullable|string|max:100',
            'default_jurisdiction' => 'nullable|string|max:100',
            'default_cover_letter' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $data['phones'] = array_values(array_filter(array_map('trim', preg_split('/[\r\n,]+/', (string) $request->input('phones', '')))));
        $data['is_active'] = $request->boolean('is_active');

        $companyProfile->update($data);

        return redirect()->route('admin.company-profiles.index')
            ->with('success', $companyProfile->name . ' updated.');
    }
}
