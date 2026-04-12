<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Log;

class BillingController extends Controller
{
    // -------------------------------------------------------
    // GUEST FLOW: Payment before registration
    // -------------------------------------------------------

    /**
     * Show the public pricing/get-started page (no login required)
     */
    public function guestIndex()
    {
        // If payment already done in this session, redirect to register
        if (session('velora_payment_done')) {
            return redirect()->route('register')->with('status', 'Payment verified! Please create your account below.');
        }

        return view('billing.get_started');
    }

    /**
     * Create a Razorpay order for a guest user
     */
    public function guestCheckout(Request $request)
    {
        $request->validate(['plan' => 'required|in:monthly,yearly,trial']);

        $amounts = ['trial' => 99, 'monthly' => 999, 'yearly' => 9990];
        $amount = $amounts[$request->plan];
        $amountInPaise = $amount * 100;

        try {
            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

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
                'key'      => env('RAZORPAY_KEY'),
                'plan'     => $request->plan,
            ]);
        } catch (\Exception $e) {
            Log::error('GuestCheckout Razorpay Error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error generating payment.'], 500);
        }
    }

    /**
     * Verify guest payment + store token in session, redirect to register
     */
    public function guestVerify(Request $request)
    {
        $request->validate([
            'razorpay_payment_id' => 'required|string',
            'razorpay_order_id'   => 'required|string',
            'razorpay_signature'  => 'required|string',
            'plan'                => 'required|in:monthly,yearly,trial',
        ]);

        try {
            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
            $api->utility->verifyPaymentSignature([
                'razorpay_order_id'   => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature'  => $request->razorpay_signature,
            ]);

            // Store payment info in session — one-time use for registration
            session([
                'velora_payment_done'       => true,
                'velora_payment_plan'       => $request->plan,
                'velora_payment_id'         => $request->razorpay_payment_id,
                'velora_payment_order_id'   => $request->razorpay_order_id,
            ]);

            return response()->json(['success' => true]);

        } catch (\Exception $e) {
            Log::error('GuestVerify Razorpay Error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Payment verification failed.'], 400);
        }
    }

    // -------------------------------------------------------
    // AUTH FLOW: Renewal for existing logged-in users
    // -------------------------------------------------------

    /**
     * Show renewal billing page for logged-in users
     */
    public function index()
    {
        if (auth()->user()->hasActiveSubscription()) {
            return redirect()->route('dashboard');
        }
        return view('billing.paywall');
    }

    /**
     * Create Razorpay order for logged-in user renewal
     */
    public function checkout(Request $request)
    {
        $request->validate(['plan' => 'required|in:monthly,yearly']);

        $amount = $request->plan === 'yearly' ? 9990 : 999;
        $amountInPaise = $amount * 100;

        try {
            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
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
                'key'      => env('RAZORPAY_KEY'),
                'plan'     => $request->plan,
            ]);
        } catch (\Exception $e) {
            Log::error('Razorpay Order Error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error generating payment.'], 500);
        }
    }

    /**
     * Verify renewal payment and activate subscription
     */
    public function verify(Request $request)
    {
        $request->validate([
            'razorpay_payment_id' => 'required|string',
            'razorpay_order_id'   => 'required|string',
            'razorpay_signature'  => 'required|string',
            'plan'                => 'required|in:monthly,yearly,trial',
        ]);

        try {
            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
            $api->utility->verifyPaymentSignature([
                'razorpay_order_id'   => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature'  => $request->razorpay_signature,
            ]);

            $user = auth()->user();
            $daysToAdd = match($request->plan) {
                'trial'   => 60,
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
