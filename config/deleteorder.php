<?php

$oneMinute = '0 0/1 * 1/1 * ? *';
$oneHour   = '0 0 0/1 1/1 * ? *';
$delay = $oneMinute;

return [
    'delay'            => $delay,
    'delay_one_minute' => ($delay === $oneMinute)
];
