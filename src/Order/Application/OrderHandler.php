<?php

namespace App\Order\Application;

use App\Order\Domain\BasketRepository;
use App\Order\Domain\Order;
use App\Order\Domain\OrderItem;
use App\Order\Domain\OrderRepository;
use App\Order\Domain\ValueObject\Price;
use App\Order\Domain\ValueObject\UserId;
use Symfony\Component\Uid\Uuid;

//I'm remake everything, you don't have to watch it
class OrderHandler
{
    private OrderRepository $orderRepository;
    private BasketRepository $basketRepository;

    public function __construct(OrderRepository $orderRepository, BasketRepository $basketRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->basketRepository = $basketRepository;
    }

    //when I remake, this method will not need
    private function getUserDish(Uuid $basketId) : string
    {
        $basketDishes = $this->basketRepository->findByBasketId($basketId);
        foreach ($basketDishes as $basketDish)
       {
           $dishes[] = $basketDish['dishName'];
           $dishes[] = $basketDish['dishPrice'];

           return json_encode($dishes);
       }
    }

    //when I remake, this method will not need
    private function totalPrice(Uuid $basketId) : Price
    {
        $basketDishes = $this->basketRepository->findByBasketId($basketId);
        $totalPrice = 0;
        foreach ($basketDishes as $basketDish)
        {
            $totalPrice += $basketDish['dishPrice'];
        }

        return new Price($totalPrice);
    }

    //I remake this method
    public function makeOrder(UserId $userId) : void
    {
        $order = Order::create($userId);
        $baskets = $this->basketRepository->basket();
        foreach ($baskets as $basket)
        {
            $dishes = $this->getUserDish($basket['basketId']);
            $totalPrice = $this->totalPrice($basket['basketId']);
            $order->addOrderItem(new OrderItem($basket->userId(), $basket->totalPrice(), $order, $dishes));
        }
        $this->orderRepository->add($order);
    }
}