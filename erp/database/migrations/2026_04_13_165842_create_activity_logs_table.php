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
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('context_id')->constrained('users')->onDelete('cascade'); // Tenant Context
            $table->string('action'); // created, updated, deleted, restored, login
            $table->string('target_type')->nullable(); // Model name
            $table->unsignedBigInteger('target_id')->nullable(); // Model ID
            $table->text('description')->nullable();
            $table->json('metadata')->nullable(); // Old/New values
            $table->string('ip_address')->nullable();
            $table->timestamps();
            
            $table->index(['context_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
