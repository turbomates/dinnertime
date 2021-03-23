<?php

namespace App\Order\Application\Command;

use Symfony\Component\Uid\Uuid;

class RemoveDish
{
    public Uuid $basketDishId;
}