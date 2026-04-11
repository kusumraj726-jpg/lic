<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$user = App\Models\User::where('email', 'shivam.sh0023@gmail.com')->first();
if (!$user) {
    echo "USER NOT FOUND: shivam.sh0023@gmail.com\n";
    $user = App\Models\User::first();
    echo "Using first user: {$user->email} (ID: {$user->id})\n";
} else {
    echo "FOUND USER: {$user->email} (ID: {$user->id})\n";
}

$updatedQ = App\Models\Query::where('id', '>', 0)->update(['status' => 'pending', 'user_id' => $user->id]);
$updatedC = App\Models\Claim::where('id', '>', 0)->update(['status' => 'pending', 'user_id' => $user->id]);

echo "Updated $updatedQ queries and $updatedC claims to pending for User ID {$user->id}.\n";

$pendingQ = $user->queries()->where('status', 'pending')->count();
$pendingC = $user->claims()->where('status', 'pending')->count();

echo "User has $pendingQ pending queries and $pendingC pending claims now.\n";
