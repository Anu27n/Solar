<?php

namespace App\Http\Controllers;

use App\Models\CatalogItem;
use App\Models\CompanyProfile;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $companies = CompanyProfile::where('is_active', true)->orderBy('name')->get();

        $query = CatalogItem::with('company')
            ->where('is_published', true)
            ->whereHas('company', fn ($q) => $q->where('is_active', true));

        if ($request->filled('company') && $request->company !== 'all') {
            $query->whereHas('company', fn ($q) => $q->where('code', $request->company));
        }

        $items = $query
            ->orderBy('company_profile_id')
            ->orderBy('position')
            ->orderBy('name')
            ->paginate(24)
            ->withQueryString();

        return view('catalog.index', compact('items', 'companies'));
    }
}
