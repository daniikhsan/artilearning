<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\QuestionCategory;
use App\Models\Course;

class Exam extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function categories(){
        return $this->hasMany(QuestionCategory::class);
    }

    public function course(){
        return $this->belongsTo(Course::class);
    }
}
