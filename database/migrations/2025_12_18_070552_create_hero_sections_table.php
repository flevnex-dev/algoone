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
        Schema::create('hero_sections', function (Blueprint $table) {
            $table->id();
            $table->string('badge_text')->nullable();
            $table->text('title')->nullable();
            $table->text('description')->nullable();
            $table->string('rating')->nullable();
            $table->string('traders_count')->nullable();
            $table->string('primary_cta_text')->nullable();
            $table->string('signin_cta_text')->nullable();
            $table->string('myfxbook_text')->nullable();
            $table->string('payout_text')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hero_sections');
    }
};
