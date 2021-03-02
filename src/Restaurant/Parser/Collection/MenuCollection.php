<?php

namespace App\Restaurant\Parser\Collection;

use App\Restaurant\Parser\Menu;

class MenuCollection implements \IteratorAggregate
{
    public array $menu = [];

    public function getIterator() : \ArrayIterator
    {
        return new \ArrayIterator($this->menu);
    }

    public function add(Menu $menu) : bool
    {
        $this->menu[] = $menu;

        return true;
    }

    public function getDishes() : array
    {
        return $this->menu;
    }
}