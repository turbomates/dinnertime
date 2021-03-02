<?php

namespace App\Restaurant\Parser;

use App\Restaurant\Parser\Collection\MenuCollection;

class CreateRestaurant
{
    public string $name;
    public string $minDeliveryPrice;
    public string $deliveryCost;
    public MenuCollection $menu;

    public function __construct(string $name, string $minDeliveryPrice, string $deliveryCost, MenuCollection $menu)
    {
        $this->name = $name;
        $this->minDeliveryPrice = $minDeliveryPrice;
        $this->deliveryCost = $deliveryCost;
        $this->menu = $menu;
    }
}