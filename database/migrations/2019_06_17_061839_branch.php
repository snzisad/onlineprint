<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Branch extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courier_branch', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('courier_id');
            $table->string('title', 50);

            $table->foreign('courier_id')
                ->references('id')
                ->on('courier')
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
        Schema::dropIfExists('courier_branch');
    }
}
