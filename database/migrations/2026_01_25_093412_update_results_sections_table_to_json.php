<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('results_sections', function (Blueprint $table) {
            $table->json('accounts')->nullable()->after('payout_link');
        });

        // Migrate existing data
        $result = DB::table('results_sections')->first();
        if ($result) {
            $accounts = [];
            for ($i = 1; $i <= 3; $i++) {
                if (!empty($result->{"acc{$i}_name"})) {
                    // Helper to safely decode stringified json or return null
                    $getJson = function($val) {
                        return !empty($val) ? json_decode($val, true) : null;
                    };

                    $accounts[] = [
                        'name' => $result->{"acc{$i}_name"},
                        'subtext' => $result->{"acc{$i}_subtext"},
                        'total_gain' => $result->{"acc{$i}_total_gain"},
                        'balance' => $result->{"acc{$i}_balance"},
                        'daily' => $result->{"acc{$i}_daily"},
                        'monthly' => $result->{"acc{$i}_monthly"},
                        'drawdown' => $result->{"acc{$i}_drawdown"},
                        'profit' => $result->{"acc{$i}_profit"},
                        'deposits' => $result->{"acc{$i}_deposits"},
                        'platform' => $result->{"acc{$i}_platform"},
                        'chart_labels' => $getJson($result->{"acc{$i}_chart_labels"}),
                        'chart_data' => $getJson($result->{"acc{$i}_chart_data"}),
                    ];
                }
            }
            
            if (!empty($accounts)) {
                DB::table('results_sections')
                    ->where('id', $result->id)
                    ->update(['accounts' => json_encode($accounts)]);
            }
        }

        Schema::table('results_sections', function (Blueprint $table) {
            $columns = [];
            for ($i = 1; $i <= 3; $i++) {
                $columns = array_merge($columns, [
                    "acc{$i}_name", "acc{$i}_subtext", "acc{$i}_total_gain", 
                    "acc{$i}_balance", "acc{$i}_daily", "acc{$i}_monthly", 
                    "acc{$i}_drawdown", "acc{$i}_profit", "acc{$i}_deposits", 
                    "acc{$i}_platform", "acc{$i}_chart_labels", "acc{$i}_chart_data"
                ]);
            }
            $table->dropColumn($columns);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('results_sections', function (Blueprint $table) {
             for ($i = 1; $i <= 3; $i++) {
                $table->string("acc{$i}_name")->nullable();
                $table->string("acc{$i}_subtext")->nullable();
                $table->string("acc{$i}_total_gain")->nullable();
                $table->string("acc{$i}_balance")->nullable();
                $table->string("acc{$i}_daily")->nullable();
                $table->string("acc{$i}_monthly")->nullable();
                $table->string("acc{$i}_drawdown")->nullable();
                $table->string("acc{$i}_profit")->nullable();
                $table->string("acc{$i}_deposits")->nullable();
                $table->string("acc{$i}_platform")->nullable();
                $table->text("acc{$i}_chart_labels")->nullable();
                $table->text("acc{$i}_chart_data")->nullable();
            }
            $table->dropColumn('accounts');
        });
    }
};
