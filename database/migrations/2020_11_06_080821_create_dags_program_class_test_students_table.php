<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDagsProgramClassTestStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dags_program_class_test_students', function (Blueprint $table) {
            $table->id();
            $table->biginteger('program_course_test_id');
            $table->biginteger('student_id');

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
        Schema::dropIfExists('dags_program_class_test_students');
    }
}
