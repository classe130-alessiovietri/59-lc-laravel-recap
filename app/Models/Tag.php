<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug'
    ];

    protected $hidden = [
        'id'
    ];

    /*
        Relationships
    */
    public function posts()
    {
        return $this->belongsToMany(Post::class)
                    ->withTimestamps();
                    // ->withPivot([
                    //     'created_at',
                    //     'updated_at'
                    // ]);
    }
}
