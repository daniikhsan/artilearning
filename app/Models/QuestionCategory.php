<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Exam;

class QuestionCategory extends Model
{
    use HasFactory;
    protected $table = 'question_category';
    protected $guarded = ['id'];

    public function exam(){
        return $this->belongsTo(Exam::class);
    }
}
