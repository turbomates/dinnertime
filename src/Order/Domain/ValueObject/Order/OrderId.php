<?php

namespace App\Order\Domain\ValueObject\Order;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

/**
 * @ORM\Embeddable()
 */
class OrderId
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