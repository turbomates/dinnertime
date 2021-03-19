<?php

namespace App\Order\Application;

use App\Order\Application\Command\AddToBasket;
use App\Order\Domain\Basket;
use App\Order\Domain\BasketDish;
use App\Order\Domain\BasketRepository;
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

    public function addToBasket(AddToBasket $dishes, UserId $userId) : void
    {
        $basket = $this->getBasket($userId);
        $basket->addDish(new BasketDish(new DishName($dishes->dishName), new DishPrice($dishes->dishPrice), $basket));
        $this->repository->add($basket);
    }

    private function getBasket(UserId $userId) : Basket
    {
        if ($basket = $this->repository->findByUserId($userId)){
            return $basket;
        }

        return Basket::create($userId);
    }
}