<?php

namespace App\Order\Domain;

interface BasketRepository
{
    public function add(Basket $basket) : void;
}