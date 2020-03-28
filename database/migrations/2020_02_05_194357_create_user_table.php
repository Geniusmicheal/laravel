<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->bigIncrements('user_id');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('img')->nullable(); 
            $table->string('occupation')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('social_media')->nullable();
            $table->string('current_location')->nullable();
            $table->string('dob')->nullable();
            $table->text('about')->nullable();
            // $table->integer('remember_token');
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
        Schema::dropIfExists('user');
    }
}
