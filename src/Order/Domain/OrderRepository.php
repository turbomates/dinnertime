<?php

namespace App\Order\Domain;

use App\Order\Domain\ValueObject\UserId;

interface OrderRepository
{
    public function add(Order $order) : void;

    public function findByUserId(UserId $userId) : ?Order;
}