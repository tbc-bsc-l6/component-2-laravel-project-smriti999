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
        return $this->belongsToMany(Student::class, 'module_student', 'module_id', 'student_id')
                    ->withPivot('status', 'enrolled_at', 'completed_at') 
                    ->withTimestamps();
    }


   public function oldStudents()
    {
        return $this->belongsToMany(
            OldStudent::class,    // your OldStudent model
            'module_student',     // pivot table
            'module_id',          // FK for Module
            'student_id'          // FK for OldStudent
        )
        ->withPivot('status','enrolled_at','completed_at')
        ->withTimestamps();
    }

     public function activeStudents()
    {
        return $this->students()->whereNull('module_student.completed_at');
    }
}
