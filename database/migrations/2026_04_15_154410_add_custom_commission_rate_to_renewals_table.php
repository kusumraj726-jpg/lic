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
        Schema::table('renewals', function (Blueprint $table) {
            $table->decimal('custom_commission_rate', 5, 2)->nullable()->after('premium_amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('renewals', function (Blueprint $table) {
            //
        });
    }
};
