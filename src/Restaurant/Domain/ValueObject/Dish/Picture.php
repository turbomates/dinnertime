<?php

namespace App\Restaurant\Domain\ValueObject\Dish;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable()
 */
class Picture
{
    /**
     * @ORM\Column(name="picture", type="string", length=255)
     */
    private string $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }
}