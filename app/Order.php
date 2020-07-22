<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = ['productId', 'userId', 'orderCode', 'quantity', 'address', 'shippingDate'];

    protected $hidden = ['created_at', 'updated_at'];

    public function products()
    {
        return $this->belongsTo(Product::class, 'productId');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'userId');
    }
}
