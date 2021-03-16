<?php

namespace App\Order\Domain\ValueObject\BasketDish;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable()
 */
class DishPrice
{
    /**
     * @ORM\Column(name="dish_price", type="float")
     */
    private float $price;

    public function __construct(float $price)
    {
        $this->price = $price;
    }
}