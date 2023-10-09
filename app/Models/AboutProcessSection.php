<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutProcessSection extends Model
{
    use HasFactory;
    protected $fillable = [
        'short_title',
        'title',
        'description',
    ];
}
