<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class BookTable extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'book_table';
    protected $fillable = [
        'email'
    ];
}
