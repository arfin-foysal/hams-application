<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeCertification extends Model
{
    use HasFactory;

    protected $fillable = [
        'sort_title',
        'title',
        'description',
        'button_text',
        'button_link',
    ];
}
