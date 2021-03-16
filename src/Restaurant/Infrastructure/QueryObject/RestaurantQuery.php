<?php

namespace App\Restaurant\Infrastructure\QueryObject;

use App\Core\Infrastructure\QueryHandler\QueryObject;
use App\Restaurant\Domain\Restaurant;
use Doctrine\ORM\EntityManagerInterface;

class RestaurantQuery implements QueryObject
{
    public function execute(EntityManagerInterface $em) : array
    {
        return $restaurant = $em->createQueryBuilder()
            ->select( 'r.name.name as name,
             r.delivery.minPrice.amount as minPrice,r.delivery.cost.amount as cost')
            ->from(Restaurant::class, 'r')
            ->getQuery()
            ->getArrayResult();
    }
}