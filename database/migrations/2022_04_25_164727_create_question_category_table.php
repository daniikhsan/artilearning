<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_category', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exam_id');
            $table->string('name');
            $table->timestamps();

            $table->foreign('exam_id')
                ->references('id')
                ->on('exams')
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
        Schema::dropIfExists('question_category');
    }
}
