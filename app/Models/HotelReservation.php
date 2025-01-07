<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelReservation extends Model
{
    use HasFactory;

    protected $table = 'hotel_reservations';

    protected $fillable = [
        'quote_id',
        'hotel_type_id',
        'hotel_location_id',
        'hlquantity',
        'rate',
        'hlamount_rs',
        'hlamount_usd',
    ];

    public function quote()
    {
        return $this->belongsTo(Quotation::class);
    }

    public function hotelType()
    {
        return $this->belongsTo(HotelType::class);
    }

    public function hotelLocation()
    {
        return $this->belongsTo(HotelLocation::class);
    }
}
