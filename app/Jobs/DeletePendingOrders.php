<?php

namespace App\Jobs;

use App\Order;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class DeletePendingOrders
{
    use Dispatchable, Queueable;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $oneMinute = config('deleteorder.delay_one_minute');
        $time      = ($oneMinute ? Carbon::now()->subMinute() : Carbon::now()->subHour());
        $orders    = Order::where('created_at', '<', $time)->get();

        foreach ($orders as $order) {
            $order->status = config('orderstatus.CANCELED');
            $orderItems    = $order->orderItems();
            $products      = array();

            foreach ($orderItems as $orderItem) {
                $product = $orderItem->product();
                array_push($products, $product);
                $product->quantity++;
            }

            $order->save();
            $order->delete();
        }
    }
}
