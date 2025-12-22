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
        Schema::create('week_performance_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trading_week_id')->constrained()->onDelete('cascade');
            
            // Performance Stats
            $table->decimal('total_gain', 8, 2);
            $table->decimal('trade_accuracy', 5, 2)->nullable(); // 83%
            $table->decimal('risk_reward_ratio', 5, 2)->nullable(); // 2.2
            $table->decimal('largest_drawdown', 8, 2)->nullable(); // -1.4%
            
            // Chart Data (JSON)
            $table->json('chart_labels')->nullable(); // ["Monday", "Tuesday", ...]
            $table->json('chart_data')->nullable(); // [0, 0.7, 1.2, 2.3, 2.98]
            
            // Daily Performance (JSON)
            $table->json('daily_performance')->nullable(); // [
            //   {"day": "Monday", "change": "+1.13%", "equity": "$101,130"},
            //   {"day": "Tuesday", "change": "+1.04%", "equity": "$102,181.75"},
            //   ...
            // ]
            
            // Markets Traded (JSON)
            $table->json('markets_traded')->nullable(); // [
            //   {"market": "XAUUSD", "volume_percentage": 55},
            //   {"market": "GBPUSD", "volume_percentage": 27},
            //   {"market": "EURUSD", "volume_percentage": 18}
            // ]
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('week_performance_details');
    }
};
