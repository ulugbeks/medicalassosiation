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
        Schema::create('section_headings', function (Blueprint $table) {
            $table->id();
            $table->string('section_key')->unique(); // portfolio, blog, etc.
            $table->string('subtitle')->nullable();
            $table->string('title')->nullable();
            $table->string('title_span')->nullable(); // The part of the title that will be in <span> tags
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('section_headings');
    }
};