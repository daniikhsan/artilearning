<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AnswerOption;
use App\Models\QuestionCategory;

class QuestionExam extends Model
{
    use HasFactory;
    protected $table = 'question_exam';
    protected $guarded = ['id'];

    public function answer_options(){
        return $this->hasMany(AnswerOption::class);
    }
    
    public function question_category(){
        return $this->belongsTo(QuestionCategory::class);
    }
}
