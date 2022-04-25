<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAnswerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_answer', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_exam_id');
            $table->unsignedBigInteger('answer_option_id');
            $table->unsignedBigInteger('question_exam_id');
            $table->integer('score');
            $table->timestamps();

            $table->foreign('user_exam_id')
                ->references('id')
                ->on('user_exam')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('question_exam_id')
                ->references('id')
                ->on('question_exam')
                ->onUpdate('cascade')
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
        Schema::dropIfExists('user_answer');
    }
}
