<?php
namespace Modules\Cart\Enum;

interface ItemStatus
{
    // Item order status (for restaurant)
    const NEW_ORDER = 0;
    const PROCESSING = 1;
    const COMPLETED = 2;
    const FAILED = 3;
}
