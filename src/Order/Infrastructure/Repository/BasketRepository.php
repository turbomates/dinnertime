<?php

namespace App\Order\Infrastructure\Repository;

use App\Order\Domain\Basket;
use App\Order\Domain\BasketRepository as BasketRepositoryInterface;
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
}