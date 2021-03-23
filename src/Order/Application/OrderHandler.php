<?php

namespace App\Order\Application;

use App\Order\Domain\Order;
use App\Order\Domain\OrderRepository;
use App\Order\Domain\ValueObject\UserId;

class OrderHandler
{
    private OrderRepository $repository;

    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
    }
    //I just started
    public function makeOrder(UserId $userId) : void
    {
        $order = new Order($userId);
    }
}