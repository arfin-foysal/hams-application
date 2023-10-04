<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VirtuallySection extends Model
{
    use HasFactory;

    protected $fillable = [
        'sort_title',
        'title',
        'description',
        'button_text',
        'link',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
