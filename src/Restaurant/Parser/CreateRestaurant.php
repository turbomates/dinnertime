<?php

namespace App\Restaurant\Parser;

use App\Restaurant\Parser\Collection\Menu;

class CreateRestaurant
{
    public string $name;
    public float $minDeliveryPrice;
    public float $deliveryCost;
    public Menu $menu;

    public function __construct(string $name, float $minDeliveryPrice, float $deliveryCost, Menu $menu)
    {
        $this->name = $name;
        $this->minDeliveryPrice = $minDeliveryPrice;
        $this->deliveryCost = $deliveryCost;
        $this->menu = $menu;
    }
}