<?php

namespace App\User\Domain\ValueObject;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable()
 */
class Email
{
    /**
     * @ORM\Column(name="email", type="string", length=100)
     */
    private string $email;

    public function __construct(string $email)
    {
        $this->email = $email;
    }
}