<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SliderFeatureSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'logo',
        'title_one',
        'title_two',
        'title_three',
        'title_four',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
