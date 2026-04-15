<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use App\Models\Client;
use Illuminate\Http\Request;

class ClaimController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $context = $user->context();
        $search = request('search');
        $query = $context->claims()->with('client');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('policy_number', 'like', "%$search%")
                  ->orWhereHas('client', function($cq) use ($search) {
                      $cq->where('name', 'like', "%$search%");
                  });
            });
        }

        $claims = $query->latest()->paginate(10);
        
        $stats = [
            'total' => $context->claims()->count(),
            'submitted' => $context->claims()->where('status', 'submitted')->count(),
            'pending' => $context->claims()->where('status', 'pending')->count(),
            'approved' => $context->claims()->where('status', 'approved')->count(),
            'rejected' => $context->claims()->where('status', 'rejected')->count(),
        ];

        return view('claims.index', compact('claims', 'stats'));
    }

    public function create()
    {
        $context = auth()->user()->context();
        $clients = $context->clients()->get();
        
        // Smarter Detection: Pull policy numbers from both Renewals and Claims
        $renewalPolicies = $context->renewals()->select('client_id', 'policy_number', 'policy_type', 'custom_commission_rate')->distinct()->get();
        $claimPolicies = $context->claims()->select('client_id', 'policy_number', 'policy_type', 'custom_commission_rate')->distinct()->get();
        
        $clientPolicies = $renewalPolicies->concat($claimPolicies)
            ->groupBy('client_id')
            ->mapWithKeys(function ($item, $key) { 
                return [(string)$key => $item->map(function($p) {
                    return [
                        'number' => $p->policy_number,
                        'type' => $p->policy_type,
                        'commission' => $p->custom_commission_rate
                    ];
                })->unique('number')->values()->toArray()]; 
            })->toArray();

        return view('claims.create', compact('clients', 'clientPolicies'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $context = $user->context();

        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'policy_number' => 'required|string|max:255',
            'policy_type' => 'required|string|max:255',
            'claim_amount' => 'required|numeric|min:0',
            'incident_date' => 'required|date',
            'status' => 'required|in:submitted,pending,approved,rejected',
            'description' => 'nullable|string',
            'custom_commission_rate' => 'nullable|numeric|min:0|max:100',
        ]);

        $context->claims()->create($validated);
        
        if ($request->ajax()) {
            return response()->json(['message' => 'Claim created successfully.']);
        }

        return redirect()->route('claims.index')->with('success', 'Claim created successfully.');
    }

    public function edit(Claim $claim)
    {
        $context = auth()->user()->context();
        if ($claim->user_id !== $context->id) abort(403);
        $clients = $context->clients()->get();
        
        $renewalPolicies = $context->renewals()->select('client_id', 'policy_number', 'policy_type', 'custom_commission_rate')->distinct()->get();
        $claimPolicies = $context->claims()->select('client_id', 'policy_number', 'policy_type', 'custom_commission_rate')->distinct()->get();
        
        $clientPolicies = $renewalPolicies->concat($claimPolicies)
            ->groupBy('client_id')
            ->mapWithKeys(function ($item, $key) { 
                return [(string)$key => $item->map(function($p) {
                    return [
                        'number' => $p->policy_number,
                        'type' => $p->policy_type,
                        'commission' => $p->custom_commission_rate
                    ];
                })->unique('number')->values()->toArray()]; 
            })->toArray();

        return view('claims.edit', compact('claim', 'clients', 'clientPolicies'));
    }

    public function update(Request $request, Claim $claim)
    {
        $context = auth()->user()->context();
        if ($claim->user_id !== $context->id) abort(403);

        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'policy_number' => 'required|string|max:255',
            'policy_type' => 'required|string|max:255',
            'claim_amount' => 'required|numeric|min:0',
            'incident_date' => 'required|date',
            'status' => 'required|in:submitted,pending,approved,rejected',
            'description' => 'nullable|string',
            'custom_commission_rate' => 'nullable|numeric|min:0|max:100',
        ]);

        $claim->update($validated);

        if ($request->ajax()) {
            return response()->json(['message' => 'Claim updated successfully.']);
        }

        return redirect()->route('claims.index')->with('success', 'Claim updated successfully.');
    }

    public function destroy(Claim $claim)
    {
        $context = auth()->user()->context();
        if ($claim->user_id !== $context->id) abort(403);
        $claim->delete();
        return redirect()->route('claims.index')->with('success', 'Claim deleted successfully.');
    }
}
