<?php

namespace App\Order\Domain;

use App\Order\Domain\ValueObject\UserId;
use Symfony\Component\Uid\Uuid;

interface BasketRepository
{
    public function add(Basket $basket) : void;

    public function findByUserId(UserId $id) : ?Basket;

    public function basket() : array;
    //when I remake, this method will not need
    public function findByBasketId(Uuid $id) : array;
}