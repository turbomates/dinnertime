<?php

namespace App\Restaurant\Domain\ValueObject\Dish;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable()
 */
class Description
{
    /**
     * @ORM\Column(name="description", type="string", length=255)
     */
    private string $description;

    public function __construct(string $description)
    {
        $this->description = $description;
    }
}