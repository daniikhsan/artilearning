<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Exam;

class UserExam extends Model
{
    use HasFactory;
    protected $table = 'user_exam';
    protected $guarded = ['id'];

    public function exam(){
        return $this->belongsTo(Exam::class);
    }
}
