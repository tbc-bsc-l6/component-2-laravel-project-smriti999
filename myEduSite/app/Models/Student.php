<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Student extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard = 'student';

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'password'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

  public function modules()
    {
        return $this->belongsToMany(Module::class, 'module_student', 'student_id', 'module_id')
                    ->withPivot('status', 'enrolled_at', 'completed_at')
                    ->withTimestamps();
    }

    public function oldModules()
    {
        return $this->belongsToMany(
            Module::class,
            'module_old_student',
            'old_student_id',
            'module_id'
        )
        ->withPivot('status', 'enrolled_at', 'completed_at')
        ->withTimestamps();
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
