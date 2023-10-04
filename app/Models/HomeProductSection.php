<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeProductSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'sort_title',
        'title',
        'bg_image',
        'description',
    ];


}
