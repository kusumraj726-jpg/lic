<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('staff', function (Blueprint $table) {
            $table->boolean('access_commissions')->default(false)->after('access_renewals');
            $table->boolean('access_trash')->default(false)->after('access_commissions');
            $table->boolean('access_dashboard')->default(true)->after('access_trash');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('staff', function (Blueprint $table) {
            $table->dropColumn(['access_commissions', 'access_trash', 'access_dashboard']);
        });
    }
};
