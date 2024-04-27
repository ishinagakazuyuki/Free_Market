<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class item extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'brands_id',
        'description',
        'categories_id',
        'conditions_id',
        'value',
        'image',
    ];

    public function user()
    {
        return $this->belongsTo(user::class);
        return $this->belongsTo(brands::class);
        return $this->belongsTo(categories::class);
        return $this->belongsTo(conditions::class);
    }
}
