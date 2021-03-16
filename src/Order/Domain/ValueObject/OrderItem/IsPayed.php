<?php

namespace App\Order\Domain\ValueObject\OrderItem;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable()
 */
class IsPayed
{
    /**
     * @ORM\Column(name="is_payed", type="string", length=10)
     */
    private string $isPayed;

    public function __construct(string $isPayed)
    {
        $this->isPayed = $isPayed;
    }
}