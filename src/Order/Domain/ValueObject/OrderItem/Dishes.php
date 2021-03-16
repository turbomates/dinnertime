<?php

namespace App\Order\Domain\ValueObject\OrderItem;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable()
 */
class Dishes
{
    /**
     * @ORM\Column(name="dishes", type="json", length=255)
     */
    private string $dishes;

    public function __construct(string $dishes)
    {
        $this->dishes = $dishes;
    }
}