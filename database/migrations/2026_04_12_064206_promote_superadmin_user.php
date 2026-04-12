<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Promote your account to superadmin with a permanent active subscription
        DB::table('users')
            ->where('email', 'mcauxstain@gmail.com')
            ->update([
                'role'                 => 'superadmin',
                'subscription_status'  => 'active',
                'subscription_plan'    => 'superadmin',
                'subscription_ends_at' => now()->addYears(99),
            ]);
    }

    public function down(): void
    {
        DB::table('users')
            ->where('email', 'mcauxstain@gmail.com')
            ->update(['role' => 'admin']);
    }
};
