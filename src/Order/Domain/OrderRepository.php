<?php

namespace App\Order\Domain;

use App\Order\Domain\ValueObject\UserId;
use Symfony\Component\Uid\Uuid;

interface OrderRepository
{
    public function add(Order $order) : void;

    public function findByUserId(Uuid $orderId) : ?Order;
}