<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== ALL QUERIES ===\n";
$queries = App\Models\Query::all(['id','user_id','status','subject']);
foreach ($queries as $q) {
    echo "  id:{$q->id} user_id:{$q->user_id} status:{$q->status} subject:{$q->subject}\n";
}

echo "\n=== ALL CLAIMS ===\n";
$claims = App\Models\Claim::all(['id','user_id','status']);
foreach ($claims as $c) {
    echo "  id:{$c->id} user_id:{$c->user_id} status:{$c->status}\n";
}

echo "\n=== ALL USERS ===\n";
$users = App\Models\User::all(['id','name','email']);
foreach ($users as $u) {
    echo "  id:{$u->id} name:{$u->name}\n";
}
