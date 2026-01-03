<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    protected $table = 'user_roles'; // points to your table
    protected $fillable = ['role'];  // matches your column name

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'user_role_id');
    }
}
