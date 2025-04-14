<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id', 'name', 'email', 'phone', 'address', 'city', 'zip_code', 
        'payment_method', 'status', 'total_price'
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
