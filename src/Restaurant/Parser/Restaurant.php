<?php

namespace App\Restaurant\Parser;

use Doctrine\Common\Collections\Collection;

class Restaurant
{
    public string $name;
    public string $minDeliveryPrice;
    public string $deliveryCost;
    public Collection $dishes;

    public function __construct(string $name, string $minDeliveryPrice, string $deliveryCost, Collection $dishes)
    {
        $this->name = $name;
        $this->minDeliveryPrice = $minDeliveryPrice;
        $this->deliveryCost = $deliveryCost;
        $this->dishes = $dishes;
    }
}