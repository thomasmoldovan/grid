<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        "category_id",
        "location_id",
        "store_name",
        "store_image",
        "store_address",
        "store_link",
        "display",
        "status_id"
    ];

    public function location()
    {
        return $this->belongsTo(Location::class, "location_id");
    }

    public function category()
    {
        return $this->belongsTo(Category::class, "category_id");
    }
}
