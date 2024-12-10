<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'number_id', 'user_id', 'total_price', 'name', 'email', 'phone'
    ];

    public function number()
    {
        return $this->belongsTo(Number::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
