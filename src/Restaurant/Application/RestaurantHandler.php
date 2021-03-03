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
        $restaurant = $this->repository->findByName(new Name($createRestaurant->name));
        // I think about how make to structure of methods right
        $this->handlerRestaurant($restaurant, $createRestaurant);
        $this->removeDish($restaurant);
        $this->addDish($restaurant, $createRestaurant);
        $this->repository->persist($restaurant);
        $this->em->flush();
    }

    // I think about how name method
    private function handlerRestaurant(Restaurant $restaurant, CreateRestaurant $createRestaurant) : void
    {
        if (!$restaurant){
            $restaurant = new Restaurant(new Name($createRestaurant->name), new Delivery(new Price($createRestaurant->minDeliveryPrice), new Price($createRestaurant->deliveryCost)));

        }else{
            $name = new Name($createRestaurant->name);
            $delivery = new Delivery(new Price($createRestaurant->minDeliveryPrice),new Price($createRestaurant->deliveryCost));
            $restaurant->update($name, $delivery);
        }
    }

    private function removeDish(Restaurant $restaurant) : void
    {
        foreach ($restaurant->getMenu() as $dish)
        {
            $restaurant->removeDish($dish);
        }
        $this->repository->persist($restaurant);
    }

    private function addDish(Restaurant $restaurant, CreateRestaurant $createRestaurant) : void
    {
        foreach ($createRestaurant->menu as $dish)
        {
            $restaurant->addDish($dish->dishName, $dish->price, $dish->image, $dish->weight, $dish->description);
        }
    }
}