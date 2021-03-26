<?php

namespace App\Order\Infrastructure\Repository;

use App\Order\Domain\Order;
use App\Order\Domain\OrderRepository as OrderRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Uid\Uuid;

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

    public function findByUserId(Uuid $orderId): ?Order
    {
        return $this->em->createQueryBuilder()
            ->select('o')
            ->from(Order::class, 'o')
            ->andWhere('o.id.id = :id')
            ->setParameter('id', $orderId)
            ->getQuery()
            ->getOneOrNullResult();
    }
}