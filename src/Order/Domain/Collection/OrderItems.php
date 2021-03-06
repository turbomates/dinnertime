<?php

namespace App\Order\Domain\Collection;

use App\Core\Domain\ArrayTypeCollection;
use App\Order\Domain\OrderItem;
use Symfony\Component\Config\Definition\Exception\Exception;

class OrderItems extends ArrayTypeCollection
{
    public function isSupport($element): bool
    {
        if (!is_object($element) && (get_class($element) !== OrderItem::class)){
            throw new Exception('the object cannot will added or remove to the collection');
        }

        return true;
    }
}