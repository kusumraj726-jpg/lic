<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->get('q');
        if (!$query || strlen($query) < 2) {
            return response()->json([]);
        }

        $context = auth()->user()->context();
        $results = collect();

        // 1. Search Clients
        $context->clients()->where('name', 'like', "%{$query}%")
            ->take(5)->get()->each(function($c) use ($results) {
                $results->push([
                    'type' => 'Client',
                    'title' => $c->name,
                    'meta' => "Policy ID: {$c->policy_number}",
                    'url' => route('clients.index', ['id' => $c->id]),
                    'icon' => 'user'
                ]);
            });

        // 2. Search Staff
        $context->staff()->where('name', 'like', "%{$query}%")
            ->take(3)->get()->each(function($s) use ($results) {
                $results->push([
                    'type' => 'Staff',
                    'title' => $s->name,
                    'meta' => $s->role,
                    'url' => route('staff.index'),
                    'icon' => 'identification'
                ]);
            });

        // 3. Search Claims
        $context->claims()->whereHas('client', function($q) use ($query) {
            $q->where('name', 'like', "%{$query}%");
        })->orWhere('policy_type', 'like', "%{$query}%")
          ->take(5)->get()->each(function($cl) use ($results) {
              $results->push([
                  'type' => 'Claim',
                  'title' => $cl->client->name ?? 'External Claim',
                  'meta' => "Type: {$cl->policy_type} | Status: {$cl->status}",
                  'url' => route('claims.index', ['id' => $cl->id]),
                  'icon' => 'shield'
              ]);
          });

        return response()->json($results);
    }
}
