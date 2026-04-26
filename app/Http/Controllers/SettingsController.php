<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivityLog;

class SettingsController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $context = $user->context();

        return view('settings.index', compact('user', 'context'));
    }

    public function logs(Request $request)
    {
        $user = auth()->user();
        $context = $user->context();
        $type = $request->get('type', 'staff'); // 'staff' or 'admin'

        $query = ActivityLog::forTenant($context->id)->latest()->with('user');

        if ($type === 'admin') {
            $query->adminLogs();
        } else {
            $query->staffLogs();
        }

        $logs = $query->paginate(20)->withQueryString();

        return view('settings.logs', compact('logs', 'type', 'context'));
    }

    public function updateBranding(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'brand_logo'   => 'nullable|file|mimes:jpeg,jpg,png,gif,svg,webp|max:2048',
        ]);

        $context = auth()->user()->context();
        
        $context->company_name = $request->company_name;

        if ($request->hasFile('brand_logo') && $request->file('brand_logo')->isValid()) {
            // Delete old logo if it exists on the public disk
            // Determine disk
            $disk = config('filesystems.disks.s3.key') ? 's3' : 'public';

            if ($context->brand_logo) {
                \Illuminate\Support\Facades\Storage::disk($disk)->delete($context->brand_logo);
            }
            $path = $request->file('brand_logo')->store('brand_logos', $disk);
            $context->brand_logo = $path;
        }

        $context->save();

        ActivityLog::create([
            'context_id'  => $context->id,
            'user_id'     => auth()->id(),
            'action'      => 'updated',
            'target_type' => get_class($context),
            'target_id'   => $context->id,
            'description' => 'Updated Workspace Branding',
            'ip_address'  => request()->ip(),
            'metadata'    => ['attributes' => ['company_name' => $context->company_name]]
        ]);

        return redirect()->back()->with('success', 'Workspace branding updated successfully.');
    }
    public function updateCommissions(Request $request)
    {
        $request->validate([
            'rates' => 'required|array',
            'rates.*' => 'required|numeric|min:0|max:100',
        ]);

        $context = auth()->user()->context();
        $context->update(['commission_rates' => $request->rates]);

        ActivityLog::create([
            'context_id' => $context->id,
            'user_id' => auth()->id(),
            'action' => 'updated',
            'target_type' => get_class($context),
            'target_id' => $context->id,
            'description' => 'Updated Commission Rates',
            'ip_address' => request()->ip(),
        ]);

        return redirect()->back()->with('success', 'Commission rates updated successfully.');
    }
}
