<?php

namespace App\Order\Domain\ValueObject;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable()
 */
class Price
{
    /**
     * @ORM\Column(name="dish_price", type="float")
     */
    private float $price;

    public function __construct(float $price)
    {
        $this->price = $price;
    }

    public function price() : float
    {
        return $this->price;
    }
}