<?php

namespace App\Order\Domain\ValueObject\BasketDish;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

/**
 * @ORM\Embeddable()
 */
class DishId
{
    /**
     * @ORM\Column(name="dish_id", type="uuid")
     */
    private Uuid $id;

    public function __construct()
    {
        $this->id = Uuid::v4();
    }
}