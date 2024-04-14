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
        Schema::dropIfExists('ngeblog_post_tag');
    }
};
