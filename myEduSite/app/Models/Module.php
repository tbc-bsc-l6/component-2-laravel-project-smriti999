<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable = ['module','is_available'];

    // module teacher 
    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'module_teacher', 'module_id', 'teacher_id');
    }

   //for module student
    public function students()
        {
            return $this->belongsToMany(Student::class, 'module_student', 'module_id', 'student_id')
                        ->withPivot('status', 'enrolled_at', 'completed_at') 
                        ->withTimestamps();
        }

    //module old student
    public function oldStudents()
        {
            return $this->belongsToMany(
                OldStudent::class,    
                'module_student',     
                'module_id',          
                'student_id'          
            )
            ->withPivot('status','enrolled_at','completed_at')
            ->withTimestamps();
        }
    
    //for active students
     public function activeStudents()
    {
        return $this->students()->whereNull('module_student.completed_at');
    }
}
