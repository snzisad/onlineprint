<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrderSequence extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
           Schema::create('order_sequence', function (Blueprint $table) {
               $table->bigIncrements('id');
               $table->unsignedBigInteger('user_id');
               $table->unsignedBigInteger('total_page');
               $table->double('price');
               $table->timestamps();

               $table->foreign('user_id')
                       ->references('id')
                       ->on('users')
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
         Schema::dropIfExists('order_sequence');
     }
}
