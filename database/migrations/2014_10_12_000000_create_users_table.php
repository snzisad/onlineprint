<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    public function up()
    {
        // if(!Schema::hasTable('users')){
            Schema::create('users', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('name');
                $table->string('email', 100)->unique();
                $table->string('phone', 15)->unique();
                $table->integer('verificaton_code')->nullable();
                $table->enum('type', [0,1])->default(0); //0) customer, 1) admin
                $table->enum('status', [0,1])->default(0); //0) not verified, 1) verified
                $table->string('password');
                $table->rememberToken();
                $table->timestamps();
            });
        // }
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
