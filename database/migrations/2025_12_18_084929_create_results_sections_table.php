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
        Schema::create('results_sections', function (Blueprint $table) {
            $table->id();
            $table->string('badge_text')->nullable();
            $table->text('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->string('disclaimer')->nullable();
            
            // Acc 1
            $table->string('acc1_name')->nullable();
            $table->string('acc1_subtext')->nullable();
            $table->string('acc1_total_gain')->nullable();
            $table->string('acc1_balance')->nullable();
            $table->string('acc1_daily')->nullable();
            $table->string('acc1_monthly')->nullable();
            $table->string('acc1_drawdown')->nullable();
            $table->string('acc1_profit')->nullable();
            $table->string('acc1_deposits')->nullable();
            $table->string('acc1_platform')->nullable();
            
            // Acc 2
            $table->string('acc2_name')->nullable();
            $table->string('acc2_subtext')->nullable();
            $table->string('acc2_total_gain')->nullable();
            $table->string('acc2_balance')->nullable();
            $table->string('acc2_daily')->nullable();
            $table->string('acc2_monthly')->nullable();
            $table->string('acc2_drawdown')->nullable();
            $table->string('acc2_profit')->nullable();
            $table->string('acc2_deposits')->nullable();
            $table->string('acc2_platform')->nullable();

            // Acc 3
            $table->string('acc3_name')->nullable();
            $table->string('acc3_subtext')->nullable();
            $table->string('acc3_total_gain')->nullable();
            $table->string('acc3_balance')->nullable();
            $table->string('acc3_daily')->nullable();
            $table->string('acc3_monthly')->nullable();
            $table->string('acc3_drawdown')->nullable();
            $table->string('acc3_profit')->nullable();
            $table->string('acc3_deposits')->nullable();
            $table->string('acc3_platform')->nullable();

            // Summary
            $table->text('summary_title')->nullable();
            $table->text('summary_description')->nullable();
            $table->string('view_results_text')->nullable();
            $table->string('view_results_link')->nullable();

            // Buttons
            $table->string('myfxbook_text')->nullable();
            $table->string('myfxbook_link')->nullable();
            $table->string('payout_text')->nullable();
            $table->string('payout_link')->nullable();

            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results_sections');
    }
};
