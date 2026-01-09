<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Models\Module;

class OldStudent extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'password'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    /**
     * All modules linked to this old student (history)
     */
    public function modules()
    {
        return $this->belongsToMany(
            Module::class,
            'module_old_student', // ✅ correct pivot table
            'old_student_id',     // ✅ correct FK
            'module_id'
        )
        ->withPivot([
            'status',
            'enrolled_at',
            'completed_at'
        ])
        ->withTimestamps();
    }

    /**
     * Only completed modules (passed / failed)
     */
    public function completedModules()
    {
        return $this->modules()
            ->wherePivotIn('status', ['passed', 'failed']);
    }
}
