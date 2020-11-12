<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_pos', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->uniqid();
            $table->integer('group_id');
            $table->tinyinteger('status')->default('1');
            $table->timestamps();
            $table->integer('created_by')->default('1');
            $table->integer('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_pos');
    }
}
