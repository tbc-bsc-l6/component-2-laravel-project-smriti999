<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'user_role_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Role relationship
    public function role()
    {
        return $this->belongsTo(Role::class, 'user_role_id');
    }
     public function student()
    {
        return $this->hasOne(Student::class);
    }

    public function teacher()
    {
        return $this->hasOne(Teacher::class);
    }

    public function modules()
    {
        return $this->belongsToMany(Module::class, 'module_student')
            ->withPivot('enrolled_at','status','completed_at')
            ->withTimestamps();
    }
}
