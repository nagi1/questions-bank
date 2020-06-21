<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExamsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->increments('id');
            $table->text('docx_file');
            $table->text('pdf_file');
            $table->text('header_title');
            $table->string('duration');
            $table->string('total_marks');
            $table->string('daytime');
            $table->timestamp('exam_date');
            $table->integer('questions_count');
            $table->integer('pages_count');
            $table->text('header_instructions');
            $table->string('type');
            $table->integer('user_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('exams');
    }
}
