<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    protected $with = ['product'];

    public function transaction()
    {
        return $this->belongsTo('App\Model\Transaction');
    }

    public function product()
    {
        return $this->belongsTo('App\Model\Product');
    }
}
