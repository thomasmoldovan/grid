<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'id',
        'product_image'
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
