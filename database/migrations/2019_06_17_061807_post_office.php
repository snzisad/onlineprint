<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PostOffice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_office', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('upazila_id');
            $table->string('title', 50);

            $table->foreign('upazila_id')
                ->references('id')
                ->on('upazila')
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
        Schema::dropIfExists('post_office');
    }
}
