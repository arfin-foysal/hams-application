<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected  $fillable = [
        'client_id',
        'product_category_id',
        'image',
        'short_title',
        'title',
        'short_description',
        'delivery_date',
        'description',
        'facebook_link',
        'youtube_link',
        'linkedin_link',
        'is_active',
    ];

    protected $casts = [
        'delivery_date' => 'datetime',
        'is_active' => 'boolean',

    ];
}
