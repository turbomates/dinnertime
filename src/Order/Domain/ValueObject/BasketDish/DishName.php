<?php

namespace App\Order\Domain\ValueObject\BasketDish;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable()
 */
class DishName
{
    /**
     * @ORM\Column(name="dish_name", type="string")
     */
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}