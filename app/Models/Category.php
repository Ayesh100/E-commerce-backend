<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $guarded = ['id'];

    public function brands()
    {
        return $this->belongsToMany(Brand::class, 'brand_category');
    }

    // One-to-many relationship with Product
    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
