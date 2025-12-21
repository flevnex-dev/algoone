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
        Schema::create('buy_funding_sections', function (Blueprint $table) {
            $table->id();
            $table->string('main_title')->nullable();
            $table->text('main_subtitle')->nullable();
            
            // Comparison Card 1
            $table->string('comparison1_small_account_title')->nullable();
            $table->string('comparison1_small_account_profit')->nullable();
            $table->string('comparison1_small_account_label')->nullable();
            $table->string('comparison1_medium_account_title')->nullable();
            $table->string('comparison1_medium_account_profit')->nullable();
            $table->string('comparison1_medium_account_label')->nullable();
            $table->string('comparison1_button_text')->nullable();
            
            // Comparison Card 2
            $table->string('comparison2_medium_account_title')->nullable();
            $table->string('comparison2_medium_account_profit')->nullable();
            $table->string('comparison2_medium_account_label')->nullable();
            $table->string('comparison2_large_account_title')->nullable();
            $table->string('comparison2_large_account_profit')->nullable();
            $table->string('comparison2_large_account_label')->nullable();
            $table->string('comparison2_button_text')->nullable();
            
            // Chart Section
            $table->string('chart_title')->nullable();
            $table->text('chart_subtitle')->nullable();
            $table->text('chart_conclusion')->nullable();
            $table->json('chart_data')->nullable(); // Store chart labels and data points
            
            // CTA Section
            $table->string('cta_title')->nullable();
            $table->text('cta_subtitle')->nullable();
            $table->string('cta_button1_text')->nullable();
            $table->string('cta_button2_text')->nullable();
            $table->string('cta_button2_link')->nullable();
            
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buy_funding_sections');
    }
};
