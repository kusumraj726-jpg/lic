<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Log;

class BillingController extends Controller
{
    public function index()
    {
        // If they already have an active subscription, no need to pay again, just allow them to dashboard
        if (auth()->user()->hasActiveSubscription()) {
            return redirect()->route('dashboard');
        }

        return view('billing.paywall');
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'plan' => 'required|in:monthly,yearly',
        ]);

        $amount = $request->plan === 'yearly' ? 9990 : 999;
        
        // For security, amount is sent in paise (multiply by 100)
        $amountInPaise = $amount * 100;

        try {
            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
            
            $orderData = [
                'receipt'         => 'rcptid_' . auth()->id() . '_' . time(),
                'amount'          => $amountInPaise,
                'currency'        => 'INR',
                'payment_capture' => 1 // Auto capture
            ];

            $razorpayOrder = $api->order->create($orderData);
            
            return response()->json([
                'success' => true,
                'order_id' => $razorpayOrder['id'],
                'amount' => $amountInPaise,
                'key' => env('RAZORPAY_KEY'),
                'plan' => $request->plan
            ]);

        } catch (\Exception $e) {
            Log::error('Razorpay Order Creation Failed: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error generating payment gateway.'], 500);
        }
    }

    public function verify(Request $request)
    {
        $request->validate([
            'razorpay_payment_id' => 'required|string',
            'razorpay_order_id' => 'required|string',
            'razorpay_signature' => 'required|string',
            'plan' => 'required|in:monthly,yearly',
        ]);

        try {
            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
            $attributes = array(
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature
            );

            // This will throw a SignatureVerificationError if signature is invalid
            $api->utility->verifyPaymentSignature($attributes);

            $user = auth()->user();
            
            // Success! Upgrade their subscription
            $daysToAdd = $request->plan === 'yearly' ? 365 : 30;
            
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
            Log::error('Razorpay Verification Failed: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Payment verification failed.'], 400);
        }
    }
}
