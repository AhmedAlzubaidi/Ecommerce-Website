<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductOption extends Model
{
    public $timestamps = true;
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
