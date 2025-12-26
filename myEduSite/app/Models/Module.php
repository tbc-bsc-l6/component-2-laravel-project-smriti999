<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable = ['module'];

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'module_teacher', 'module_id', 'user_id');
    }
}

