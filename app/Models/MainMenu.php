<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainMenu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'link',
        'description',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'is_active',
    ];

    protected $casts =  [
        'is_active' => 'boolean'
    ];

}
