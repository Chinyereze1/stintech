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
        Schema::create('projects', function (Blueprint $table) {
        $table->id();
        $table->foreignId('category_id')->constrained()->onDelete('cascade');
        $table->string('title');
        $table->string('slug')->unique();
        $table->string('thumbnail'); // The main image
        $table->string('layout_type')->default('screenshot'); // 'screenshot' or 'case_study'
        $table->text('short_description')->nullable();
        $table->longText('content')->nullable(); // For Case Studies
        $table->string('video_url')->nullable(); // For Video Explainers
        $table->string('live_url')->nullable(); 
        $table->string('github_url')->nullable();
        $table->json('tools')->nullable(); // To store tags like [PHP, Laravel]
        $table->boolean('is_featured')->default(false);
        $table->enum('status', ['draft', 'published'])->default('draft');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
