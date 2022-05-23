<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\QuestionCategory;

class GradeDetail extends Model
{
    use HasFactory;
    protected $table = 'grade_detail';
    protected $guarded = ['id'];

    public function category(){
        return $this->belongsTo(QuestionCategory::class);
    }
}
