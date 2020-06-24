<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function user_wishlist()
    {
        return $this->belongsToMany('App\Model\User', 'wishlist');
    }

    public function transaction_detail()
    {
        return $this->hasMany('App\Model\TransactionDetail');
    }

    public function cart()
    {
        return $this->belongsToMany('App\Model\User', 'carts')->withPivot('quantity', 'price');
    }

    public function isWishlist($user_id) {
        return $this->user_wishlist()->where('user_id', $user_id)->exists();
    }
}
