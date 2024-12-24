<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceSetting extends Model
{
    use HasFactory;

    protected $table = 'invoice_settings';

    protected $fillable = [
        'prefix',
        'next_number',
        'auto_generate',
    ];
}
