<?php

namespace App\Restaurant\Parser\Collection;

use App\Restaurant\Parser\Dish;

class Menu implements \IteratorAggregate
{
    public array $menu = [];

    public function getIterator() : \ArrayIterator
    {
        return new \ArrayIterator($this->menu);
    }

    public function add(Dish $menu) : bool
    {
        $this->menu[] = $menu;

        return true;
    }

    public function getDishes() : array
    {
        return $this->menu;
    }
}