<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Privilege extends Model
{
    public $timestamps = true;
    
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
