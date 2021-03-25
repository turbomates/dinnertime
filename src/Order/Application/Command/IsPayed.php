<?php

namespace App\Order\Application\Command;

use Symfony\Component\Uid\Uuid;

class IsPayed
{
    public Uuid $userId;
    public bool $isPayed;
}