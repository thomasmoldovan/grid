<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'parent_id',
        'category_icon',
        'category_color',
        'category_name',
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
