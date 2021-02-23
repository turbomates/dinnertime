<?php

namespace App\Restaurant\Domain\ValueObject\Dish;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable()
 */
class Weight
{
    /**
     * @ORM\Column(name="weight", type="float", length=5)
     */
    private float $weight;

    public function __construct(float $weight)
    {
        $this->weight = $weight;
    }
}