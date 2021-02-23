<?php

namespace App\Restaurant\Domain\ValueObject\Dish;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

/**
 * @ORM\Embeddable()
 */
class DishId
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\Column(name="id", type="uuid", unique=true)
     */
    private Uuid $id;

    public function __construct()
    {
        $this->id = Uuid::v4();
    }
}