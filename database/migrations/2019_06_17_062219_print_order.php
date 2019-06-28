<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PrintOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('print_order', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('sequence_id');
                $table->unsignedBigInteger('page');
                $table->unsignedBigInteger('set');
                $table->unsignedBigInteger('total_page');
                $table->unsignedBigInteger('color_id');
                $table->unsignedBigInteger('print_type_id');
                $table->unsignedBigInteger('print_side_id');
                $table->unsignedBigInteger('paper_size_id');
                $table->unsignedBigInteger('paper_type_id');
                $table->double('rate');
                $table->double('price');
                $table->enum('status', [0,1,2,3])->default(0); //0) pending, 1) printed, 2) delivered, 3) received
                $table->timestamps();

                $table->foreign('sequence_id')
                        ->references('id')
                        ->on('order_sequence')
                        ->onDelete('cascade');

                $table->foreign('color_id')
                        ->references('id')
                        ->on('print_color')
                        ->onDelete('cascade');

                $table->foreign('print_type_id')
                        ->references('id')
                        ->on('print_type')
                        ->onDelete('cascade');

                $table->foreign('print_side_id')
                        ->references('id')
                        ->on('print_side')
                        ->onDelete('cascade');

                $table->foreign('paper_size_id')
                        ->references('id')
                        ->on('paper_size')
                        ->onDelete('cascade');

                $table->foreign('paper_type_id')
                        ->references('id')
                        ->on('paper_type')
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
        Schema::dropIfExists('print_order');
    }
}
