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
        Schema::create('myfxbook_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('account_number')->nullable();
            $table->string('account_name')->nullable();
            $table->string('risk_label')->nullable();
            $table->text('description')->nullable();
            $table->string('total_gain')->nullable();
            $table->string('monthly')->nullable();
            $table->string('drawdown')->nullable();
            $table->string('balance')->nullable();
            $table->string('myfxbook_link')->nullable();
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
        Schema::dropIfExists('myfxbook_accounts');
    }
};
