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
        Schema::create('masterclass_sections', function (Blueprint $table) {
            $table->id();
            $table->string('course_title')->default('Masterclass Trading Course');
            $table->text('course_subtitle')->nullable();
            $table->string('cta_button_text')->nullable();
            $table->string('cta_button_link')->nullable();
            $table->json('modules')->nullable(); // Store modules as JSON: [{"title": "Module 1", "video_url": "...", "status": "pending|completed"}]
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('masterclass_sections');
    }
};
