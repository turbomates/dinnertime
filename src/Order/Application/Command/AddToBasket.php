<?php

namespace App\Order\Application\Command;

use Symfony\Component\Uid\Uuid;

class AddToBasket
{
    public Uuid $dishId;
    public string $dishName;
    public string $dishPrice;
}