<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
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
        Helper functions
    */
    public static function getUniqueSlug($name)
    {
        $originalSlug = str()->slug($name);
        $slug = $originalSlug;

        /* SELECT * FROM categories WHERE slug = $slug */
        $existingCategory = Category::where('slug', $slug)->first();

        $counter = 1;

        while ($existingCategory != null) {
            $slug = $originalSlug.'-'.$counter;

            $existingCategory = Category::where('slug', $slug)->first();

            $counter++;
        }

        return $slug;
    }

    /*
        Relationships
    */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
