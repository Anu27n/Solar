<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function create()
    {
        $customer = Customer::where('user_id', auth()->id())->first();

        if (!$customer) {
            return view('customer.payment', ['customer' => null, 'razorpayKey' => '', 'payments' => collect()]);
        }

        $razorpayKey = SiteSetting::get('razorpay_key_id', config('services.razorpay.key', ''));
        $payments = Payment::where('customer_id', $customer->id)->latest()->take(10)->get();

        return view('customer.payment', compact('customer', 'razorpayKey', 'payments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'razorpay_payment_id' => 'required|string',
            'razorpay_order_id' => 'nullable|string',
            'razorpay_signature' => 'nullable|string',
            'amount' => 'required|numeric|min:1',
        ]);

        $customer = Customer::where('user_id', auth()->id())->firstOrFail();

        $secret = SiteSetting::get('razorpay_key_secret', config('services.razorpay.secret'));
        $verified = true;

        if ($secret && $request->filled('razorpay_order_id') && $request->filled('razorpay_signature')) {
            $payload = $request->razorpay_order_id . '|' . $request->razorpay_payment_id;
            $expectedSignature = hash_hmac('sha256', $payload, $secret);
            $verified = hash_equals($expectedSignature, $request->razorpay_signature);
        }

        if (!$verified) {
            return back()->with('error', 'Payment verification failed. Please contact support.');
        }

        Payment::create([
            'customer_id' => $customer->id,
            'amount' => $request->amount,
            'method' => 'online',
            'status' => 'completed',
            'transaction_id' => $request->razorpay_payment_id,
            'gateway_reference' => 'razorpay',
            'notes' => 'Online payment via Razorpay',
        ]);

        return redirect()->route('customer.dashboard')->with('success', 'Payment successful! ₹' . number_format($request->amount) . ' received.');
    }
}
