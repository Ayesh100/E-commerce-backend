<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $table = 'brands';
    protected $guarded = ['id'];

    // Many-to-many relationship with Category
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'brand_category');
    }

    // One-to-many relationship with Product
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
