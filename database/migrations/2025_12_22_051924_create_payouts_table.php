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
        Schema::create('payouts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('admin_id')->nullable()->constrained('users')->onDelete('set null');
            $table->decimal('amount', 15, 2);
            $table->string('name')->nullable(); // Display name (can be partial for privacy)
            $table->string('country')->nullable();
            $table->date('payout_date');
            $table->enum('status', ['pending', 'completed', 'cancelled'])->default('completed');
            $table->boolean('is_public')->default(true); // Whether to show on public payout page
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payouts');
    }
};
