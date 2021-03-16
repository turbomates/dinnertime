<?php

namespace App\Order\Domain\ValueObject\OrderItem;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable()
 */
class TotalPrice
{
    /**
     * @ORM\Column(name="total_price", type="float")
     */
    private float $price;

    public function __construct(float $price)
    {
        $this->price = $price;
    }
}