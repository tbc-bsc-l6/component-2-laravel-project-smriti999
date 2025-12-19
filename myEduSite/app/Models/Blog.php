<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    
     public function getRouteKeyName(): string
    {
        return 'slug';
    }
    //Mass assignment below
    protected $fillable = ['title','slug','author_name','content','user_id'];

    //protected $guarted = []; //set this to empty array to allow all fields for mass

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
