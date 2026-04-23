<?php

namespace App\Http\Controllers;

use App\Models\StudioInquiry;
use Illuminate\Http\Request;

class StudioInquiryController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'service' => 'required|string',
            'message' => 'nullable|string'
        ]);

        StudioInquiry::create($validated);

        return response()->json(['success' => true]);
    }
}
