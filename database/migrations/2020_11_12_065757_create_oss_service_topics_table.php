<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOssServiceTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oss_service_topics', function (Blueprint $table) {
            $table->id();
            $table->tinyinteger('service_type_id');
            $table->string('service_topic_name','100')->unique();
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
        Schema::dropIfExists('oss_service_topics');
    }
}
