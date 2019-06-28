<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PrintPayment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('print_payment', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('sequence_id');
            $table->string('account', 20);
            $table->string('trnx_id', 50);
            $table->double('amount');
            $table->enum('method', [0])->default(0); //0) bKash
            $table->timestamps();

            $table->foreign('sequence_id')
                    ->references('id')
                    ->on('order_sequence')
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
        Schema::dropIfExists('print_payment');
    }
}
