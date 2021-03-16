<?php

namespace App\Restaurant\Domain\ValueObject\Dish;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable()
 */
class Weight
{
    /**
     * @ORM\Column(name="weight", type="smallint", length=5)
     */
    private int $weight;

    public function __construct(int $weight)
    {
        $this->weight = $weight;
    }
}