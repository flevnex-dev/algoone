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
        Schema::create('official_myfxbooks_sections', function (Blueprint $table) {
            $table->id();
            
            // Section 1: Verified Badge & Page Title (82-98)
            $table->string('verified_badge_text')->nullable();
            $table->string('page_title')->nullable();
            $table->text('page_subtitle')->nullable();
            
            // Section 2: Introduction (116-127)
            $table->text('intro_text1')->nullable();
            $table->text('intro_text2')->nullable();
            $table->text('disclaimer_note')->nullable();
            
            // Section 3: Call to Action (271-283)
            $table->string('cta_title')->nullable();
            $table->text('cta_text')->nullable();
            $table->string('cta_button_text')->nullable();
            $table->string('cta_button_link')->nullable();
            
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('official_myfxbooks_sections');
    }
};
