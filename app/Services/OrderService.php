<?php

namespace App\Services;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Order;
use App\OrderItem;
use App\Product;
use Cknow\Money\Money;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function placeOrder(StoreOrderRequest $request)
    {
        $products    = $this->getProducts($request);
        $quantities  = $request->input('quantities');
        $latestOrder = DB::table('orders')->latest('id')->first();
        $newOrderId  = $latestOrder ? $latestOrder->id + 1 : 1;
        $orderNumber = '#' . str_pad($newOrderId, 8, "0", STR_PAD_LEFT);

        $order               = new Order();
        $order->user()->associate($request->user());
        $order->order_number = $orderNumber;
        $order->status       = \App\Utility\Messages\Order::STATUS_PENDING;
        $total               = $this->getTotal($products, $quantities);
        $order->total_cost   = $total;
        $order->tax          = $this->calculateTax($total);
        
        $this->placeOrderItems($order, $products, $quantities);

        return $order->loadAll();
    }

    private function placeOrderItems(Order $order, array $products, array $quantities)
    {
        for ($i = 0; $i < count($products); $i++) {
            $product             = $products[$i];
            $orderItem           = new OrderItem();
            $orderItem->order()->associate($order);
            $orderItem->product()->associate($product);
            $orderItem->quantity = $quantities[$i];
            $orderItem->price    = $product->cost()->multiply($quantities[$i]);
            $orderItem->save();
            $product->quantity  -= $quantities[$i];
        }
    }

    public function updateOrder(UpdateOrderRequest $request, Order $order)
    {
        $order->status = $request->input('status');
        $order->save();
        return $order->loadAll();
    }

    private function getProducts(StoreOrderRequest $request)
    {
        $products = array();

        foreach ($request->input('product_ids') as $productId) {
            $product = Product::where('id', $productId)->first();

            if (!$product) {
                return null;
            }

            array_push($products, $product);
        }

        return $products;
    }

    private function getTotal($products, $quantities)
    {
        $total = Money::SAR(0);

        for ($i = 0; $i < count($products); $i++) {
            $itemCost = Money::SAR($products[$i]->cost())->multiply($quantities[$i]);
            $total->add($itemCost);
        }

        return $total;
    }

    private function calculateTax($total)
    {
        return $total->divide(100)->multiply(config('payment.tax_percentage.vat'));
    }
}
