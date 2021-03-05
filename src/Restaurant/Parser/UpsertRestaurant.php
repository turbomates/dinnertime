<?php

namespace App\Restaurant\Parser;

use App\Restaurant\Domain\Restaurant;
use App\Restaurant\Domain\RestaurantRepository;
use App\Restaurant\Domain\ValueObject\Dish\Price;
use App\Restaurant\Domain\ValueObject\Restaurant\Delivery;
use App\Restaurant\Domain\ValueObject\Restaurant\Name;

//I think about name
class UpsertRestaurant
{
    private RestaurantRepository $repository;

    public function __construct(RestaurantRepository $repository)
    {
        $this->repository = $repository;
    }

    //I think about name
    public function upsert(string $name, float $minDelivery, float $cost): Restaurant
    {
        if (!$restaurant = $this->repository->findByName(new Name($name))){
            return Restaurant::create($name, $minDelivery, $cost);
        }
        $restaurant->update(new Name($name), new Delivery(new Price($minDelivery), new Price($cost)));

        return $restaurant;
    }
}