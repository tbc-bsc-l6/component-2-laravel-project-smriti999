<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable = ['module','is_available'];

    // Teachers assigned
    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'module_teacher', 'module_id', 'teacher_id');
    }

   
public function students()
{
    return $this->belongsToMany(Student::class)
                ->withPivot('status', 'enrolled_at', 'completed_at') // use 'status' instead of 'pass_status'
                ->withTimestamps();
}

    public function oldStudents()
    {
        return $this->belongsToMany(OldStudent::class, 'module_student')
                    ->withPivot('status','enrolled_at','completed_at')
                    ->withTimestamps();
    }

     public function activeStudents()
    {
        return $this->students()->whereNull('module_student.completed_at');
    }
}
