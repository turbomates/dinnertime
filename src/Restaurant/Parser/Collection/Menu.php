<?php

namespace App\Restaurant\Parser\Collection;

use App\Restaurant\Parser\Dish;

class Menu implements \IteratorAggregate
{
    public array $dish = [];

    public function getIterator() : \ArrayIterator
    {
        return new \ArrayIterator($this->dish);
    }

    public function add(Dish $dish) : bool
    {
        $this->dish[] = $dish;

        return true;
    }
}