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
            $table->boolean('access_clients')->default(true);
            $table->boolean('access_queries')->default(true);
            $table->boolean('access_claims')->default(true);
            $table->boolean('access_renewals')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('staff', function (Blueprint $table) {
            $table->dropColumn(['access_clients', 'access_queries', 'access_claims', 'access_renewals']);
        });
    }
};
