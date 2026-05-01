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
            $table->index('dob');
            $table->index('marriage_anniversary');
        });

        Schema::table('renewals', function (Blueprint $table) {
            $table->index(['status', 'expiry_date']);
        });

        Schema::table('queries', function (Blueprint $table) {
            $table->index(['status', 'priority']);
        });

        Schema::table('claims', function (Blueprint $table) {
            $table->index('status');
        });

        Schema::table('commissions', function (Blueprint $table) {
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropIndex(['dob']);
            $table->dropIndex(['marriage_anniversary']);
        });

        Schema::table('renewals', function (Blueprint $table) {
            $table->dropIndex(['status', 'expiry_date']);
        });

        Schema::table('queries', function (Blueprint $table) {
            $table->dropIndex(['status', 'priority']);
        });

        Schema::table('claims', function (Blueprint $table) {
            $table->dropIndex(['status']);
        });

        Schema::table('commissions', function (Blueprint $table) {
            $table->dropIndex(['status']);
        });
    }
};
