<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'shop_id',
        'user_id',
        'category_id',
        'name',
        'status',
        'picture',
        'initial_inventory',
        'current_inventory',
        'purchase_price',
        'avg_purchase_price',
        'selling_price',
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function purchaseOrders()
    {
        return $this->hasMany(PurchaseOrder::class);
    }

    public function sellOrders()
    {
        return $this->hasMany(SellOrder::class);
    }
}
