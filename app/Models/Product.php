<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "product";

    protected $fillable = [
        'id',
        'category_id',
        'store_id',
        'type',
        'name',
        'image',
        'description',
        'quantity',
        'price',
        'old_price',
        'discount',
        'hot',
        'deal_of_the_day',
        'start_date',
        'end_date',
        'views',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, "category_id");
    }

    // public function subcategory()
    // {
    //     return $this->belongsTo(Category::class, "subcategory_id");
    // }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    // public function orders() {
    //     return $this->hasMany(Order::class);
    // }

    // public function wish()
    // {
        
    // }
}
