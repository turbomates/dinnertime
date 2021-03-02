<?php

namespace App\Restaurant\Domain\Collection;

use App\Restaurant\Domain\Dish;

class DishCollection implements \IteratorAggregate
{
    public array $dishes = [];

    public function getIterator() : \ArrayIterator
    {
        return new \ArrayIterator($this->dishes);
    }

    public function add(Dish $dishes) : bool
    {
        $this->dishes[] = $dishes;

        return true;
    }
}