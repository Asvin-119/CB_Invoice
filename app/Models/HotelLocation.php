<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelLocation extends Model
{
    use HasFactory;

    protected $table = 'hotel_locations';

    protected $fillable = [
        'hotel_location',
        'hotel_name',
    ];
}
