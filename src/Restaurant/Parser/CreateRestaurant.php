<?php

namespace App\Restaurant\Parser;

use App\Restaurant\Parser\Collection\Menu;

class CreateRestaurant
{
    public string $name;
    public string $minDeliveryPrice;
    public string $deliveryCost;
    public Menu $menu;

    public function __construct(string $name, string $minDeliveryPrice, string $deliveryCost, Menu $menu)
    {
        $this->name = $name;
        $this->minDeliveryPrice = $minDeliveryPrice;
        $this->deliveryCost = $deliveryCost;
        $this->menu = $menu;
    }
}