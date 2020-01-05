<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function user_wishlist()
    {
        return $this->belongsToMany('App\User', 'wishlist');
    }

    public function transaction_detail()
    {
        return $this->hasMany('App\TransactionDetail');
    }
}
