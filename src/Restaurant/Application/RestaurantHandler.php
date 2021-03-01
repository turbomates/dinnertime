<?php

namespace App\Restaurant\Application;

use App\Restaurant\Domain\Dish;
use App\Restaurant\Domain\Restaurant;
use App\Restaurant\Domain\RestaurantRepositoryInterface;
use App\Restaurant\Domain\ValueObject\Dish\Price;
use App\Restaurant\Domain\ValueObject\Restaurant\Delivery;
use App\Restaurant\Domain\ValueObject\Restaurant\Name;
use App\Restaurant\Parser\Collection\DishCollection;
use App\Restaurant\Parser\CreateRestaurant;

class RestaurantHandler
{
    private RestaurantRepositoryInterface $repository;

    public function __construct(RestaurantRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function handlerParseRestaurant(CreateRestaurant $restaurant)
    {
        $restaurant = new Restaurant(new Name($restaurant->name), new Delivery(new Price($restaurant->minDeliveryPrice),
            new Price($restaurant->deliveryCost)), $restaurant->dishes);
        $this->repository->persist($restaurant);
    }
}