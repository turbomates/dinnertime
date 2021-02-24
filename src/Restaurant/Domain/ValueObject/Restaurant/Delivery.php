<?php

namespace App\Restaurant\Domain\ValueObject\Restaurant;

use App\Restaurant\Domain\ValueObject\Dish\Price;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable()
 */
class Delivery
{
    /**
     * @ORM\Column(type="float", length=10)
     */
    private Price $minPrice;
    /**
     * @ORM\Column(type="float", length=10)
     */
    private Price $cost;

    public function __construct(Price $minPrice, Price $cost)
    {
        $this->minPrice = $minPrice;
        $this->cost = $cost;
    }
}