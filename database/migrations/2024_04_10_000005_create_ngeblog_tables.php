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
        Schema::create('ngeblog_posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->boolean('is_visible')->default(false);
            $table->string('content_type')->default('richtext');
            $table->string('cover_image_path')->nullable();
            $table->timestamp('first_published_at')->nullable();
            $table->timestamp('schedule_publish_at')->nullable();
            $table->text('excerpt')->nullable();
            $table->longText('content');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('ngeblog_tags', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->boolean('is_visible')->default(false);
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('ngeblog_post_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained('ngeblog_posts')->cascadeOnDelete();
            $table->foreignId('tag_id')->constrained('ngeblog_tags')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['post_id', 'tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ngeblog_posts');
        Schema::dropIfExists('ngeblog_tags');
        Schema::dropIfExists('ngeblog_post_tag');
    }
};
