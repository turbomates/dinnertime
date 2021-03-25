<?php

namespace App\Order\Infrastructure\Repository;

use App\Order\Domain\Order;
use App\Order\Domain\OrderRepository as OrderRepositoryInterface;
use App\Order\Domain\ValueObject\UserId;
use Doctrine\ORM\EntityManagerInterface;

class OrderRepository implements OrderRepositoryInterface
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function add(Order $order) : void
    {
        $this->em->persist($order);
    }

    public function findByUserId(UserId $userId): ?Order
    {
        return $this->em->createQueryBuilder()
            ->select('o')
            ->from(Order::class, 'o')
            ->join('o.orderItems', 'i')
            ->andWhere('i.userId.id = :id')
            ->setParameter('id', $userId->id())
            ->getQuery()
            ->getOneOrNullResult();
    }
}