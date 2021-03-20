<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * run the migrations
     * 
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);
            $table->string('email', 100)->unique('email_unique');
            $table->string('password', 100);

            $table->timestamps();
        });
    }
    /**
     * reverse the migrations.
     * 
     * 
     * @return void
     */

    public function down()
    {
        Schema::dropIfExists('users');
    }
}