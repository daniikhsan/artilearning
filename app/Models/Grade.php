<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\GradeDetail;

class Grade extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function grade_details(){
        return $this->hasMany(GradeDetail::class);
    }
}
