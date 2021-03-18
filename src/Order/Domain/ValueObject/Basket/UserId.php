<?php

namespace App\Order\Domain\ValueObject\Basket;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable()
 */
class UserId
{
    /**
     * @ORM\Column(name="user_id", type="string")
     */
    private string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }
}