<?php

namespace App\Http\Controllers;

use App\Models\Query;
use App\Models\Client;
use Illuminate\Http\Request;

class QueryController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $context = $user->context();
        $search = request('search');
        $query = $context->queries()->with('client');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('subject', 'like', "%$search%")
                  ->orWhereHas('client', function($cq) use ($search) {
                      $cq->where('name', 'like', "%$search%");
                  });
            });
        }

        $queries = $query->latest()->paginate(10);
        
        $stats = [
            'total' => $context->queries()->count(),
            'approved' => $context->queries()->where('status', 'approved')->count(),
            'pending' => $context->queries()->where('status', 'pending')->count(),
            'rejected' => $context->queries()->where('status', 'rejected')->count(),
        ];

        return view('queries.index', compact('queries', 'stats'));
    }

    public function create()
    {
        $context = auth()->user()->context();
        $clients = $context->clients()->get();
        return view('queries.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $context = $user->context();

        $validated = $request->validate([
            'client_id' => 'nullable|string',
            'new_client_name' => 'required_if:client_id,new|nullable|string|max:255',
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:pending,approved,rejected',
            'document' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:5120',
        ]);

        if ($request->hasFile('document')) {
            $disk = config('filesystems.disks.s3.key') ? 's3' : 'public';
            $path = $request->file('document')->store('query_documents', $disk);
            $validated['document'] = $path;
        }

        if ($request->input('client_id') === 'new') {
            $client = $context->clients()->create([
                'name' => $validated['new_client_name'],
                'email' => strtolower(str_replace(' ', '.', $validated['new_client_name'])) . '@example.com',
                'phone' => '0000000000',
                'address' => 'Auto-created via Query',
            ]);
            $validated['client_id'] = $client->id;
        }

        unset($validated['new_client_name']);
        $context->queries()->create($validated);
        
        if ($request->ajax()) {
            return response()->json(['message' => 'Query created successfully.']);
        }

        return redirect()->route('queries.index')->with('success', 'Query created successfully.');
    }

    public function edit(Query $query)
    {
        $context = auth()->user()->context();
        if ($query->user_id !== $context->id) abort(403);
        $clients = $context->clients()->get();
        return view('queries.edit', compact('query', 'clients'));
    }

    public function update(Request $request, Query $query)
    {
        $context = auth()->user()->context();
        if ($query->user_id !== $context->id) abort(403);

        $validated = $request->validate([
            'client_id' => 'nullable|string',
            'new_client_name' => 'required_if:client_id,new|nullable|string|max:255',
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:pending,approved,rejected',
            'document' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:5120',
        ]);

        if ($request->hasFile('document')) {
            $disk = config('filesystems.disks.s3.key') ? 's3' : 'public';
            $path = $request->file('document')->store('query_documents', $disk);
            $validated['document'] = $path;
        }

        if ($request->input('client_id') === 'new') {
            $client = $context->clients()->create([
                'name' => $validated['new_client_name'],
                'email' => strtolower(str_replace(' ', '.', $validated['new_client_name'])) . '@example.com',
                'phone' => '0000000000',
                'address' => 'Auto-created via Query',
            ]);
            $validated['client_id'] = $client->id;
        }

        unset($validated['new_client_name']);
        $query->update($validated);

        if ($request->ajax()) {
            return response()->json(['message' => 'Query updated successfully.']);
        }

        return redirect()->route('queries.index')->with('success', 'Query updated successfully.');
    }

    public function destroy(Query $query)
    {
        $context = auth()->user()->context();
        if ($query->user_id !== $context->id) abort(403);
        $query->delete();
        return redirect()->route('queries.index')->with('success', 'Query deleted successfully.');
    }
}
