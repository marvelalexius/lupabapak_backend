<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogLink extends Model
{
    public function log()
    {
        return $this->belongsTo('App\PaypalLog');
    }
}
