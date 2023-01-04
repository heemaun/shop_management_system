<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';

    protected $fillable = [
        'shop_id',
        'user_id',
        'from_account',
        'to_account',
        'from_user',
        'to_user',
        'sell_id',
        'purchase_id',
        'type',
        'status',
        'from_select',
        'to_select',
        'amount'
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function fromAccount()
    {
        return $this->belongsTo(Account::class,'from_account');
    }

    public function toAccount()
    {
        return $this->belongsTo(Account::class,'to_account');
    }

    public function fromUser()
    {
        return $this->belongsTo(User::class,'from_user');
    }

    public function toUser()
    {
        return $this->belongsTo(User::class,'to_user');
    }

    public function sell()
    {
        return $this->belongsTo(Sell::class);
    }

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }
}
