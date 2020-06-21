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
            $table->text('docx_file')->nullable();
            $table->text('pdf_file')->nullable();
            $table->text('header_title')->nullable();
            $table->string('duration')->nullable();
            $table->string('total_marks')->nullable();
            $table->string('daytime')->nullable();
            $table->timestamp('exam_date')->nullable();
            $table->integer('questions_count')->nullable();
            $table->integer('pages_count')->nullable();
            $table->text('header_instructions')->nullable();
            $table->string('type')->nullable();
            $table->integer('user_id')->unsigned()->nullable();
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
