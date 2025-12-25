<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = ['name', 'email'];

    public function modules()
    {
        return $this->belongsToMany(Module::class, 'module_teacher');
    }
}

