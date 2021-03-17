<?php

namespace App\Order\Domain\ValueObject\OrderItem;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable()
 */
class IsPayed
{
    /**
     * @ORM\Column(name="is_payed", type="boolean", length=10)
     */
    private bool $isPayed;

    public function __construct(bool $isPayed)
    {
        $this->isPayed = $isPayed;
    }
}