<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $table = 'store';

    protected $fillable = [
        "location_id",
        // "category_id",
        "name",
        "image",
        "address",
        "link",
        "display",
        "status"
    ];

    public function location()
    {
        return $this->belongsTo(Location::class, "location_id");
    }

    // public function category()
    // {
    //     return $this->belongsTo(Category::class, "category_id");
    // }
}
