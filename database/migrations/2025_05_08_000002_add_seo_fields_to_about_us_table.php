<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('about_us', function (Blueprint $table) {
            if (!Schema::hasColumn('about_us', 'seo_title')) {
                $table->string('seo_title')->nullable()->after('additional_description');
            }
            if (!Schema::hasColumn('about_us', 'seo_description')) {
                $table->text('seo_description')->nullable()->after('seo_title');
            }
        });
    }

    public function down(): void
    {
        Schema::table('about_us', function (Blueprint $table) {
            $table->dropColumn(['seo_title', 'seo_description']);
        });
    }
};