<?php

namespace App\Order\Domain\ValueObject\Order;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

/**
 * @ORM\Embeddable()
 */
class UserOrderId
{
    /**
     * @ORM\Column(name="user_order_id", type="uuid")
     */
    private Uuid $id;

    public function __construct()
    {
        $this->id = Uuid::v4();
    }
}