<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserOnlineStoreGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_online_store_groups', function (Blueprint $table) {
            $table->id();
            $table->string('group_name');
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
        Schema::dropIfExists('user_online_store_groups');
    }
}
