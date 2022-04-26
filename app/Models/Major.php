<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function users(){
        return $this->hasMany(User::class);
    }

    public function department(){
        return $this->belongsTo(Department::class);
    }
}
