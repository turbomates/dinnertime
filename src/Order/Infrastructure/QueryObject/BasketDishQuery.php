<?php

namespace App\Order\Infrastructure\QueryObject;

use App\Core\Infrastructure\QueryHandler\QueryObject;
use App\Order\Domain\BasketDish;
use App\Order\Domain\ValueObject\UserId;
use Doctrine\ORM\EntityManagerInterface;

class BasketDishQuery implements QueryObject
{
    private UserId $id;

    public function __construct(UserId $id)
    {
        $this->id = $id;
    }

    public function execute(EntityManagerInterface $em): array
    {
        return $restaurant = $em->createQueryBuilder()
            ->select( 'd.dishId.id as dishId, d.dishName as dishName, d.dishPrice.price as dishPrice')
            ->from(BasketDish::class, 'd')
            ->join('d.basket', 'b')
            ->orderBy('b.createdAt.createdAt')
            ->andWhere('b.userId.id = :id')
            ->setParameter('id', $this->id->id())
            ->getQuery()
            ->getArrayResult();
    }
}