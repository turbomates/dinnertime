<?php

namespace App\Restaurant\Domain\ValueObject\Dish;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable()
 */
class Price
{
    /**
     * @ORM\Column(name="amount", type="float", length=10)
     */
    private float $amount;

    public function __construct(float $amount)
    {
        $this->amount = $amount;
    }
}