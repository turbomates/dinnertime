<?php

namespace App\Order\Domain\ValueObject\OrderItem;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

/**
 * @ORM\Embeddable()
 */
class UserId
{
    /**
     * @ORM\Column(name="user_id", type="uuid", unique=true)
     */
    private Uuid $id;

    public function __construct()
    {
        $this->id = Uuid::v4();
    }
}