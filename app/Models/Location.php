<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'location_name',
        'active',
    ];

    public function store()
    {
        return $this->hasMany(Store::class);
    }

    public function getIsActiveAttribute($value)
    {
        return $value === 1;
    }

    public function getIsNotActiveAttribute($value)
    {
        return $value !== 1;
    }
}
