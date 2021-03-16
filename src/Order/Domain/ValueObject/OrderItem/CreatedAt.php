<?php

namespace App\Order\Domain\ValueObject\OrderItem;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * @ORM\Embeddable()
 */
class CreatedAt
{
    /**
     * @ORM\Column(name="created_at", type="datetime")
     */
    private DateTime $createdAt;

    public function __construct()
    {
        $this->createdAt = new DateTime();
    }
}