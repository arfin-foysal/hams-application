<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyAchievement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'count',
        'count_start',
        'count_end',
        'link',
        'icon',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
