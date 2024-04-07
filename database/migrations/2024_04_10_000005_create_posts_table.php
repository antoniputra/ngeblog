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
            $table->timestamp('first_published_at')->nullable();
            $table->timestamp('publish_schedule_at')->nullable();
            $table->text('description')->nullable();
            $table->longText('content');
            $table->timestamps();
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
