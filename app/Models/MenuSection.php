<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_id',
        'sub_menu_id',
        'title',
        'description',
        'image',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
