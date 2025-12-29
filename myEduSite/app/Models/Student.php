<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Authenticatable
{
    use HasFactory;

    protected $fillable = ['user_id','name', 'email', 'password'];

     public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function modules() {
        return $this->belongsToMany(Module::class, 'module_student', 'student_id', 'module_id')
                    ->withPivot('pass_status','enrolled_at','completed_at')
                    ->withTimestamps();
    }
}

