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
        Schema::table('clients', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('queries', function (Blueprint $table) {
            $table->softDeletes();
            // Use change() to update the enum/string if needed, but since it's a string we don't strictly need it if we're just adding logical values.
            // However, it's better to be explicit about the new allowed statuses if it were an enum.
            // For now, I'll just leave it as string but note the new statuses: approved, pending, rejected.
        });

        Schema::table('claims', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('renewals', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) { $table->dropSoftDeletes(); });
        Schema::table('queries', function (Blueprint $table) { $table->dropSoftDeletes(); });
        Schema::table('claims', function (Blueprint $table) { $table->dropSoftDeletes(); });
        Schema::table('renewals', function (Blueprint $table) { $table->dropSoftDeletes(); });
    }
};
