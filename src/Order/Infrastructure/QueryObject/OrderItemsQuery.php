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
            ->select( 'i.userId.id as userId, i.createdAt.createdAt as createdAt, 
                        i.dishes as dish, i.totalPrice.price as totalPrice, i.isPayed as isPayed')
            ->from(OrderItem::class, 'i')
            ->getQuery()
            ->getResult();
    }
}