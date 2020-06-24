<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'price',
        'quantity',
    ];

    public function user()
    {
        return $this->belongsTo('App\Model\User');
    }

    public function product()
    {
        return $this->belongsTo('App\Model\Product');
    }
}
