<?php

namespace App\Order\Domain\ValueObject;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

/**
 * @ORM\Embeddable()
 */
class UserId
{
    /**
     * @ORM\Column(name="user_id", type="uuid")
     */
    private Uuid $id;

    public function __construct(Uuid $id)
    {
        $this->id = $id;
    }

    public function id() : Uuid
    {
        return $this->id;
    }
}