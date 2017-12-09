<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNgeblogPostMetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ngeblog_post_metas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('blog_id')->index()->unsigned();
            $table->string('meta_key');
            $table->longText('meta_value');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ngeblog_post_metas');
    }
}
