<?php
namespace App\Enum;

interface OrderPaymentStatus
{
    const UNPAID = 1;
    const SUCCESS = 2;
    const FAILED = 3; // failed to pay by user
}
