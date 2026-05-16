<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use App\Models\User;
use App\Support\PdfImageDataUri;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StationeryController extends Controller
{
    private const STAFF_ROLES = ['admin', 'employee', 'channel_partner'];

    public function index()
    {
        $staff = User::query()
            ->whereIn('role', self::STAFF_ROLES)
            ->where('is_active', true)
            ->orderByRaw("FIELD(role, 'admin', 'employee', 'channel_partner')")
            ->orderBy('name')
            ->get();

        $companies = CompanyProfile::where('is_active', true)->orderBy('name')->get();

        return view('admin.stationery.index', compact('staff', 'companies'));
    }

    public function idCard(Request $request, User $user)
    {
        $this->authorizeCardUser($user);

        $validated = $request->validate([
            'company_profile_id' => ['required', 'exists:company_profiles,id'],
        ]);

        $company = CompanyProfile::findOrFail($validated['company_profile_id']);

        $w = 85.6 * 72 / 25.4;
        $h = 53.98 * 72 / 25.4;

        $pdf = Pdf::loadView('stationery.pdf.id_card', [
            'user' => $user,
            'company' => $company,
            'photoDataUri' => PdfImageDataUri::fromPublicPath($user->avatar_path),
            'logoDataUri' => PdfImageDataUri::fromPublicPath($company->logo_path),
        ])->setPaper([0, 0, $w, $h]);

        $filename = 'id-card-'.Str::slug($user->name).'.pdf';

        return $pdf->download($filename);
    }

    public function visitingCard(Request $request, User $user)
    {
        $this->authorizeCardUser($user);

        $validated = $request->validate([
            'company_profile_id' => ['required', 'exists:company_profiles,id'],
        ]);

        $company = CompanyProfile::findOrFail($validated['company_profile_id']);

        // 89 × 51 mm (standard Indian business card) converted to points
        $w = 89 * 72 / 25.4;   // ≈ 252.28 pt
        $h = 51 * 72 / 25.4;   // ≈ 144.57 pt

        $pdf = Pdf::loadView('stationery.pdf.visiting_card', [
            'user' => $user,
            'company' => $company,
            'photoDataUri' => PdfImageDataUri::fromPublicPath($user->avatar_path),
            'logoDataUri' => PdfImageDataUri::fromPublicPath($company->logo_path),
        ])->setPaper([0, 0, $w, $h]);

        $filename = 'visiting-card-'.Str::slug($user->name).'.pdf';

        return $pdf->download($filename);
    }

    private function authorizeCardUser(User $user): void
    {
        if (! in_array($user->role, self::STAFF_ROLES, true)) {
            abort(403, 'Cards are only available for admin, employee, and channel partner accounts.');
        }
    }
}
