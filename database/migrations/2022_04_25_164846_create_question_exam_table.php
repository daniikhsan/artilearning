<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionExamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_exam', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('question_category_id');
            $table->string('question');
            $table->timestamps();

            $table->foreign('question_category_id')
                ->references('id')
                ->on('question_category')
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
        Schema::dropIfExists('question_exam');
    }
}
