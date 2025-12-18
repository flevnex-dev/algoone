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
        Schema::table('hero_sections', function (Blueprint $table) {
            $table->string('primary_cta_link')->nullable();
            $table->string('signin_cta_link')->nullable();
            $table->string('myfxbook_link')->nullable();
            $table->string('payout_link')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hero_sections', function (Blueprint $table) {
            $table->dropColumn(['primary_cta_link', 'signin_cta_link', 'myfxbook_link', 'payout_link']);
        });
    }
};
