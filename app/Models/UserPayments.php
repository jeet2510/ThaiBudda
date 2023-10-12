<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPayments extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'card_number',
        'expiry_date',
        'cvv',
        'zipcode',
        'stripe_payment_method_id'
    ];
}
