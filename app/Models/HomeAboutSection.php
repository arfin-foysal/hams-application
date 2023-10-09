<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeAboutSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'short_title' ,
        'title',
        'featured_image',
        'short_description',
        'description',
        'youtube_link',
        'button_text' ,
        'button_link' ,
        'start_count' ,
        'end_count' ,
        'name'  ,
    ];


}
