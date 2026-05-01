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
        Schema::table('studio_inquiries', function (Blueprint $table) {
            $table->softDeletes();
            $table->text('internal_notes')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('studio_inquiries', function (Blueprint $table) {
            $table->dropSoftDeletes();
            $table->dropColumn('internal_notes');
        });
    }
};
