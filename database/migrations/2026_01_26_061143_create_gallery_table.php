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
        Schema::create('gallery', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('type', ['image', 'video']); // image or video
            $table->enum('category', ['conference', 'clinic', 'awards', 'events', 'other']); // categorize items
            $table->string('file_path')->nullable(); // For images
            $table->string('video_url')->nullable(); // For YouTube/Vimeo videos
            $table->string('thumbnail')->nullable(); // Thumbnail for videos
            $table->integer('order')->default(0); // Display order
            $table->boolean('is_featured')->default(false); // Feature on homepage
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gallery');
    }
};
