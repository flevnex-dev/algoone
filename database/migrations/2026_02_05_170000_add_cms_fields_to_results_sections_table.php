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
            $table->text('banner_text')->nullable()->after('id'); // For top banner
            
            // Hero CTA
            $table->string('primary_cta_text')->nullable()->after('disclaimer');
            $table->string('primary_cta_link')->nullable()->after('primary_cta_text');

            // Final CTA (Bottom)
            $table->string('final_cta_title')->nullable();
            $table->text('final_cta_description')->nullable();
            $table->string('final_cta_btn_text')->nullable();
            $table->string('final_cta_btn_link')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('results_sections', function (Blueprint $table) {
            $table->dropColumn([
                'banner_text',
                'primary_cta_text',
                'primary_cta_link',
                'final_cta_title',
                'final_cta_description',
                'final_cta_btn_text',
                'final_cta_btn_link'
            ]);
        });
    }
};
