<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event', function (Blueprint $table) {
            $table->bigIncrements('event_id');
            $table->string('name');
            $table->integer('category_id');
            $table->integer('location_id');
            $table->string('event_date');
            $table->string('event_time');
            $table->integer('tickets')->nullable(); 
            $table->string('event_type');

            $table->string('banner');
            $table->text('about');
            $table->string('address');
            $table->string('slug');

            $table->string('office');
            $table->string('sponsor_by');
            $table->string('num_phone');
            $table->string('website')->nullable(); 
            $table->string('email');

            $table->string('youtube_url')->nullable(); 
            $table->string('status');
            $table->string('created_by');
            $table->integer('created_id');

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
        Schema::dropIfExists('event');
    }
}
