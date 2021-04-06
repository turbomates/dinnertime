<?php

namespace App\Order\Domain\ValueObject\Order;

use App\Order\Domain\ValueObject\UserId;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable()
 */
class User
{
    /**
     * @ORM\Embedded(class="App\Order\Domain\ValueObject\UserId", columnPrefix="order_")
     * @var UserId
     */
    private UserId $id;
    /**
     * @ORM\Column(name="user_info", type="json", length=255)
     */
    private array $userInfo;

    public function __construct(UserId $userId, array $userInfo)
    {
        $this->userInfo = $userInfo;
        $this->id = $userId;
    }

    public function id() : UserId
    {
        return $this->id;
    }
}