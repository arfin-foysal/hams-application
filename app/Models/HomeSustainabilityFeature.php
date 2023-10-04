<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeSustainabilityFeature extends Model
{
    use HasFactory;

    protected $fillable = [
        'home_sustainability_id',
        'title',
        'icon',
        'color',
        'count',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

}
