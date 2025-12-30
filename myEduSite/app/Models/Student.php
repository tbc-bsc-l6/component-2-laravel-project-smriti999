<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['user_id', 'name', 'email', 'password'];
    protected $hidden = ['password', 'remember_token'];

    public function modules()
{
    return $this->belongsToMany(Module::class, 'module_student')
        ->withPivot('pass_status', 'enrolled_at', 'completed_at')
        ->withTimestamps();
}

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

