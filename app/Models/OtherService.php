<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherService extends Model
{
    use HasFactory;

    protected $table = 'other_services';

    protected $fillable = [
        'quote_id',
        'service_id',
        'rate',
        'serviceamount_lkr',
        'serviceamount_usd',
    ];

    public function quotation()
    {
        return $this->belongsTo(Quotation::class, 'quote_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
