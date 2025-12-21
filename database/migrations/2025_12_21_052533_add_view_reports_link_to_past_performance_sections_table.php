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
        Schema::table('past_performance_sections', function (Blueprint $table) {
            $table->string('view_reports_link')->nullable()->after('view_reports_text');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('past_performance_sections', function (Blueprint $table) {
            $table->dropColumn('view_reports_link');
        });
    }
};
