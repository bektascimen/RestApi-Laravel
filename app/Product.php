<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = ['name', 'slug', 'description', 'price'];

    protected $hidden = ['created_at', 'updated_at'];

    public function orders()
    {
        return $this->belongsTo('App\Order', 'productId');
    }

}
