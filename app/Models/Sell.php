<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sell extends Model
{
    use HasFactory;

    protected $table = 'sells';

    protected $fillable = [
        'shop_id',
        'user_id',
        'customer_id',
        'status',
        'total_price',
        'total_product_count',
        'total_order_count',
        'less',
        'vat',
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function customer()
    {
        return $this->belongsTo(User::class,'customer_id');
    }

    public function sellOrders()
    {
        return $this->hasMany(SellOrder::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
