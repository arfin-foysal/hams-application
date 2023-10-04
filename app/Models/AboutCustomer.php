<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutCustomer extends Model
{
    use HasFactory;

    protected $fillable = [
        'short_title',
        'title',
        'description',
    ];
}