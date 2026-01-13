<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory;

    // Allow mass assignment for these fields
    protected $fillable = [
        'title',
        'slug',
        'author_name',
        'content',
        'user_id',
        'published_date',
    ];

    // Use slug for route model binding
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    // Relationship to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
