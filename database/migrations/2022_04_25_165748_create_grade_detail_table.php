<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradeDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grade_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('grade_id');
            $table->unsignedBigInteger('user_answer_id');
            $table->unsignedBigInteger('category_id');
            $table->integer('correct_answer');
            $table->integer('total_question');
            $table->float('score');
            $table->timestamps();

            $table->foreign('grade_id')
                ->references('id')
                ->on('grades')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('user_answer_id')
                ->references('id')
                ->on('user_answer')
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
        Schema::dropIfExists('grade_detail');
    }
}
