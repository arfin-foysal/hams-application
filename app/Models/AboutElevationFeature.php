<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutElevationFeature extends Model
{
    use HasFactory;

    protected $fillable = [
        'icon',
        'title',
        'description',
        'year',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];
}
