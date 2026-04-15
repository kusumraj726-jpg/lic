<?php

namespace App\Http\Controllers;

use App\Models\Commission;
use App\Models\Client;
use App\Models\Renewal;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CommissionController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $context = $user->context();
        $search = request('search');
        
        $query = $context->commissions()->with(['client', 'renewal']);

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('policy_number', 'like', "%$search%")
                  ->orWhere('provider', 'like', "%$search%")
                  ->orWhereHas('client', function($cq) use ($search) {
                      $cq->where('name', 'like', "%$search%");
                  });
            });
        }

        if (request('status')) {
            $query->where('status', request('status'));
        }

        if (request('provider')) {
            $query->where('provider', request('provider'));
        }

        $commissions = $query->latest()->paginate(15);
        
        $stats = [
            'total_pending' => $context->commissions()->where('status', 'pending')->sum('expected_amount'),
            'total_received_month' => $context->commissions()
                ->where('status', 'received')
                ->whereMonth('received_at', now()->month)
                ->sum('received_amount'),
            'pending_count' => $context->commissions()->where('status', 'pending')->count(),
        ];

        $providers = $context->commissions()->distinct()->pluck('provider');

        return view('commissions.index', compact('commissions', 'stats', 'providers', 'context'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $context = $user->context();

        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'renewal_id' => 'nullable|exists:renewals,id',
            'policy_number' => 'required|string|max:255',
            'provider' => 'required|string|max:255',
            'expected_amount' => 'required|numeric|min:0',
            'status' => 'required|in:pending,received,partial',
            'notes' => 'nullable|string',
        ]);

        $context->commissions()->create($validated);

        return redirect()->route('commissions.index')->with('success', 'Commission record created.');
    }

    public function markAsReceived(Request $request, Commission $commission)
    {
        $context = auth()->user()->context();
        if ($commission->user_id !== $context->id) abort(403);

        $request->validate([
            'amount' => 'required|numeric|min:0',
            'received_at' => 'required|date',
        ]);

        $commission->update([
            'received_amount' => $request->amount,
            'received_at' => $request->received_at,
            'status' => 'received',
        ]);

        return back()->with('success', 'Commission marked as received.');
    }

    public function destroy(Commission $commission)
    {
        $context = auth()->user()->context();
        if ($commission->user_id !== $context->id) abort(403);
        $commission->delete();
        return redirect()->route('commissions.index')->with('success', 'Commission record deleted.');
    }
}
