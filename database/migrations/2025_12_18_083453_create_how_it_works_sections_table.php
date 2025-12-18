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
        Schema::create('how_it_works_sections', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->string('step1_title')->nullable();
            $table->text('step1_description')->nullable();
            $table->string('step1_image')->nullable();
            $table->string('step2_title')->nullable();
            $table->text('step2_description')->nullable();
            $table->string('step2_image')->nullable();
            $table->string('step3_title')->nullable();
            $table->text('step3_description')->nullable();
            $table->string('step3_image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('how_it_works_sections');
    }
};
