<?php

namespace App\Services;

use App\Exceptions\PaymentException;
use App\Http\Requests\PaymentVerificationRequest;
use App\Order;
use Moyasar\Payment;

class PaymentVerificationService
{
    public function verifyPayment(PaymentVerificationRequest $request, Order $order)
    {
        $paymentService = resolve(PaymentService::class);
        $payment = $paymentService->fetch($request->input('id'));

        if ($payment->capturedAt) {
            $message = \App\Utility\Messages\Payment::STATUS_ALREADY_PROCESSED;
            throw new PaymentException($message);
        }

        if ($request->input('status') !== "paid" || $request->input('message') !== "Succeeded") {
            $message = \App\Utility\Messages\Payment::STATUS_PAYMENT_FAILED;
            throw new PaymentException($message);
        }

        if (!$payment->capture($order->cost()->getAmount())) {
            $order->cancel();
            $message = \App\Utility\Messages\Payment::INCORRECT_AMOUNT;
            $this->voidPayment($payment, $message);
            throw new PaymentException($message);
        }

        $order->status = \App\Utility\Messages\Order::STATUS_IN_PROGRESS;
        $order->save();

        return $order->loadAll();
    }

    private function voidPayment(Payment $payment, $description)
    {
        $payment->void();
        $payment->update($description);
    }
}
