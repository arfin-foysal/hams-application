<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected  $fillable = [
        'home_product_section_id',
        'client_id',
        'featured_image',
        'image',
        'sort_title',
        'title',
        'sort_description',
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
