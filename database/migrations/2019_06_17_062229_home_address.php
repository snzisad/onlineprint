<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HomeAddress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('address_home', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('user_id');
                $table->unsignedBigInteger('division_id');
                $table->unsignedBigInteger('district_id');
                $table->unsignedBigInteger('upazila_id');
                $table->unsignedBigInteger('post_office_id');
                $table->string('others', 150)->nullable();

                $table->foreign('user_id')
                        ->references('id')
                        ->on('users')
                        ->onDelete('cascade');

                $table->foreign('division_id')
                        ->references('id')
                        ->on('division')
                        ->onDelete('cascade');

                $table->foreign('district_id')
                        ->references('id')
                        ->on('district')
                        ->onDelete('cascade');

                $table->foreign('upazila_id')
                        ->references('id')
                        ->on('upazila')
                        ->onDelete('cascade');

                $table->foreign('post_office_id')
                        ->references('id')
                        ->on('post_office')
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
        Schema::dropIfExists('address_home');
    }
}
