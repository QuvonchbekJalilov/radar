<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_address extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'longitude',
        'latitude',
        'region',
        'district',
        'street',
        'home',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function orders(){
        return $this->hasMany(Order::class);
    }
}
