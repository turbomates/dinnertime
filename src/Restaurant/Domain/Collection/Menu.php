<?php

namespace App\Restaurant\Domain\Collection;

use App\Core\Domain\ArrayTypeCollection;
use App\Restaurant\Domain\Dish;
use App\Restaurant\Domain\Restaurant;
use Symfony\Component\Config\Definition\Exception\Exception;

class Menu extends ArrayTypeCollection
{
    public function isSupport($element) : bool
    {
        if (!is_object($element) && (get_class($element) !== Dish::class)){
           throw new Exception('the object cannot will added or remove to the collection');
        }

        return true;
    }
}