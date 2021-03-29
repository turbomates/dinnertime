<?php

namespace App\Order\Application;

use App\Order\Application\Command\PayOrderItem;
use App\Order\Domain\BasketRepository;
use App\Order\Domain\Order;
use App\Order\Domain\OrderItem;
use App\Order\Domain\OrderRepository;
use App\Order\Domain\ValueObject\UserId;

class OrderHandler
{
    private OrderRepository $orderRepository;
    private BasketRepository $basketRepository;

    public function __construct(OrderRepository $orderRepository, BasketRepository $basketRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->basketRepository = $basketRepository;
    }

    public function makeOrder(UserId $userId) : void
    {
        $order = Order::create($userId);
        $baskets = $this->basketRepository->basket();
        foreach ($baskets as $basket)
        {
            $order->addOrderItem(new OrderItem($basket->userId(), $basket->totalPrice(), $order, json_encode($basket->dishes()->toArray())));
            $this->basketRepository->remove($basket);
        }
        $this->orderRepository->add($order);
    }

    public function payOrderItem(PayOrderItem $pay, Order $order)
    {
        $order->payOrderItem($pay->orderItemId);
        $this->orderRepository->add($order);
    }
}