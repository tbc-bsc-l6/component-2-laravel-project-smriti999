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

    // Modules the student is enrolled in
    public function enrolledModules()
    {
        return $this->belongsToMany(Module::class, 'module_student', 'user_id', 'module_id')
                    ->withPivot('pass_status','enrolled_at','completed_at')
                    ->withTimestamps();
    }
}
