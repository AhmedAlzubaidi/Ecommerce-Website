<?php

namespace App\Utility\Messages;

class Payment
{
    public const STATUS_PAYMENT_FAILED    = 'Payment failed';
    public const STATUS_ALREADY_PROCESSED = 'Payment is already processed';
    public const INCORRECT_AMOUNT         = 'Payment is voided, incorrect amount';
}
