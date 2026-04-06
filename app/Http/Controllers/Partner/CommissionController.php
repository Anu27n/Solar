<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\Commission;
use Illuminate\Http\Request;

class CommissionController extends Controller
{
    public function index(Request $request)
    {
        $partnerId = auth()->id();
        $query = Commission::where('channel_partner_id', $partnerId)->with('customer');

        if ($request->filled('type') && $request->type !== 'all') {
            $query->where('type', $request->type);
        }

        $commissions = $query->latest()->paginate(20)->withQueryString();

        $stats = [
            'total_earned' => Commission::where('channel_partner_id', $partnerId)->sum('amount'),
            'total_paid' => Commission::where('channel_partner_id', $partnerId)->where('status', 'paid')->sum('amount'),
            'total_pending' => Commission::where('channel_partner_id', $partnerId)->whereIn('status', ['pending', 'approved'])->sum('amount'),
            'this_month' => Commission::where('channel_partner_id', $partnerId)
                ->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->sum('amount'),
            'this_year' => Commission::where('channel_partner_id', $partnerId)
                ->whereYear('created_at', now()->year)->sum('amount'),
        ];

        return view('partner.commissions.index', compact('commissions', 'stats'));
    }
}
