<?php
use App\Models\User;
use Illuminate\Support\Carbon;

$users = User::all();
foreach ($users as $user) {
    if ($user->subscription_ends_at && Carbon::parse($user->subscription_ends_at)->year > 2038) {
        echo "Updating User {$user->id}: {$user->subscription_ends_at} -> 2035-01-01\n";
        $user->subscription_ends_at = '2035-01-01 00:00:00';
        $user->save();
    }
}
echo "Cleaned up all users.\n";
