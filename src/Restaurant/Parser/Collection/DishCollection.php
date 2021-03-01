<?php

namespace App\Restaurant\Parser\Collection;

class DishCollection implements \IteratorAggregate
{
    public array $dishes = [];

    public function getIterator() : \ArrayIterator
    {
        return new \ArrayIterator($this->dishes);
    }

    public function add($dish) : bool
    {
        $this->dishes[] = $dish;

        return true;
    }

    public function getDishes() : array
    {
        return $this->dishes;
    }
}