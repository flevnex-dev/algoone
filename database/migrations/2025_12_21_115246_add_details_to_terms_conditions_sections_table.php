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
        Schema::table('terms_conditions_sections', function (Blueprint $table) {
            $table->longText('details')->nullable()->after('last_updated');
            $table->dropColumn('sections');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('terms_conditions_sections', function (Blueprint $table) {
            $table->json('sections')->nullable();
            $table->dropColumn('details');
        });
    }
};
