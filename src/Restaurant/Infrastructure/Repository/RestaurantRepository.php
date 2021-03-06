<?php

namespace App\Restaurant\Infrastructure\Repository;

use App\Restaurant\Domain\Restaurant;
use App\Restaurant\Domain\RestaurantRepository as RestaurantRepositoryInterface;
use App\Restaurant\Domain\ValueObject\Restaurant\Name;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;

class RestaurantRepository implements RestaurantRepositoryInterface
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    private function createQueryBuilder() : QueryBuilder
    {
        return $this->em->createQueryBuilder()
            ->select('r')
            ->from(Restaurant::class, 'r');
    }

    public function add(Restaurant $restaurant): void
    {
        $this->em->persist($restaurant);
    }

    public function findByName(Name $name) : ?Restaurant
    {
        return $this->createQueryBuilder()
            ->andWhere('r.name.name = :name')
            ->setParameter('name', $name->getName())
            ->getQuery()
            ->getOneOrNullResult();
    }
}