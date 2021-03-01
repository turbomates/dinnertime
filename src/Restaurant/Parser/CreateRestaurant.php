<?php

namespace App\Restaurant\Parser;

use App\Restaurant\Parser\Collection\DishCollection;

class CreateRestaurant
{
    public string $name;
    public string $minDeliveryPrice;
    public string $deliveryCost;
    public DishCollection $dishes;

    public function __construct(string $name, string $minDeliveryPrice, string $deliveryCost, DishCollection $dishes)
    {
        $this->name = $name;
        $this->minDeliveryPrice = $minDeliveryPrice;
        $this->deliveryCost = $deliveryCost;
        $this->dishes = $dishes;
    }
}