<?php

namespace App\Order\Infrastructure\QueryObject;

use App\Core\Infrastructure\QueryHandler\QueryObject;
use App\Order\Domain\OrderItem;
use Doctrine\ORM\EntityManagerInterface;

class OrderItemsQuery implements QueryObject
{
    public function execute(EntityManagerInterface $em): array
    {
        return $em->createQueryBuilder()
            ->select( 'o.userId.id as userId, o.createdAt.createdAt as createdAt,
                        o.dishes as dish, o.isPayed as isPayed')
            ->from(OrderItem::class, 'o')
            ->getQuery()
            ->getResult();
    }
}