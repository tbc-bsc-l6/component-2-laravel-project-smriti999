<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OldStudent extends Authenticatable
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'password'];

    public function modules() {
        return $this->belongsToMany(Module::class, 'module_old_student', 'old_student_id', 'module_id')
                    ->withPivot('pass_status','enrolled_at','completed_at')
                    ->withTimestamps();
    }
}
