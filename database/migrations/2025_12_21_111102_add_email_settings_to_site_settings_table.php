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
            // Email Settings
            $table->string('email_from_address')->nullable()->after('legal_disclaimer');
            $table->string('email_from_name')->nullable()->after('email_from_address');
            
            // SMTP Settings
            $table->string('smtp_host')->nullable()->after('email_from_name');
            $table->string('smtp_user')->nullable()->after('smtp_host');
            $table->string('smtp_password')->nullable()->after('smtp_user');
            $table->integer('smtp_port')->nullable()->after('smtp_password');
            $table->string('smtp_security')->nullable()->default('SSL')->after('smtp_port'); // SSL or TLS
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn([
                'email_from_address',
                'email_from_name',
                'smtp_host',
                'smtp_user',
                'smtp_password',
                'smtp_port',
                'smtp_security',
            ]);
        });
    }
};
