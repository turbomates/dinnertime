<?php

namespace App\Order\Application;

use App\Order\Application\Command\AddToBasket;
use App\Order\Domain\Basket;
use App\Order\Domain\BasketDish;
use App\Order\Domain\BasketRepository;
use App\Order\Domain\Collection\Dishes;
use App\Order\Domain\ValueObject\Basket\UserId;
use App\Order\Domain\ValueObject\BasketDish\DishName;
use App\Order\Domain\ValueObject\BasketDish\DishPrice;

class BasketHandler
{
    private BasketRepository $repository;

    public function __construct(BasketRepository $repository)
    {
        $this->repository = $repository;
    }

    //I think about it
    public function addToBasket(AddToBasket $dishes, UserId $userId) : void
    {
        $basket = new Basket($userId);
        $basketDish = new BasketDish(new DishName($dishes->dishName), new DishPrice($dishes->dishPrice), $basket);
        $dishes = new Dishes();
        $dishes->add($basketDish);
        $basket->addDishes($dishes);
        $this->repository->add($basket);
    }
}