<?php

namespace App\Restaurant\Domain\Collection;

use App\Core\Domain\ArrayTypeCollection;
use App\Restaurant\Domain\Dish;
use Symfony\Component\Config\Definition\Exception\Exception;

class Menu extends ArrayTypeCollection
{
    public function isSupport($element) : bool
    {
        if (get_class($element) !== Dish::class){
           throw new Exception('the object cannot will added to the collection');
        }

        return true;
    }
}