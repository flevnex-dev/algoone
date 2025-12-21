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
        Schema::table('myfxbook_accounts', function (Blueprint $table) {
            $table->json('chart_labels')->nullable()->after('myfxbook_link');
            $table->json('chart_data')->nullable()->after('chart_labels');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('myfxbook_accounts', function (Blueprint $table) {
            $table->dropColumn(['chart_labels', 'chart_data']);
        });
    }
};
