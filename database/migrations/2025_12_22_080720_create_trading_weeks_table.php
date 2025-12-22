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
        Schema::create('trading_weeks', function (Blueprint $table) {
            $table->id();
            $table->string('week_label')->nullable(); // Auto-generated: "This Week", "Last Week", "Week 1", etc.
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('total_gain', 8, 2); // +2.98%
            $table->decimal('account_size', 15, 2)->default(100000); // $100,000
            $table->string('week_type')->default('normal'); // 'normal', 'current', 'last'
            $table->integer('display_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trading_weeks');
    }
};
