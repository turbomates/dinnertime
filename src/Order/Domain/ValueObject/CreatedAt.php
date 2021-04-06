<?php

namespace App\Order\Domain\ValueObject;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable()
 */
class CreatedAt
{
    /**
     * @ORM\Column(name="created_at", type="datetime")
     */
    private \DateTime $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }
}