<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutJourneyTimeline extends Model
{
    use HasFactory;

    protected $fillable = [
        'about_journey_section_id',
        'title',
        'description',
        'year',
        'is_active',
    ];
}
