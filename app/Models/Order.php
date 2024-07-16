<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'user_address_id',
        'total_amount',
        'payment_method',
        'shipping_method',
        'payment_status',
        'shipping_status',
        'status',
        'order_date',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product')->withPivot('quantity')->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function address()
    {
        return $this->belongsTo(User_address::class, 'user_address_id');
    }

    public function Payme(){
        return $this->hasMany(PaymeTransaction::class);
    }
}
