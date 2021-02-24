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
     * @ORM\Embedded(class="App\Restaurant\Domain\ValueObject\Dish\Price")
     */
    private Price $minPrice;
    /**
     * @ORM\Embedded(class="App\Restaurant\Domain\ValueObject\Dish\Price")
     */
    private Price $cost;

    public function __construct(Price $minPrice, Price $cost)
    {
        $this->minPrice = $minPrice;
        $this->cost = $cost;
    }
}