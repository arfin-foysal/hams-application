<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommonInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'logo',
        'favicon',
        'banner',
        'about_text',
        'office_time',
        'location',
        'office_address_one',
        'office_address_two',
        'phone_number',
        'hotline_number',
        'email',
        'alt_email',
        'tour_link',
        'meta_title',
        'meta_keyword',
        'meta_description',
    ];

}
