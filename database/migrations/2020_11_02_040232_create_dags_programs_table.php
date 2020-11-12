<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDagsProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dags_programs', function (Blueprint $table) {
            $table->id();
            $table->string('program_name');

            $table->tinyinteger('status')->default('1');
            $table->timestamps();
            $table->integer('created_by');
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
        Schema::dropIfExists('dags_programs');
    }
}
