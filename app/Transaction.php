<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Events\TransactionConfirmed;

class Transaction extends Model
{
    protected $with = ['details'];

    protected $dispatchesEvents = [
        'updated' => TransactionConfirmed::class,
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function details()
    {
        return $this->hasMany('App\TransactionDetail');
    }
}
