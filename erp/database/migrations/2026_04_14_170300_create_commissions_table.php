<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('commissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // advisor/admin id
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->foreignId('renewal_id')->nullable()->constrained()->onDelete('set null');
            $table->string('policy_number');
            $table->string('provider');
            $table->decimal('expected_amount', 15, 2);
            $table->decimal('received_amount', 15, 2)->default(0);
            $table->string('status')->default('pending'); // pending, partial, received
            $table->timestamp('received_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('commissions');
    }
};
