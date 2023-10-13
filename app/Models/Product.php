<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'contact',
        'pick_date',
        'pick_time',
        'car_type',
        'days',
        'trip_type',
        'description',
        'payment_mode',
        'credit_mode',
        'trip_amount',
        'advance_amount',
        'drop_date',
        'drop_time'
    ];
}
