<?php

namespace App;

use Cknow\Money\MoneyCast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $casts = [
        'total_cost' => MoneyCast::class . ':SAR',
        'tax'        => MoneyCast::class . ':SAR'
    ];

    public $timestamps = true;

    public function cost()
    {
        return $this->total_cost->add($this->tax);
    }
    public function loadAll()
    {
        return Order::where('id', $this->id)->with('user', 'orderItems')->first();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function cancel()
    {
        if ($this->status === Utility\Messages\Order::STATUS_DELIVERED) {
            return false;
        }

        foreach ($this->orderItems() as $orderItem) {
            $product = $orderItem->product();
            $product->quantity += $orderItem->quantity;
            $product->save();
            $orderItem->delete();
        }
        
        $this->status = Utility\Messages\Order::STATUS_CANCELED;
        $this->save();
        $this->delete();
        return $this->delete();
    }
}
