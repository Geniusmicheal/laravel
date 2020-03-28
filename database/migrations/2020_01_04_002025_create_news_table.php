<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->bigIncrements('news_id');
            $table->string('headline');
            $table->string('slug')->unique();
            $table->integer('category_id');
            $table->integer('location_id');
            $table->string('source_url')->nullable();
            $table->string('source');
            $table->text('short_content');
            $table->text('content');
            $table->string('newsImage');
            $table->string('download_url')->nullable();
            $table->integer('post_id');
            $table->integer('home');
            $table->timestamp('deleted_at')->nullable(); 
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
}
