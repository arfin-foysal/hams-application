<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeSustainability extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'button_text',
        'button_link',
    ];
}
