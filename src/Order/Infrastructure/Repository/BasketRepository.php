<?php

namespace App\Order\Infrastructure\Repository;

use App\Order\Domain\Basket;
use App\Order\Domain\BasketRepository as BasketRepositoryInterface;
use App\Order\Domain\ValueObject\UserId;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Uid\Uuid;

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
    //when I remake, this method will not need
    public function findByBasketId(Uuid $id) : array
    {
        return $this->em->createQueryBuilder()
            ->select('d.dishName.name as dishName, d.dishPrice.price as dishPrice')
            ->from(Basket::class, 'b')
            ->join('b.dishes', 'd')
            ->andWhere('b.id.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getArrayResult();
    }

    public function basket() : array
    {
        return $this->em->createQueryBuilder()
            ->select( 'b')
            ->from(Basket::class, 'b')
            ->getQuery()
            ->getResult();
    }
}