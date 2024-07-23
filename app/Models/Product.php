<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'brand_id', 'name_uz', 'name_ru', 'name_en',
        'description_uz', 'description_ru', 'description_en', 'price', 'stock', 'image', 'status'
    ];

    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }

    public function specifications()
    {
        return $this->hasMany(Specification::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }


    public function users()
    {
        // Specify the pivot table name and foreign key names
        return $this->belongsToMany(User::class, 'cart_user', 'product_id', 'user_id');
    }


    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_product')->withPivot('quantity')->withTimestamps();
    }
}
