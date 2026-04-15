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
            'policy_number' => 'nullable|string|max:255',
            'policy_type' => 'nullable|string|max:255',
            'premium_amount' => 'nullable|numeric|min:0',
            'custom_commission_rate' => 'nullable|numeric|min:0|max:100',
        ]);

        $clientData = $validated;
        unset($clientData['photo'], $clientData['policy_number'], $clientData['policy_type'], $clientData['premium_amount'], $clientData['custom_commission_rate']);
        
        $client = $context->clients()->create($clientData);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('clients/photos', 'public');
            $client->update(['photo' => $path]);
        }

        // Automated Policy Creation
        if ($request->filled('policy_number')) {
            $renewal = $client->renewals()->create([
                'user_id' => $context->id,
                'policy_number' => $request->policy_number,
                'policy_type' => $request->policy_type ?? 'Other',
                'premium_amount' => $request->premium_amount ?? 0,
                'custom_commission_rate' => $request->custom_commission_rate,
                'expiry_date' => now()->addYear(), // Default to 1 year
                'status' => 'pending',
            ]);
            $renewal->generateCommission();
        }

        return redirect()->route('clients.index')->with('success', 'Client created successfully.');
    }

    public function show(Client $client)
    {
        $context = auth()->user()->context();
        if ($client->user_id !== $context->id) abort(403);
        $latestPolicy = $client->renewals()->latest()->first();
        return view('clients.show', compact('client', 'latestPolicy'));
    }

    public function edit(Client $client)
    {
        $context = auth()->user()->context();
        if ($client->user_id !== $context->id) abort(403);
        $latestPolicy = $client->renewals()->latest()->first();
        return view('clients.edit', compact('client', 'latestPolicy'));
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
            'policy_number' => 'nullable|string|max:255',
            'policy_type' => 'nullable|string|max:255',
            'premium_amount' => 'nullable|numeric|min:0',
            'custom_commission_rate' => 'nullable|numeric|min:0|max:100',
        ]);

        $clientData = $validated;
        unset($clientData['photo'], $clientData['policy_number'], $clientData['policy_type'], $clientData['premium_amount'], $clientData['custom_commission_rate']);

        if ($request->hasFile('photo')) {
            // Delete old photo
            if ($client->photo) {
                Storage::disk('public')->delete($client->photo);
            }
            $clientData['photo'] = $request->file('photo')->store('clients/photos', 'public');
        }

        $client->update($clientData);

        // Update/Create Policy Logic for Edit
        if ($request->filled('policy_number')) {
            $client->renewals()->updateOrCreate(
                ['policy_number' => $request->policy_number, 'user_id' => $context->id],
                [
                    'policy_type' => $request->policy_type ?? 'Other',
                    'premium_amount' => $request->premium_amount ?? 0,
                    'custom_commission_rate' => $request->custom_commission_rate,
                    'expiry_date' => now()->addYear(),
                    'status' => 'pending',
                ]
            );
        }

        return redirect()->route('clients.index')->with('success', 'Client updated successfully.');
    }

    public function destroy(Client $client)
    {
        $context = auth()->user()->context();
        if ($client->user_id !== $context->id) abort(403);
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Client deleted successfully.');
    }
}
