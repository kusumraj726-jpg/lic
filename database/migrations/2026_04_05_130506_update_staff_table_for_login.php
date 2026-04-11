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
            $table->renameColumn('user_id', 'advisor_id'); 
            $table->foreignId('staff_user_id')->after('id')->nullable()->constrained('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('staff', function (Blueprint $table) {
            $table->renameColumn('advisor_id', 'user_id');
            $table->dropForeign(['staff_user_id']);
            $table->dropColumn('staff_user_id');
        });
    }
};
