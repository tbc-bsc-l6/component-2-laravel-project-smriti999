<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relationship: Each user belongs to one role
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function modules()
    {
        return $this->belongsToMany(Module::class, 'module_teacher', 'user_id', 'module_id');
    }

    // Helper: Check if user has a specific role
    public function hasRole(string $roleName): bool
    {
        return $this->role && $this->role->name === $roleName;
    }

    // Helper: Check if user has any of the given roles
    public function hasAnyRole(array $roles): bool
    {
        return $this->role && in_array($this->role->name, $roles);
    }

    // Scope: Get users by role name
    public function scopeOfRole($query, string $roleName)
    {
        return $query->whereHas('role', function ($q) use ($roleName) {
            $q->where('name', $roleName);
        });
    }
   public function teacher()
{
    return $this->hasOne(Teacher::class, 'teacher_id');
}


public function isTeacher(): bool
{
    return $this->role->name === 'Teacher';
}


}