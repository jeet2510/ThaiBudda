<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'status',
        'description',
        'on_homepage',
        'price',
        'image',
        'tag',
        'card_last_four'
    ];
}
