<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class buyer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'items_id',
        'date',
        'payment',
    ];
}
