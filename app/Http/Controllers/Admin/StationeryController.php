<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Support\DbOrder;
use App\Support\PdfImageDataUri;
use App\Support\StationeryBranding;
use App\Support\StationeryCardPdf;
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
            ->orderByRaw(DbOrder::case('role', ['admin', 'employee', 'channel_partner']))
            ->orderBy('name')
            ->get();

        return view('admin.stationery.index', compact('staff'));
    }

    public function idCard(User $user)
    {
        $this->authorizeCardUser($user);

        [$w, $h] = StationeryCardPdf::idCardPaper();

        return StationeryCardPdf::download(
            'stationery.pdf.id_card',
            $this->cardViewData($user),
            $w,
            $h,
            'id-card-'.Str::slug($user->name).'.pdf',
        );
    }

    public function visitingCard(User $user)
    {
        $this->authorizeCardUser($user);

        [$w, $h] = StationeryCardPdf::visitingCardPaper();

        return StationeryCardPdf::download(
            'stationery.pdf.visiting_card',
            $this->cardViewData($user),
            $w,
            $h,
            'visiting-card-'.Str::slug($user->name).'.pdf',
        );
    }

    /**
     * @return array<string, mixed>
     */
    private function cardViewData(User $user): array
    {
        return [
            'user' => $user,
            'companies' => StationeryBranding::companiesForPdf(),
            'groupTitle' => StationeryBranding::GROUP_TITLE,
            'office' => StationeryBranding::primaryOffice(),
            'services' => StationeryBranding::backServices(),
            'photoDataUri' => PdfImageDataUri::fromPublicPath($user->avatar_path),
        ];
    }

    private function authorizeCardUser(User $user): void
    {
        if (! in_array($user->role, self::STAFF_ROLES, true)) {
            abort(403, 'Cards are only available for admin, employee, and channel partner accounts.');
        }
    }
}
