<?php

namespace App\Model;

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
        return $this->belongsTo('App\Model\User');
    }

    public function details()
    {
        return $this->hasMany('App\Model\TransactionDetail');
    }
}
