<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Query;
use App\Models\Claim;
use App\Models\Renewal;
use App\Models\Staff;

class TrashController extends Controller
{
    protected $modelMap = [
        'client' => Client::class,
        'query' => Query::class,
        'claim' => Claim::class,
        'renewal' => Renewal::class,
        'staff' => Staff::class,
    ];

    public function index()
    {
        $user = auth()->user();
        $context = $user->context();

        $deletedClients = $context->clients()->onlyTrashed()->get();
        $deletedQueries = $context->queries()->onlyTrashed()->get();
        $deletedClaims = $context->claims()->onlyTrashed()->get();
        $deletedRenewals = $context->renewals()->onlyTrashed()->get();
        $deletedStaff = Staff::where('advisor_id', $context->id)->onlyTrashed()->get();

        return view('trash.index', compact(
            'deletedClients',
            'deletedQueries',
            'deletedClaims',
            'deletedRenewals',
            'deletedStaff'
        ));
    }

    public function restore($type, $id)
    {
        $modelClass = $this->modelMap[$type] ?? null;
        if (!$modelClass) abort(404);

        $context = auth()->user()->context();

        $fkColumn = ($type === 'staff') ? 'advisor_id' : 'user_id';

        $item = $modelClass::onlyTrashed()
            ->where($fkColumn, $context->id)
            ->where('id', $id)
            ->firstOrFail();

        $item->restore();

        return redirect()->back()->with('success', ucfirst($type) . ' restored successfully.');
    }

    public function forceDelete($type, $id)
    {
        $modelClass = $this->modelMap[$type] ?? null;
        if (!$modelClass) abort(404);

        $context = auth()->user()->context();

        $fkColumn = ($type === 'staff') ? 'advisor_id' : 'user_id';

        $item = $modelClass::onlyTrashed()
            ->where($fkColumn, $context->id)
            ->where('id', $id)
            ->firstOrFail();

        $item->forceDelete();

        return redirect()->back()->with('success', ucfirst($type) . ' permanently deleted.');
    }
}
