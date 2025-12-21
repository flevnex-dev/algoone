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
        Schema::create('privacy_policy_sections', function (Blueprint $table) {
            $table->id();
            $table->string('page_title')->nullable();
            $table->string('last_updated')->nullable();
            $table->json('sections')->nullable(); // Store all sections as JSON
            $table->string('contact_email')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('privacy_policy_sections');
    }
};
