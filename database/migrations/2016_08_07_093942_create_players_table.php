<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::create('players', function (Blueprint $table) {
             $table->increments('id');
             $table->string('password', 60);
             $table->string('username');
             $table->string('firstname');
             $table->string('lastname');
             $table->string('email')->unique();
             $table->string('currency');
             $table->integer('balance')->default(0);
             $table->integer('opuser_id');
             $table->rememberToken();
             $table->timestamps();
         });
     }

     /**
      * Reverse the migrations.
      *
      * @return void
      */
     public function down()
     {
         Schema::drop('players');
     }
}
