<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public $timestamps = true;
    
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
