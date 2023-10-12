<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'order_status',
        'user_id',
        'payment_id',
        'service_detail',
        'item_id',
        'payment_amount',
        'payment_status',
    ];
}
