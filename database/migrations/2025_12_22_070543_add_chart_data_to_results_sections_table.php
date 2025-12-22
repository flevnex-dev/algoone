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
        Schema::table('results_sections', function (Blueprint $table) {
            $table->json('acc1_chart_labels')->nullable()->after('acc1_platform');
            $table->json('acc1_chart_data')->nullable()->after('acc1_chart_labels');
            $table->json('acc2_chart_labels')->nullable()->after('acc2_platform');
            $table->json('acc2_chart_data')->nullable()->after('acc2_chart_labels');
            $table->json('acc3_chart_labels')->nullable()->after('acc3_platform');
            $table->json('acc3_chart_data')->nullable()->after('acc3_chart_labels');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('results_sections', function (Blueprint $table) {
            $table->dropColumn([
                'acc1_chart_labels',
                'acc1_chart_data',
                'acc2_chart_labels',
                'acc2_chart_data',
                'acc3_chart_labels',
                'acc3_chart_data',
            ]);
        });
    }
};
