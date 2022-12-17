<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellOrder extends Model
{
    use HasFactory;

    protected $table = 'sell_orders';

    protected $fillable = [
        'shop_id',
        'user_id',
        'sell_id',
        'product_id',
        'status',
        'units',
        'unit_price',
        'subtotal',
        'discount'
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sell()
    {
        return $this->belongsTo(Sell::class);
    }

    public function product()
    {
        return $this->belongsTo(product::class);
    }
}
