<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->bigIncrements('staff_id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('pnumber')->unique();
            $table->string('ptitle');
            $table->string('password');
            $table->string('operation');//active,disable,delete  
            $table->string('avatar')->nullable();
            $table->string('address')->nullable();
            $table->string('role'); //super staff
            $table->string('accessRight');
            $table->rememberToken();
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
