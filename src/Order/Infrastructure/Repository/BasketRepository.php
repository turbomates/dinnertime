<?php

namespace App\Order\Infrastructure\Repository;

use App\Order\Domain\Basket;
use App\Order\Domain\BasketRepository as BasketRepositoryInterface;
use App\Order\Domain\ValueObject\UserId;
use Doctrine\ORM\EntityManagerInterface;

class BasketRepository implements BasketRepositoryInterface
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function add(Basket $basket) : void
    {
        $this->em->persist($basket);
    }

    public function findByUserId(UserId $id) : ?Basket
    {
        return $this->em->createQueryBuilder()
            ->select('b')
            ->from(Basket::class, 'b')
            ->andWhere('b.userId.id = :id')
            ->setParameter('id', $id->id())
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function basket() : array
    {
        return $this->em->createQueryBuilder()
            ->select( 'b')
            ->from(Basket::class, 'b')
            ->getQuery()
            ->getResult();
    }

    public function remove(Basket $basket): void
    {
        $this->em->remove($basket);
    }
}