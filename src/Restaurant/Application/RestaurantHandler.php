<?php

namespace App\Restaurant\Application;

use App\Restaurant\Domain\Restaurant;
use App\Restaurant\Domain\RestaurantRepositoryInterface;
use App\Restaurant\Domain\ValueObject\Dish\Price;
use App\Restaurant\Domain\ValueObject\Restaurant\Delivery;
use App\Restaurant\Domain\ValueObject\Restaurant\Name;
use App\Restaurant\Parser\CreateRestaurant;
use Doctrine\ORM\EntityManagerInterface;

class RestaurantHandler
{
    private RestaurantRepositoryInterface $repository;
    private EntityManagerInterface $em;

    public function __construct(RestaurantRepositoryInterface $repository,EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    public function handlerParseRestaurant(CreateRestaurant $createRestaurant) : void
    {
        $restaurant = new Restaurant(new Name($createRestaurant->name), new Delivery(new Price($createRestaurant->minDeliveryPrice), new Price($createRestaurant->deliveryCost)));
        foreach ($createRestaurant->menu as $menu)
        {
            $restaurant->addDish($menu->dishName, $menu->price, $menu->image, $menu->weight, $menu->description);
        }
        $this->repository->persist($restaurant);
        $this->em->flush();
    }
}