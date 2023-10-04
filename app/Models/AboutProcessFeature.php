<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutProcessFeature extends Model
{
    use HasFactory;

    protected $fillable = [
        'about_process_section_id',
        'title',
        'description',
        'image',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
    


}
