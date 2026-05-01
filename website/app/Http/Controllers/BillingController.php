<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Log;
use App\Models\Payment;

class BillingController extends Controller
{
    // -------------------------------------------------------
    // GUEST FLOW: Payment before registration (Part of Website)
    // -------------------------------------------------------

    /**
     * Show the public pricing/get-started page (no login required)
     */
    public function guestIndex()
    {
        if (session('nexorabyte_payment_done')) {
            return redirect()->route('register')->with('status', 'Payment verified! Please create your account below.');
        }

        return view('auth.service-selection');
    }

    public function guestCheckout(Request $request)
    {
        $request->validate(['plan' => 'required|in:monthly,yearly,trial']);

        $amounts = ['trial' => 1, 'monthly' => 1999, 'yearly' => 14999];
        $amount = $amounts[$request->plan];
        $amountInPaise = $amount * 100;

        try {
            $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

            $razorpayOrder = $api->order->create([
                'receipt'         => 'gs_' . substr(session()->getId(), 0, 8) . '_' . time(),
                'amount'          => $amountInPaise,
                'currency'        => 'INR',
                'payment_capture' => 1,
            ]);

            return response()->json([
                'success'  => true,
                'order_id' => $razorpayOrder['id'],
                'amount'   => $amountInPaise,
                'key'      => config('services.razorpay.key'),
                'plan'     => $request->plan,
            ]);
        } catch (\Exception $e) {
            Log::error('GuestCheckout Razorpay Error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error generating payment: ' . $e->getMessage()], 500);
        }
    }

    public function guestVerify(Request $request)
    {
        $request->validate([
            'razorpay_payment_id' => 'required|string',
            'razorpay_order_id'   => 'required|string',
            'razorpay_signature'  => 'required|string',
            'plan'                => 'required|in:monthly,yearly,trial',
        ]);

        try {
            $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
            $api->utility->verifyPaymentSignature([
                'razorpay_order_id'   => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature'  => $request->razorpay_signature,
            ]);

            $amounts = ['trial' => 1, 'monthly' => 1999, 'yearly' => 14999];
            $amount = $amounts[$request->plan] ?? 0;

            // Log the payment
            Payment::create([
                'razorpay_order_id'   => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'amount'              => $amount,
                'plan'                => $request->plan,
                'status'              => 'success',
            ]);

            session([
                'nexorabyte_payment_done'       => true,
                'nexorabyte_payment_plan'       => $request->plan,
                'nexorabyte_payment_id'         => $request->razorpay_payment_id,
                'nexorabyte_payment_order_id'   => $request->razorpay_order_id,
            ]);

            return response()->json(['success' => true]);

        } catch (\Exception $e) {
            Log::error('GuestVerify Razorpay Error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Payment verification failed.'], 400);
        }
    }
}
