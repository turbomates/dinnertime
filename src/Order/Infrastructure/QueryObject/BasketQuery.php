<?php

namespace App\Order\Infrastructure\QueryObject;

use App\Core\Infrastructure\QueryHandler\QueryObject;
use App\Order\Domain\Basket;
use Doctrine\ORM\EntityManagerInterface;

class BasketQuery implements QueryObject
{
    public function execute(EntityManagerInterface $em): array
    {
        return $restaurant = $em->createQueryBuilder()
            ->select( 'b.userId.id as userId, d.dishId.id as dishId, d.dishName.name as dishName, d.dishPrice.price as dishPrice')
            ->from(Basket::class, 'b')
            ->join('b.dishes', 'd')
            ->orderBy('b.userId.id')
            ->getQuery()
            ->getArrayResult();
    }
}