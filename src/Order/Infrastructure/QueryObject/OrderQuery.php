<?php

namespace App\Order\Infrastructure\QueryObject;

use App\Core\Infrastructure\QueryHandler\QueryObject;
use App\Order\Domain\Order;
use App\Order\Domain\ValueObject\UserId;
use App\User\Domain\User;
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
            ->select('o.id.id as orderId, o.userId.id as userId, 
                            i.totalPrice.price as price, i.createdAt.createdAt as createdAt,
                            u.name.firstName as userFirstName, u.name.lastName as userLastName, 
                            u.phoneNumber.phoneNumber as phoneNumber, u.email.email as email')
            ->from(Order::class, 'o')
            ->from(User::class, 'u')
            ->join('o.orderItems', 'i')
            ->andWhere('i.userId.id = :id')
            ->andWhere('i.isPayed = false')
            ->andWhere('u.id.id = o.userId.id')
            ->setParameter('id', $this->userId->id())
            ->getQuery()
            ->getResult();
    }
}