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
        Schema::create('result_items', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // testimonial, stream, proof
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->string('media_url'); // Youtube URL or Image URL
            $table->string('thumbnail_url')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('result_items');
    }
};
