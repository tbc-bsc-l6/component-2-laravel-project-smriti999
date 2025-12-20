<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
   public function students()
{
    return $this->belongsToMany(User::class)
        ->withPivot('status','completed_at');
}

public function teachers()
{
    return $this->belongsToMany(User::class,'module_teacher','module_id','teacher_id');
}

}
