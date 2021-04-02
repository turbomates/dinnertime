<?php

namespace App\Order\Infrastructure\QueryObject;

use App\Core\Infrastructure\QueryHandler\QueryObject;
use App\Order\Domain\Order;
use App\Order\Domain\ValueObject\UserId;
use Doctrine\ORM\EntityManagerInterface;

class OrderQuery implements QueryObject
{
    private UserId $userId;

    public function __construct(UserId $userId)
    {
        $this->userId = $userId;
    }

    public function execute(EntityManagerInterface $em): array
    {
        return $em->createQueryBuilder()
            ->select('o.id.id as orderId, o.userInfo.userInfo as userInfo,
                            i.totalPrice.price as price, i.createdAt.createdAt as createdAt')
            ->from(Order::class, 'o')
            ->join('o.orderItems', 'i')
            ->andWhere('i.userId.id = :id')
            ->andWhere('i.isPayed = false')
            ->setParameter('id', $this->userId->id())
            ->getQuery()
            ->getResult();
    }
}