<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    #menambahkan property fillable
    protected $fillable = ['title', 'author', 'description', 'content', 'url', 'url_image', 'published_at', 'category'];
}
