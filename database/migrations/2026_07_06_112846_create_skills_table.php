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
        Schema::create('skills', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // PHP, Photoshop, etc.
        $table->string('type')->default('technical'); // technical, creative, soft_skill
        $table->integer('proficiency')->default(80); // 0 to 100
        $table->boolean('show_on_home')->default(false);
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skills');
    }
};
