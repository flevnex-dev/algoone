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
        Schema::create('past_performance_sections', function (Blueprint $table) {
            $table->id();
            
            // Section 1: Transparency in Trading
            $table->string('transparency_title')->nullable();
            $table->text('transparency_text')->nullable();
            $table->string('view_reports_text')->nullable();
            
            // Section 2: Week Overview
            $table->string('overview_title')->nullable();
            $table->text('overview_text')->nullable();
            
            // Section 3: Outlook for Next Week
            $table->string('outlook_title')->nullable();
            $table->text('outlook_text')->nullable();
            $table->string('next_update_label')->nullable();
            $table->text('next_update_text')->nullable();
            $table->string('notice_label')->nullable();
            $table->text('notice_text')->nullable();
            
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('past_performance_sections');
    }
};
