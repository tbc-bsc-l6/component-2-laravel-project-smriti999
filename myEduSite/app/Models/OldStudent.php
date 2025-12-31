<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OldStudent extends Authenticatable
{
    use HasFactory;

    protected $fillable = ['user_id','name', 'email', 'password'];
    protected $hidden = ['password','remember_token'];

    public function modules()
{
    return $this->belongsToMany(Module::class)
        ->withPivot(['status', 'enrolled_at', 'completed_at'])
        ->withTimestamps();
}

    public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}
}
