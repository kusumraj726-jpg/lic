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
        Schema::table('system_updates', function (Blueprint $table) {
            $table->string('title')->after('id');
            $table->text('content')->after('title');
            $table->string('version')->nullable()->after('content');
            $table->string('type')->default('security')->after('version');
            $table->boolean('is_active')->default(true)->after('type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('system_updates', function (Blueprint $table) {
            $table->dropColumn(['title', 'content', 'version', 'type', 'is_active']);
        });
    }
};
