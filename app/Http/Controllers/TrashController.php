<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Query;
use App\Models\Claim;
use App\Models\Renewal;
use Illuminate\Http\Request;

class TrashController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $search = request('search');
        
        $clients = $user->clients()->onlyTrashed();
        $queries = $user->queries()->onlyTrashed();
        $claims = $user->claims()->onlyTrashed();
        $renewals = $user->renewals()->onlyTrashed();
        $staff = $user->staff()->onlyTrashed();

        if ($search) {
            $clients->where('name', 'like', "%$search%");
            $queries->where('subject', 'like', "%$search%");
            $claims->where('policy_number', 'like', "%$search%");
            $renewals->where('policy_number', 'like', "%$search%");
            $staff->where('name', 'like', "%$search%");
        }

        $trashed = [
            'clients' => $clients->get(),
            'queries' => $queries->get(),
            'claims' => $claims->get(),
            'renewals' => $renewals->get(),
            'staff' => $staff->get(),
        ];

        return view('trash.index', compact('trashed'));
    }

    public function restore($type, $id)
    {
        $model = $this->getModel($type, $id, true);
        $model->restore();

        return back()->with('success', ucfirst($type) . ' record restored successfully.');
    }

    public function forceDelete($type, $id)
    {
        $model = $this->getModel($type, $id, true);
        $model->forceDelete();

        return back()->with('success', ucfirst($type) . ' record permanently purged.');
    }

    protected function getModel($type, $id, $trashed = false)
    {
        $user = auth()->user();
        $query = match($type) {
            'clients' => $user->clients(),
            'queries' => $user->queries(),
            'claims' => $user->claims(),
            'renewals' => $user->renewals(),
            'staff' => $user->staff(),
            default => abort(404),
        };

        return $trashed ? $query->onlyTrashed()->findOrFail($id) : $query->findOrFail($id);
    }
}
