<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Teacher extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['user_id', 'name', 'email', 'password', 'role_id'];

    protected $hidden = ['password', 'remember_token'];

    // Modules assigned to this teacher
    public function modules()
    {
        return $this->belongsToMany(Module::class, 'module_teacher', 'teacher_id', 'module_id');
    }

    // Optional relation if linked to users table
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
