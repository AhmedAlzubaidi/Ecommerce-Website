<?php

namespace App;

use Cknow\Money\Money;
use Cknow\Money\MoneyCast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $casts = [
        'price'    => MoneyCast::class . ':SAR',
        'on_sale'  => 'boolean',
        'discount' => MoneyCast::class . ':SAR'
    ];
    
    public $timestamps = true;
    
    /**
     * TODO rename this to loadAllRelationships
     * or maybe scopes can replace loadAll and scopeWithRelationships
     */
    public function loadAll()
    {
        return Product::where('id', $this->id)->with('productOptions', 'categories')->first();
    }

    public function scopeWithRelationships($query)
    {
        return $query->with('productOptions', 'categories');
    }

    public function productOptions()
    {
        return $this->hasMany(ProductOption::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function cost()
    {
        return $this->price->subtract($this->discount);
    }
}
