<?php

namespace App\Order\Application;

use App\Core\Infrastructure\QueryHandler\QueryExecutor;
use App\Order\Application\Command\AddToBasket;
use App\Order\Application\Command\RemoveDish;
use App\Order\Domain\Basket;
use App\Order\Domain\BasketDish;
use App\Order\Domain\BasketRepository;
use App\Order\Domain\ValueObject\BasketDish\DishId;
use App\Order\Domain\ValueObject\BasketDish\DishName;
use App\Order\Domain\ValueObject\Price;
use App\Order\Domain\ValueObject\UserId;

class BasketHandler
{
    private BasketRepository $repository;
    private QueryExecutor $queryExecutor;

    public function __construct(BasketRepository $repository, QueryExecutor $queryExecutor)
    {
        $this->repository = $repository;
        $this->queryExecutor = $queryExecutor;
    }

    public function addToBasket(AddToBasket $dishes, UserId $userId) : void
    {
        $basket = $this->getBasket($userId);
        $basket->addDish(new BasketDish(new DishId($dishes->dishId),new DishName($dishes->dishName), new Price($dishes->dishPrice), $basket));
        $this->repository->add($basket);
    }

    public function removeDish(UserId $userId, RemoveDish $removeDish) : void
    {
        $basket = $this->getBasket($userId);
        $basket->removeDish($removeDish->basketDishId);
    }

    private function getBasket(UserId $userId) : Basket
    {
        if ($basket = $this->repository->findByUserId($userId)){
            return $basket;
        }

        return Basket::create($userId);
    }
}