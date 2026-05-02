<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

echo "--- Diagnostic Report for " . basename(getcwd()) . " ---\n";
echo "DB Connection: " . config('database.default') . "\n";
echo "Database Name: " . DB::connection()->getDatabaseName() . "\n";
echo "Session Driver: " . config('session.driver') . "\n";
echo "Session Domain: " . config('session.domain') . "\n";
echo "Session Cookie: " . config('session.cookie') . "\n";
echo "App Key: " . config('app.key') . "\n";

if (Schema::hasTable('sessions')) {
    $count = DB::table('sessions')->count();
    echo "Sessions Table: Found ($count records)\n";
    $last = DB::table('sessions')->orderBy('last_activity', 'desc')->first();
    if ($last) {
        echo "Last Activity: " . date('Y-m-d H:i:s', $last->last_activity) . "\n";
    }
} else {
    echo "Sessions Table: NOT FOUND!\n";
}

echo "---------------------------------\n";
