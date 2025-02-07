<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'genre',
        'publisher',
        'published_year',
        'description',
        'cover_image',
        'status'
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
