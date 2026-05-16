<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CatalogItem;
use App\Models\CompanyProfile;
use Illuminate\Http\Request;

class CatalogItemController extends Controller
{
    public function index(Request $request)
    {
        $query = CatalogItem::with('company')->orderBy('company_profile_id')->orderBy('position')->orderBy('name');

        if ($request->filled('company')) {
            $query->whereHas('company', fn ($q) => $q->where('code', $request->company));
        }

        if ($request->boolean('low_stock')) {
            $query->where('stock_quantity', '<', 10);
        }

        $items = $query->paginate(30)->withQueryString();
        $companies = CompanyProfile::where('is_active', true)->orderBy('name')->get();

        return view('admin.catalog_items.index', compact('items', 'companies'));
    }

    public function create()
    {
        $companies = CompanyProfile::where('is_active', true)->orderBy('name')->get();

        return view('admin.catalog_items.create', compact('companies'));
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        CatalogItem::create($data);

        return redirect()->route('admin.catalog-items.index')->with('success', 'Catalog item added.');
    }

    public function edit(CatalogItem $catalog_item)
    {
        $companies = CompanyProfile::where('is_active', true)->orderBy('name')->get();

        return view('admin.catalog_items.edit', ['item' => $catalog_item, 'companies' => $companies]);
    }

    public function update(Request $request, CatalogItem $catalog_item)
    {
        $catalog_item->update($this->validated($request));

        return redirect()->route('admin.catalog-items.index')->with('success', 'Item updated.');
    }

    public function destroy(CatalogItem $catalog_item)
    {
        $catalog_item->delete();

        return redirect()->route('admin.catalog-items.index')->with('success', 'Item removed.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validated(Request $request): array
    {
        $validated = $request->validate([
            'company_profile_id' => ['required', 'exists:company_profiles,id'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'sku' => ['nullable', 'string', 'max:100'],
            'unit' => ['required', 'string', 'max:32'],
            'list_price' => ['nullable', 'numeric', 'min:0'],
            'stock_quantity' => ['required', 'integer', 'min:0'],
            'is_published' => ['nullable', 'boolean'],
            'position' => ['nullable', 'integer', 'min:0'],
        ]);

        $validated['is_published'] = $request->boolean('is_published');
        $validated['position'] = (int) ($validated['position'] ?? 0);

        return $validated;
    }
}
