<?php

namespace App\Order\Domain;

use App\Order\Domain\ValueObject\Basket\UserId;

interface BasketRepository
{
    public function add(Basket $basket) : void;

    public function findByUserId(UserId $id) : ?Basket;
}