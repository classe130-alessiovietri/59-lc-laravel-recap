<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'cover',
        'likes',
        'published',
        'category_id'
    ];

    /*
        Relationships
    */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
