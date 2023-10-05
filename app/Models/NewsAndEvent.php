<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsAndEvent extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'short_description',
        'image',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];
}
