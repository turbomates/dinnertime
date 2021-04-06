<?php

namespace App\Order\Application\Command;

use Symfony\Component\Uid\Uuid;

class PayOrderItem
{
    public Uuid $orderItemId;
}