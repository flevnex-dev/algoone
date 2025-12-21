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
        Schema::create('progress_guidelines', function (Blueprint $table) {
            $table->id();
            $table->string('title')->default('Important Information');
            $table->string('subtitle')->nullable();
            $table->text('warning_text')->nullable();
            
            // Guidelines (1-7)
            $table->string('guideline1_title')->nullable();
            $table->text('guideline1_text')->nullable();
            $table->string('guideline2_title')->nullable();
            $table->text('guideline2_text')->nullable();
            $table->string('guideline3_title')->nullable();
            $table->text('guideline3_text')->nullable();
            $table->string('guideline4_title')->nullable();
            $table->text('guideline4_text')->nullable();
            $table->string('guideline5_title')->nullable();
            $table->text('guideline5_text')->nullable();
            $table->string('guideline6_title')->nullable();
            $table->text('guideline6_text')->nullable();
            $table->string('guideline7_title')->nullable();
            $table->text('guideline7_text')->nullable();
            
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progress_guidelines');
    }
};
