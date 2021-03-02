<?php

namespace App\Restaurant\Infrastructure\Repository;

use App\Restaurant\Domain\Restaurant;
use App\Restaurant\Domain\RestaurantRepositoryInterface;
use App\Restaurant\Domain\ValueObject\Restaurant\Name;
use Doctrine\ORM\EntityManagerInterface;

class RestaurantRepository implements RestaurantRepositoryInterface
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function persist(Restaurant $restaurant) : void
    {
        $this->em->persist($restaurant);
    }

    public function findByName(Name $name) : Restaurant
    {

    }
}