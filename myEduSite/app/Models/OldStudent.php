<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Models\Module;

class OldStudent extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['user_id','name','email','password'];
    protected $hidden = ['password','remember_token'];

    // Pivot relationship with completed modules
    public function modules()
    {
        return $this->belongsToMany(
            Module::class,
            'module_old_student',
            'old_student_id',
            'module_id'
        )
        ->withPivot(['status','enrolled_at','completed_at'])
        ->withTimestamps();
    }

    // Only passed/failed modules
    public function completedModules()
    {
        return $this->modules()->wherePivotIn('status', ['passed', 'failed']);
    }
}
