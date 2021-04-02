<?php

namespace App\Order\Infrastructure\QueryObject;

use App\Core\Infrastructure\QueryHandler\QueryObject;
use App\Order\Domain\OrderItem;
use App\Order\Domain\ValueObject\UserId;
use Doctrine\ORM\EntityManagerInterface;

class OrderItemsQuery implements QueryObject
{
    private UserId $userId;

    public function __construct(UserId $userId)
    {
        $this->userId = $userId;
    }

    public function execute(EntityManagerInterface $em): array
    {
        return $em->createQueryBuilder()
            ->select( 'i.createdAt.createdAt as createdAt,
                        i.dishes as dish, i.totalPrice.price as totalPrice, i.isPayed as isPayed')
            ->from(OrderItem::class, 'i')
            ->join('i.order', 'o')
            ->orderBy('i.createdAt.createdAt')
            ->andWhere('o.userInfo.id.id = :id')
            ->setParameter('id', $this->userId->id())
            ->getQuery()
            ->getResult();
    }
}