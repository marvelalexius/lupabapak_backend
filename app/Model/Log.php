<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    public function links()
    {
        return $this->hasMany('App\Model\LogLink');
    }
}
