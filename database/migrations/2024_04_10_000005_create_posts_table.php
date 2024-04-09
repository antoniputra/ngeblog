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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id')->nullable();
            $table->string('title');
            $table->string('slug')->unique();
            $table->boolean('is_visible')->default(false);
            $table->enum('editor_type', ['markdown', 'richtext'])->default('markdown');
            $table->string('cover_image_path')->nullable();
            $table->timestamp('first_published_at')->nullable();
            $table->timestamp('schedule_publish_at')->nullable();
            $table->text('description')->nullable();
            $table->longText('content');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
