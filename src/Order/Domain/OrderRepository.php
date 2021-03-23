<?php

namespace App\Order\Domain;

interface OrderRepository
{
    public function add(Order $order) : void;
}