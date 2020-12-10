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
        $time   = Carbon::now()->subMinute();
        $orders = Order::where('created_at', '<', $time)->get();

        foreach ($orders as $order) {
            $order->status = \App\Utility\Messages\Order::STATUS_CANCELED;
            $orderItems    = $order->orderItems();

            foreach ($orderItems as $orderItem) {
                $product = $orderItem->product();
                $product->quantity++;
            }

            $order->save();
            $order->delete();
        }
    }
}
