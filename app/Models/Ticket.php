<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'tickets';

    protected $fillable = ['ticket_type'];

    public function ticketReservations()
    {
        return $this->hasMany(TicketReservation::class, 'ticket_id');
    }
}
