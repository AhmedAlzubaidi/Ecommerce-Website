<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentVerificationRequest;
use App\Order;
use App\Services\PaymentVerificationService;

class PaymentController extends Controller
{
    public function verifyPayment(PaymentVerificationRequest $request, Order $order)
    {
        return resolve(PaymentVerificationService::class)->verifyPayment($request, $order);
    }
}
