<?php

namespace App\Order\Domain;

use App\Order\Domain\ValueObject\UserId;

interface BasketRepository
{
    public function add(Basket $basket) : void;

    public function findByUserId(UserId $id) : ?Basket;

    public function basket() : array;

    public function remove(Basket $basket) : void;
}