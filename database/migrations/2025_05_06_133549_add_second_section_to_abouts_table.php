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
        Schema::table('abouts', function (Blueprint $table) {
            $table->string('second_section_subtitle')->nullable();
            $table->string('second_section_title')->nullable();
            $table->text('second_section_description')->nullable();
            $table->integer('second_section_years')->nullable();
            $table->string('second_section_feature1_title')->nullable();
            $table->text('second_section_feature1_description')->nullable();
            $table->string('second_section_feature2_title')->nullable();
            $table->text('second_section_feature2_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('abouts', function (Blueprint $table) {
            $table->dropColumn([
                'second_section_subtitle',
                'second_section_title',
                'second_section_description',
                'second_section_years',
                'second_section_feature1_title',
                'second_section_feature1_description',
                'second_section_feature2_title',
                'second_section_feature2_description',
            ]);
        });
    }
};