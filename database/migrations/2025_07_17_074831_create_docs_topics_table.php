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
        Schema::create('docs_topics', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->string('content');
            $table->string('video_url')->nullable();
            $table->string('file_path')->nullable();
            $table->foreignId('category_id')->constrained('docs_categories')->onDelete('cascade');
            $table->foreignId('sub_category_id')->constrained('docs_sub_categories')->onDelete('cascade');
            $table->foreignId('sub_sub_category_id')->constrained('docs_sub_sub_categories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('docs_topics');
    }
};
