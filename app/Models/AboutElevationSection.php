<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutElevationSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'short_title',
        'title',
        'description',
    ];
}
