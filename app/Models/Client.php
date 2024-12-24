<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'clients';

    protected $fillable = [
        'salutation',
        'first_name',
        'last_name',
        'display_name',
        'email',
        'mobile_phone',
        'client_image',
        'tour_consultant',
        'source',
    ];
}
