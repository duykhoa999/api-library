<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'books';

    protected $fillable = [
        'title',
        'year',
        'image',
        'language',
        'pagesNum',
        'description',
        'category_id',
        'author_id',
        'publisher_id',
    ];
}
