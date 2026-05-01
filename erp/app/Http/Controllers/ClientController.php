<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    public function index()
    {
        $context = auth()->user()->context();
        $search = request('search');
        $query = $context->clients();

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
                  ->orWhere('phone', 'like', "%$search%");
            });
        }

        $clients = $query->with('renewals')->latest()->paginate(10);
        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $context = auth()->user()->context();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'dob' => 'nullable|date',
            'gender' => 'nullable|in:Male,Female,Other',
            'phone' => 'nullable|digits:10',
            'marriage_anniversary' => 'nullable|date',
            'address' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $clientData = $validated;
        unset($clientData['photo']);
        
        $client = $context->clients()->create($clientData);

        if ($request->hasFile('photo')) {
            $disk = config('filesystems.disks.s3.key') ? 's3' : 'public';
            $path = $request->file('photo')->store('clients/photos', $disk);
            $client->update(['photo' => $path]);
        }

        // Process Policies and ensure they are registered in renewals
        if ($request->has('policies')) {
            foreach ($request->input('policies') as $policyData) {
                if (!empty($policyData['policy_number'])) {
                    $context->renewals()->updateOrCreate(
                        [
                            'client_id' => $client->id,
                            'policy_number' => $policyData['policy_number']
                        ],
                        [
                            'policy_type' => $policyData['policy_type'] === 'Custom' ? ($policyData['custom_type'] ?? 'Insurance') : $policyData['policy_type'],
                            'premium_amount' => $policyData['premium_amount'] ?? 0,
                            'expiry_date' => $policyData['expiry_date'] ?? now()->addYear(),
                            'status' => 'pending',
                        ]
                    );
                }
            }
        }

        return redirect()->route('clients.index')->with('success', 'Client and Portfolio created successfully.');
    }

    public function show(Client $client)
    {
        $context = auth()->user()->context();
        if ($client->user_id !== $context->id) abort(403);
        $policies = $client->renewals()->get();
        return view('clients.show', compact('client', 'policies'));
    }

    public function edit(Client $client)
    {
        $context = auth()->user()->context();
        if ($client->user_id !== $context->id) abort(403);
        $policies = $client->renewals()->get();
        return view('clients.edit', compact('client', 'policies'));
    }

    public function update(Request $request, Client $client)
    {
        $context = auth()->user()->context();
        if ($client->user_id !== $context->id) abort(403);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'dob' => 'nullable|date',
            'gender' => 'nullable|in:Male,Female,Other',
            'phone' => 'nullable|digits:10',
            'marriage_anniversary' => 'nullable|date',
            'address' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $clientData = $validated;
        unset($clientData['photo']);

        if ($request->hasFile('photo')) {
            // Determine disk
            $disk = config('filesystems.disks.s3.key') ? 's3' : 'public';
            
            // Delete old photo
            if ($client->photo) {
                Storage::disk($disk)->delete($client->photo);
            }
            $clientData['photo'] = $request->file('photo')->store('clients/photos', $disk);
        }

        $client->update($clientData);

        // Process Policies
        if ($request->has('policies')) {
            $submittedPolicyIds = [];
            foreach ($request->input('policies') as $policyData) {
                $pType = $policyData['policy_type'] === 'Custom' ? ($policyData['custom_type'] ?? 'Insurance') : $policyData['policy_type'];
                
                if (!empty($policyData['id'])) {
                    // Update existing
                    $renewal = $client->renewals()->find($policyData['id']);
                    if ($renewal) {
                        $renewal->update([
                            'policy_number' => $policyData['policy_number'],
                            'policy_type' => $pType,
                            'premium_amount' => $policyData['premium_amount'],
                            'expiry_date' => $policyData['expiry_date'],
                        ]);
                        $submittedPolicyIds[] = $renewal->id;
                    }
                } else if (!empty($policyData['policy_number'])) {
                    // Create new and ensure user_id is set
                    $newRenewal = $context->renewals()->create([
                        'client_id' => $client->id,
                        'policy_number' => $policyData['policy_number'],
                        'policy_type' => $pType,
                        'premium_amount' => $policyData['premium_amount'] ?? 0,
                        'expiry_date' => $policyData['expiry_date'] ?? now()->addYear(),
                        'status' => 'pending',
                    ]);
                    $submittedPolicyIds[] = $newRenewal->id;
                }
            }
            
            // Optional: Remove policies not in the submitted list
            $client->renewals()->whereNotIn('id', $submittedPolicyIds)->delete();
        }

        return redirect()->route('clients.index')->with('success', 'Client and Portfolio updated successfully.');
    }

    public function destroy(Client $client)
    {
        $context = auth()->user()->context();
        if ($client->user_id !== $context->id) abort(403);
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Client deleted successfully.');
    }
}
