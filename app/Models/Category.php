<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'category';

    protected $fillable = [
        'parent_id',
        'icon',
        'color',
        'name',
    ];

    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function parent() {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    public function children() {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }
}
