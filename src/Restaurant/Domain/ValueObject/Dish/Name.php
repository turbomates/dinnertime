<?php

namespace App\Restaurant\Domain\ValueObject\Dish;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable()
 */
class Name
{
    /**
     * @ORM\Column(name="name", type="string", length=100)
     */
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}