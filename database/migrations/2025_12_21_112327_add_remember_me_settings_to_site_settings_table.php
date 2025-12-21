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
        Schema::table('site_settings', function (Blueprint $table) {
            $table->boolean('remember_me_enabled')->default(true)->after('smtp_security');
            $table->string('remember_me_text')->nullable()->default('Remember me')->after('remember_me_enabled');
            $table->integer('remember_me_duration_days')->default(30)->after('remember_me_text'); // Duration in days
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn([
                'remember_me_enabled',
                'remember_me_text',
                'remember_me_duration_days',
            ]);
        });
    }
};
