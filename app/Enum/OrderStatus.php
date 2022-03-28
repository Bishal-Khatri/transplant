<?php
namespace App\Enum;

interface OrderStatus
{
    const SUCCESS = 1; // successfully created
    const PROCESSING = 2; // processing order started
    const SHIPPED = 3; // successfully shipped
    const COMPLETED = 4; // Order has been shipped and receipt/payment is confirmed.
    const CANCELED = 5; // canceled by user
    const FAILED = 6; // declined by seller
}
