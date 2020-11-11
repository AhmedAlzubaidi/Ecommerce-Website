<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $timestamps = true;
    
    public function privileges()
    {
        return $this->belongsToMany(Privilege::class);
    }
}
