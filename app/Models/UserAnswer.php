<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserExam;
use App\Models\QuestionExam;
use App\Models\AnswerOption;

class UserAnswer extends Model
{
    use HasFactory;
    protected $table = 'user_answer';
    protected $guarded = ['id'];

    public function user_exam(){
        return $this->belongsTo(UserExam::class);
    }

    public function question_exam(){
        return $this->belongsTo(QuestionExam::class);
    }

    public function user_answer_option(){
        return $this->belongsTo(AnswerOption::class);
    }
}
