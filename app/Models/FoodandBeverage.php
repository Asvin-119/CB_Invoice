<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodandBeverage extends Model
{
    use HasFactory;

    protected $table = 'foodand_beverages';

    protected $fillable = [
        'quote_id',
        'food_type',
        'rate',
        'mealamount_rs',
        'mealamount_usd',
        'meals',
    ];

    protected $casts = [
        'food_type' => 'array', // Automatically cast to array when accessed
        'meals' => 'array', // Automatically cast to array when accessed
    ];

    public function quotation()
    {
        return $this->belongsTo(Quotation::class, 'quote_id');
    }


}
