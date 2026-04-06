<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::latest()->paginate(15);
        return view('admin.packages.index', compact('packages'));
    }

    public function create()
    {
        return view('admin.packages.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'system_size_kw' => 'required|numeric|min:0.1',
            'price' => 'required|numeric|min:0',
            'estimated_generation' => 'nullable|string',
            'warranty_details' => 'nullable|string',
            'description' => 'nullable|string',
            'type' => 'required|in:domestic,commercial',
        ]);

        Package::create($validated);
        return redirect()->route('admin.packages.index')->with('success', 'Package created.');
    }

    public function edit(Package $package)
    {
        return view('admin.packages.edit', compact('package'));
    }

    public function update(Request $request, Package $package)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'system_size_kw' => 'required|numeric|min:0.1',
            'price' => 'required|numeric|min:0',
            'estimated_generation' => 'nullable|string',
            'warranty_details' => 'nullable|string',
            'description' => 'nullable|string',
            'type' => 'required|in:domestic,commercial',
        ]);

        $package->update($validated);
        return redirect()->route('admin.packages.index')->with('success', 'Package updated.');
    }

    public function toggleActive(Package $package)
    {
        $package->update(['is_active' => !$package->is_active]);
        return back()->with('success', 'Package status updated.');
    }
}
