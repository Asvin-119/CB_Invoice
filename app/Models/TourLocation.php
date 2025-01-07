<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourLocation extends Model
{
    use HasFactory;

    protected $table = 'tour_locations';

    protected $fillable = [
        'tour_location',
        'tour_places_name',
    ];
}
