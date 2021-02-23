<?php

namespace App\Restaurant\Domain\ValueObject\Dish;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable()
 */
class Price
{
    /**
     * @ORM\Column(name="price", type="float", length=10)
     */
    private float $price;

    public function __construct(float $price)
    {
        $this->price = $price;
    }
}