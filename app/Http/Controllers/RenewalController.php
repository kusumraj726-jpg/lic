<?php

namespace App\Http\Controllers;

use App\Models\Renewal;
use App\Models\Client;
use Illuminate\Http\Request;

class RenewalController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $context = $user->context();
        $search = request('search');
        $query = $context->renewals()->with('client');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('policy_number', 'like', "%$search%")
                  ->orWhereHas('client', function($cq) use ($search) {
                      $cq->where('name', 'like', "%$search%");
                  });
            });
        }

        if (request('status')) {
            $query->where('status', request('status'));
        }

        if (request('upcoming')) {
            $query->where('status', 'pending')
                  ->where('expiry_date', '>', now())
                  ->where('expiry_date', '<', now()->addDays(30));
        }

        $renewals = $query->latest()->paginate(10);
        
        $stats = [
            'total' => $context->renewals()->count(),
            'pending' => $context->renewals()->where('status', 'pending')->count(),
            'renewed' => $context->renewals()->where('status', 'renewed')->count(),
            'lapsed' => $context->renewals()->where('status', 'lapsed')->count(),
            'upcoming' => $context->renewals()->where('status', 'pending')
                                           ->where('expiry_date', '>', now())
                                           ->where('expiry_date', '<', now()->addDays(30))
                                           ->count(),
        ];

        return view('renewals.index', compact('renewals', 'stats'));
    }

    public function create()
    {
        $context = auth()->user()->context();
        $clients = $context->clients()->get();
        
        // Smarter Detection: Pull policy numbers from Renewals and Claims
        $renewalPolicies = $context->renewals()->select('client_id', 'policy_number', 'policy_type', 'custom_commission_rate')->get();
        $claimPolicies = $context->claims()->select('client_id', 'policy_number', 'policy_type')->get();
        
        $clientPolicies = $renewalPolicies->concat($claimPolicies)
            ->groupBy('client_id')
            ->mapWithKeys(function ($item, $key) { 
                return [(string)$key => $item->whereNotNull('policy_number')->map(function($p) {
                    return [
                        'number' => (string)$p->policy_number,
                        'type' => $p->policy_type ?? 'Insurance',
                        'commission' => $p->custom_commission_rate ?? ''
                    ];
                })->unique('number')->values()->toArray()]; 
            })->toArray();

        return view('renewals.create', compact('clients', 'clientPolicies'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $context = $user->context();

        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'policy_number' => 'required|string|max:255',
            'policy_type' => 'required|string|max:255',
            'premium_amount' => 'required|numeric|min:0',
            'expiry_date' => 'required|date',
            'status' => 'required|in:pending,renewed,lapsed',
        ]);

        $renewal = $context->renewals()->create($validated);
        
        if ($request->ajax()) {
            return response()->json(['message' => 'Renewal created successfully.']);
        }

        return redirect()->route('renewals.index')->with('success', 'Renewal created successfully.');
    }

    public function edit(Renewal $renewal)
    {
        $context = auth()->user()->context();
        if ($renewal->user_id !== $context->id) abort(403);
        $clients = $context->clients()->get();
        
        // Smarter Detection: Pull policy numbers from Renewals and Claims
        $renewalPolicies = $context->renewals()->select('client_id', 'policy_number', 'policy_type', 'custom_commission_rate')->get();
        $claimPolicies = $context->claims()->select('client_id', 'policy_number', 'policy_type')->get();
        
        $clientPolicies = $renewalPolicies->concat($claimPolicies)
            ->groupBy('client_id')
            ->mapWithKeys(function ($item, $key) { 
                return [(string)$key => $item->whereNotNull('policy_number')->map(function($p) {
                    return [
                        'number' => (string)$p->policy_number,
                        'type' => $p->policy_type ?? 'Insurance',
                        'commission' => $p->custom_commission_rate ?? ''
                    ];
                })->unique('number')->values()->toArray()]; 
            })->toArray();

        return view('renewals.edit', compact('renewal', 'clients', 'clientPolicies'));
    }

    public function update(Request $request, Renewal $renewal)
    {
        $context = auth()->user()->context();
        if ($renewal->user_id !== $context->id) abort(403);

        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'policy_number' => 'required|string|max:255',
            'policy_type' => 'required|string|max:255',
            'premium_amount' => 'required|numeric|min:0',
            'expiry_date' => 'required|date',
            'status' => 'required|in:pending,renewed,lapsed',
        ]);

        $renewal->update($validated);

        if ($request->ajax()) {
            return response()->json(['message' => 'Renewal updated successfully.']);
        }

        return redirect()->route('renewals.index')->with('success', 'Renewal updated successfully.');
    }

    public function destroy(Renewal $renewal)
    {
        $context = auth()->user()->context();
        if ($renewal->user_id !== $context->id) abort(403);
        $renewal->delete();
        return redirect()->route('renewals.index')->with('success', 'Renewal deleted successfully.');
    }
}
