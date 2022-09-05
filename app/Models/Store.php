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
}
