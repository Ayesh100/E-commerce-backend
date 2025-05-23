<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $guarded = ['id'];

    // Belongs to one Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Belongs to one Brand
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
