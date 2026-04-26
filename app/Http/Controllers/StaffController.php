<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StaffController extends Controller
{
    public function index()
    {
        $search = request('search');
        $query = auth()->user()->staff()->with('staffUser');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
                  ->orWhere('designation', 'like', "%$search%");
            });
        }

        $staff = $query->latest()->paginate(10);
        return view('staff.index', compact('staff'));
    }

    public function create()
    {
        return view('staff.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'staff_member_name_sec' => 'required|string|max:255',
            'staff_member_email_sec' => 'required|email|unique:users,email|unique:staff,email',
            'staff_member_phone_sec' => 'nullable|digits:10',
            'staff_member_designation_sec' => 'nullable|string|max:100',
            'status' => 'required|in:active,inactive',
            'password' => 'required|string|min:8|confirmed',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'access_clients' => 'nullable|boolean',
            'access_queries' => 'nullable|boolean',
            'access_claims' => 'nullable|boolean',
            'access_renewals' => 'nullable|boolean',
        ]);

        // Generate unique Staff ID (e.g., NX-STF-0001)
        $lastStaff = User::where('unique_id', 'like', 'NX-STF-%')->latest('id')->first();
        $nextId = 1;
        if ($lastStaff) {
            $lastIdNumber = (int) str_replace('NX-STF-', '', $lastStaff->unique_id);
            $nextId = $lastIdNumber + 1;
        }
        $uniqueId = 'NX-STF-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);

        // 1. Create Login User
        $user = User::create([
            'name' => $validated['staff_member_name_sec'],
            'email' => $validated['staff_member_email_sec'],
            'password' => Hash::make($validated['password']),
            'role' => 'staff',
            'unique_id' => $uniqueId,
        ]);

        // 2. Handle Avatar Upload
        if ($request->hasFile('avatar')) {
            $disk = config('filesystems.disks.s3.key') ? 's3' : 'public';
            $path = $request->file('avatar')->store('avatars', $disk);
            $user->update(['avatar' => $path]);
        }

        // 3. Create Staff Profile
        $staffData = [
            'advisor_id' => auth()->id(),
            'staff_user_id' => $user->id,
            'name' => $validated['staff_member_name_sec'],
            'email' => $validated['staff_member_email_sec'],
            'phone' => $validated['staff_member_phone_sec'],
            'designation' => $validated['staff_member_designation_sec'],
            'status' => $validated['status'],
            'access_clients' => $request->boolean('access_clients', true),
            'access_queries' => $request->boolean('access_queries', true),
            'access_claims' => $request->boolean('access_claims', true),
            'access_renewals' => $request->boolean('access_renewals', true),
        ];

        Staff::create($staffData);

        return redirect()->route('staff.index')->with('success', 'Staff member and login account created successfully.');
    }

    public function show(Staff $staff)
    {
        $this->authorizeAdvisor($staff);
        return view('staff.show', compact('staff'));
    }

    public function edit(Staff $staff)
    {
        $this->authorizeAdvisor($staff);
        return view('staff.edit', compact('staff'));
    }

    public function update(Request $request, Staff $staff)
    {
        $this->authorizeAdvisor($staff);
        
        $validated = $request->validate([
            'staff_member_name_sec' => 'required|string|max:255',
            'staff_member_email_sec' => 'required|email|unique:staff,email,' . $staff->id,
            'staff_member_phone_sec' => 'nullable|digits:10',
            'staff_member_designation_sec' => 'nullable|string|max:100',
            'status' => 'required|in:active,inactive',
            'password' => 'nullable|string|min:8|confirmed',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'access_clients' => 'nullable|boolean',
            'access_queries' => 'nullable|boolean',
            'access_claims' => 'nullable|boolean',
            'access_renewals' => 'nullable|boolean',
        ]);

        // Update Staff Profile
        $staffData = [];
        $staffData['name'] = $validated['staff_member_name_sec'];
        $staffData['email'] = $validated['staff_member_email_sec'];
        $staffData['phone'] = $validated['staff_member_phone_sec'];
        $staffData['designation'] = $validated['staff_member_designation_sec'];
        $staffData['status'] = $validated['status'];
        $staffData['access_clients'] = $request->boolean('access_clients');
        $staffData['access_queries'] = $request->boolean('access_queries');
        $staffData['access_claims'] = $request->boolean('access_claims');
        $staffData['access_renewals'] = $request->boolean('access_renewals');

        $staff->update($staffData);

        // Update Associated User
        if ($staff->staffUser) {
            $userData = [
                'name' => $validated['staff_member_name_sec'],
                'email' => $validated['staff_member_email_sec'],
            ];

            if ($request->filled('password')) {
                $userData['password'] = Hash::make($validated['password']);
            }

            if ($request->hasFile('avatar')) {
                // Determine disk
                $disk = config('filesystems.disks.s3.key') ? 's3' : 'public';
                
                // Delete old avatar
                if ($staff->staffUser->avatar) {
                    Storage::disk($disk)->delete($staff->staffUser->avatar);
                }
                $userData['avatar'] = $request->file('avatar')->store('avatars', $disk);
            }

            $staff->staffUser->update($userData);
        }

        return redirect()->route('staff.index')->with('success', 'Staff details updated.');
    }

    public function destroy(Staff $staff)
    {
        $this->authorizeAdvisor($staff);
        $staff->delete();

        return redirect()->route('staff.index')->with('success', 'Staff member moved to trash.');
    }

    protected function authorizeAdvisor(Staff $staff)
    {
        if ($staff->advisor_id !== auth()->id()) {
            abort(403);
        }
    }
}
