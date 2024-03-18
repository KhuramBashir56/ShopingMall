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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('title', 48)->unique();
            $table->string('thumbnail', 255);
            $table->text('description', 500);
            $table->string('slug', 48)->unique();
            $table->string('meta_keywords', 255);
            $table->string('meta_description', 160);
            $table->enum('status', ['published', 'unpublished', 'deleted'])->default('unpublished');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cagetories');
    }
};