<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    use HasFactory;

    protected $fillable = [
        'certification_category_id',
        'sort_title',
        'title',
        'description',
        'image',
        'certificate_img',
        "button_text",
        "button_link",
        'is_active',

    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
