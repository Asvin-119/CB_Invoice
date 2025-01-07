<?php

namespace App\Models;

use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;

    protected $table = 'quotations';

    protected $fillable = [
        'quote_number',
        'quote_date',
        'client_id',
    ];

    public static function boot()
    {
        parent::boot();

        // Automatically generate quote number before creating a new record
        static::creating(function ($quotation) {
            $lastQuotation = Quotation::latest('id')->first();

            // Generate a quote number, ensuring it's unique
            $quoteNumber = 'AHG/QUO - ' . str_pad(($lastQuotation ? intval(substr($lastQuotation->quote_number, -4)) + 1 : 1), 4, '0', STR_PAD_LEFT);

            // Assign the generated quote number
            $quotation->quote_number = $quoteNumber;
        });
    }

    public function clients()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
