<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubMenu extends Model
{
    use HasFactory;

    protected $fillable = [

        'menu_id',
        'name',
        'description',
        'link',
        'is_active',

    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
