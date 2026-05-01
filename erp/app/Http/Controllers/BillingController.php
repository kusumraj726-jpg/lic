<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Log;
use App\Models\Payment;

class BillingController extends Controller
{
    // -------------------------------------------------------
    // AUTH FLOW: Renewal for existing logged-in users (Part of ERP)
    // -------------------------------------------------------

    public function index()
    {
        if (auth()->user()->hasActiveSubscription()) {
            return redirect()->route('dashboard');
        }
        return view('billing.paywall');
    }

    public function checkout(Request $request)
    {
        $request->validate(['plan' => 'required|in:monthly,yearly']);

        $amount = $request->plan === 'yearly' ? 14999 : 1999;
        $amountInPaise = $amount * 100;

        try {
            $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
            $razorpayOrder = $api->order->create([
                'receipt'         => 'rcpt_' . auth()->id() . '_' . time(),
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
            Log::error('Razorpay Order Error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error generating payment: ' . $e->getMessage()], 500);
        }
    }

    public function verify(Request $request)
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

            $user = auth()->user();
            $amounts = ['trial' => 1, 'monthly' => 1999, 'yearly' => 14999];
            $amount = $amounts[$request->plan] ?? 0;

            // Log the payment
            Payment::create([
                'user_id'             => $user->id,
                'razorpay_order_id'   => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'amount'              => $amount,
                'plan'                => $request->plan,
                'status'              => 'success',
            ]);

            $daysToAdd = match($request->plan) {
                'trial'   => 30,
                'yearly'  => 365,
                default   => 30,
            };

            if ($user->subscription_ends_at && $user->subscription_ends_at->isFuture()) {
                $user->subscription_ends_at = $user->subscription_ends_at->addDays($daysToAdd);
            } else {
                $user->subscription_ends_at = now()->addDays($daysToAdd);
            }

            $user->subscription_status = 'active';
            $user->subscription_plan = $request->plan;
            $user->save();

            return response()->json(['success' => true]);

        } catch (\Exception $e) {
            Log::error('Razorpay Verify Error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Payment verification failed.'], 400);
        }
    }
}
