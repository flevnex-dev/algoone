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
        Schema::create('signal_sections', function (Blueprint $table) {
            $table->id();
            $table->string('badge_text')->nullable();
            $table->text('title')->nullable();
            $table->text('description')->nullable();
            $table->string('win_rate')->nullable();
            $table->string('risk_reward')->nullable();
            $table->string('primary_market')->nullable();
            $table->string('why_different_title')->nullable();
            $table->text('why_different_text')->nullable();
            $table->string('join_button_text')->nullable();
            $table->string('join_button_link')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('signal_sections');
    }
};
