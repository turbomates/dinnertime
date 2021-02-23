<?php

namespace App\Restaurant\Domain\ValueObject\Dish;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable()
 */
class Picture
{
    /**
     * @ORM\Column(name="picture", type="string", length=100)
     */
    private string $picture;

    public function __construct(string $picture)
    {
        $this->picture = $picture;
    }
}