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
        // Add JSON column
        Schema::table('progress_guidelines', function (Blueprint $table) {
            $table->json('guidelines')->nullable()->after('warning_text');
        });

        // Migrate existing data
        $guidelines = DB::table('progress_guidelines')->get();
        foreach ($guidelines as $guideline) {
            $newGuidelines = [];
            for ($i = 1; $i <= 7; $i++) {
                $titleKey = "guideline{$i}_title";
                $textKey = "guideline{$i}_text";
                
                if (!empty($guideline->$titleKey) || !empty($guideline->$textKey)) {
                    $newGuidelines[] = [
                        'title' => $guideline->$titleKey,
                        'text' => $guideline->$textKey
                    ];
                }
            }
            
            DB::table('progress_guidelines')
                ->where('id', $guideline->id)
                ->update(['guidelines' => json_encode($newGuidelines)]);
        }

        // Drop old columns
        Schema::table('progress_guidelines', function (Blueprint $table) {
            $table->dropColumn([
                'guideline1_title', 'guideline1_text',
                'guideline2_title', 'guideline2_text',
                'guideline3_title', 'guideline3_text',
                'guideline4_title', 'guideline4_text',
                'guideline5_title', 'guideline5_text',
                'guideline6_title', 'guideline6_text',
                'guideline7_title', 'guideline7_text',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('progress_guidelines', function (Blueprint $table) {
            // Re-add columns
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
        });

        // Restore data from JSON
        $guidelines = DB::table('progress_guidelines')->get();
        foreach ($guidelines as $guideline) {
            $data = json_decode($guideline->guidelines, true);
            $updateData = [];
           
            if (is_array($data)) {
                 foreach ($data as $index => $item) {
                    $i = $index + 1;
                    if ($i <= 7) {
                        $updateData["guideline{$i}_title"] = $item['title'] ?? null;
                        $updateData["guideline{$i}_text"] = $item['text'] ?? null;
                    }
                }
            }

            if (!empty($updateData)) {
                DB::table('progress_guidelines')
                    ->where('id', $guideline->id)
                    ->update($updateData);
            }
        }
        
        Schema::table('progress_guidelines', function (Blueprint $table) {
             $table->dropColumn('guidelines');
        });
    }
};
