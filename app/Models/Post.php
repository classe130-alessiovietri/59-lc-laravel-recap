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

    protected $appends = [
        'full_cover_url'
    ];

    protected $hidden = [
        'id',
        'category_id'
    ];

    /*
        Custom attributes
    */
    /*
        Voglio creare SU TUTTE LE ISTANZE DEL MODEL Post la nuova proprietà che si chiama full_cover_url,
        allora devo creare qui nel model una funzione che si chiama getFullCoverUrlAttribute()
    */
    public function getFullCoverUrlAttribute()
    {
        $fullCoverUrl = null;

        if ($this->cover) {
            $fullCoverUrl = asset('storage/'.$this->cover);
        }

        return $fullCoverUrl;
    }

    /*
        Relationships
    */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)
                    ->withTimestamps();
                    // ->withPivot([
                    //     'created_at',
                    //     'updated_at'
                    // ]);
    }
}
