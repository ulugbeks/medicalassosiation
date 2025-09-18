<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UpdateServicesTableForTranslations extends Migration
{
    public function up()
    {
        // First, get existing data
        $services = DB::table('services')->get();
        
        // Add temporary columns
        Schema::table('services', function (Blueprint $table) {
            $table->json('title_json')->nullable();
            $table->json('description_json')->nullable();
            $table->json('content_json')->nullable();
        });
        
        // Convert existing data to JSON format
        foreach ($services as $service) {
            $defaultLocale = config('app.locale', 'en');
            
            DB::table('services')
                ->where('id', $service->id)
                ->update([
                    'title_json' => json_encode([$defaultLocale => $service->title]),
                    'description_json' => json_encode([$defaultLocale => $service->description]),
                    'content_json' => json_encode([$defaultLocale => $service->content]),
                ]);
        }
        
        // Drop original columns
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn(['title', 'description', 'content']);
        });
        
        // Rename JSON columns to original names
        Schema::table('services', function (Blueprint $table) {
            $table->renameColumn('title_json', 'title');
            $table->renameColumn('description_json', 'description');
            $table->renameColumn('content_json', 'content');
        });
    }

    public function down()
    {
        // Simplified down method - you might want to enhance this
        Schema::table('services', function (Blueprint $table) {
            $table->string('title')->change();
            $table->text('description')->change();
            $table->text('content')->change();
        });
    }
}