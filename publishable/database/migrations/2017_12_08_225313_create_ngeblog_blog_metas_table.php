<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNgeblogBlogMetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ngeblog_blog_metas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('meta_id')->index()->unsigned();
            $table->integer('blog_id')->index()->unsigned();
            $table->integer('order')->default(0);
            $table->longText('meta_field')->nullable();
            $table->longText('meta_key')->nullable();
            $table->longText('meta_value')->nullable();

            // constraint
            $table->foreign('meta_id')
                ->references('id')->on('ngeblog_metas')
                ->onDelete('cascade');

            $table->foreign('blog_id')
                ->references('id')->on('ngeblog_blogs')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ngeblog_blog_metas');
    }
}
