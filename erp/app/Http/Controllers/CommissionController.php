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
            'total_pending' => $context->commissions()->where('status', '!=', 'received')->sum('expected_amount'),
            'total_received_month' => $context->commissions()->where('status', 'received')->whereMonth('received_at', now()->month)->sum('received_amount'),
            'pending_count' => $context->commissions()->where('status', '!=', 'received')->count(),
        ];

        $providers = $context->commissions()->distinct()->pluck('provider');
        $clients = $context->clients()->orderBy('name')->get();

        // Policy Portfolio Discovery
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

        return view('commissions.index', compact('commissions', 'stats', 'providers', 'clients', 'clientPolicies', 'context'));
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
            'received_amount' => 'nullable|numeric|min:0',
            'status' => 'required|in:pending,received,partial',
            'notes' => 'nullable|string',
        ]);

        if (in_array($validated['status'], ['received', 'partial']) && !isset($validated['received_amount'])) {
            $validated['received_amount'] = ($validated['status'] === 'received') ? $validated['expected_amount'] : 0;
        }

        if (in_array($validated['status'], ['received', 'partial'])) {
            $validated['received_at'] = now();
        }

        $context->commissions()->create($validated);

        return redirect()->route('commissions.index')->with('success', 'Commission record created.');
    }

    public function update(Request $request, Commission $commission)
    {
        $context = auth()->user()->context();
        if ($commission->user_id !== $context->id) abort(403);

        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'renewal_id' => 'nullable|exists:renewals,id',
            'policy_number' => 'required|string|max:255',
            'provider' => 'required|string|max:255',
            'expected_amount' => 'required|numeric|min:0',
            'received_amount' => 'nullable|numeric|min:0',
            'status' => 'required|in:pending,received,partial',
            'notes' => 'nullable|string',
        ]);

        $commission->update($validated);

        if (in_array($commission->status, ['received', 'partial']) && !$commission->received_at) {
            $commission->update(['received_at' => now()]);
        }

        return back()->with('success', 'Commission record updated.');
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
    public function export()
    {
        $context = auth()->user()->context();
        $commissions = $context->commissions()->with('client')->latest()->get();

        $filename = "Commission_Ledger_" . now()->format('Y_m_d') . ".csv";
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['Date', 'Client', 'Policy Number', 'Provider', 'Expected (₹)', 'Received (₹)', 'Status', 'Notes'];

        $callback = function() use ($commissions, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($commissions as $comm) {
                fputcsv($file, [
                    $comm->created_at->format('Y-m-d'),
                    $comm->client->name,
                    $comm->policy_number,
                    $comm->provider,
                    $comm->expected_amount,
                    $comm->received_amount,
                    strtoupper($comm->status),
                    $comm->notes
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
