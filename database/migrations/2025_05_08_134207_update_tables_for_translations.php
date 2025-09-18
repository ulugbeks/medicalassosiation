<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UpdateTablesForTranslations extends Migration
{
    protected $tables = [
        'sliders' => [
            'title',
            'subtitle',
            'description',
            'primary_button_text',
            'secondary_button_text'
        ],
        'about' => [
            'title',
            'subtitle',
            'description',
            'doctor_name',
            'doctor_title',
            'second_section_subtitle',
            'second_section_title',
            'second_section_description',
            'second_section_feature1_title',
            'second_section_feature1_description',
            'second_section_feature2_title',
            'second_section_feature2_description'
        ],
        'posts' => [
            'title',
            'seo_title',
            'seo_description',
            'excerpt',
            'content',
            'author_name'
        ],
        'categories' => [
            'name',
            'description'
        ],
        'services' => [
            'title',
            'description',
            'content'
        ],
    ];

    public function up()
    {
        $defaultLocale = config('app.locale', 'en');

        foreach ($this->tables as $tableName => $columns) {
            if (!Schema::hasTable($tableName)) {
                continue; // Skip if table doesn't exist
            }

            // Check if any columns need to be converted
            $columnsToConvert = [];
            foreach ($columns as $column) {
                if (Schema::hasColumn($tableName, $column)) {
                    $columnsToConvert[] = $column;
                }
            }

            if (empty($columnsToConvert)) {
                continue; // Skip if no columns to convert
            }

            // Get all rows
            $rows = DB::table($tableName)->get();
            
            // Create backup table
            $backupTable = "{$tableName}_backup_" . time();
            DB::statement("CREATE TABLE {$backupTable} LIKE {$tableName}");
            DB::statement("INSERT INTO {$backupTable} SELECT * FROM {$tableName}");
            
            // Process each column one by one
            foreach ($columnsToConvert as $column) {
                try {
                    // Create temporary column
                    $tempColumn = "_temp_{$column}_json";
                    
                    // Check if temp column already exists and drop it if it does
                    if (Schema::hasColumn($tableName, $tempColumn)) {
                        Schema::table($tableName, function (Blueprint $table) use ($tempColumn) {
                            $table->dropColumn($tempColumn);
                        });
                    }
                    
                    // Add temp column
                    Schema::table($tableName, function (Blueprint $table) use ($tempColumn) {
                        $table->json($tempColumn)->nullable();
                    });
                    
                    // Copy data to temp column
                    foreach ($rows as $row) {
                        $originalValue = $row->{$column};
                        $jsonValue = json_encode([$defaultLocale => $originalValue]);
                        
                        DB::table($tableName)
                            ->where('id', $row->id)
                            ->update([$tempColumn => $jsonValue]);
                    }
                    
                    // Drop original column
                    Schema::table($tableName, function (Blueprint $table) use ($column) {
                        $table->dropColumn($column);
                    });
                    
                    // Create new column with original name
                    Schema::table($tableName, function (Blueprint $table) use ($column) {
                        $table->json($column)->nullable();
                    });
                    
                    // Copy data from temp to new column
                    DB::statement("UPDATE {$tableName} SET {$column} = {$tempColumn}");
                    
                    // Drop temp column
                    Schema::table($tableName, function (Blueprint $table) use ($tempColumn) {
                        $table->dropColumn($tempColumn);
                    });
                    
                } catch (\Exception $e) {
                    // If anything fails, just continue to the next column
                    continue;
                }
            }
        }
    }

    public function down()
    {
        // NOTE: For a down migration, you would typically
        // restore from backup tables, but this is a destructive
        // migration so it's best not to automatically roll back.
        // If a backup is needed, it's in the backup tables created
        // during the up migration.
    }
}