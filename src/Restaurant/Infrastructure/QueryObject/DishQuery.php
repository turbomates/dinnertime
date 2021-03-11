<?php

namespace App\Restaurant\Infrastructure\QueryObject;

use App\Core\Infrastructure\QueryHandler\QueryObject;
use App\Restaurant\Domain\Dish;
use App\Restaurant\Domain\ValueObject\Restaurant\Name;
use Doctrine\ORM\EntityManagerInterface;

class DishQuery implements QueryObject
{
    private Name $name;

    public function __construct(Name $name)
    {
        $this->name = $name;
    }

    public function execute(EntityManagerInterface $em): array
    {
        return $dish = $em->createQueryBuilder()
            ->select('d.name.name as name, d.price.amount as amount, d.weight.weight as weight,
            d.description.description as description, d.path.path as path, r.name.name as restaurantName')
            ->from(Dish::class, 'd')
            ->join('d.restaurant', 'r')
            ->andWhere('r.name.name = :name')
            ->setParameter('name', $this->name->getName())
            ->getQuery()
            ->getArrayResult();
    }
}