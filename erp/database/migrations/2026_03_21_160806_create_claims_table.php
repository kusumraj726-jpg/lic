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
        Schema::create('claims', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // advisor_id
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->string('policy_number');
            $table->string('policy_type');
            $table->decimal('claim_amount', 15, 2);
            $table->date('incident_date');
            $table->string('status')->default('submitted'); // submitted, pending, approved, rejected
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('claims');
    }
};
