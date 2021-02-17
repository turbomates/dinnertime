<?php

namespace App\User\Domain\ValueObject;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable()
 */
class PhoneNumber
{
    /**
     * @ORM\Column(name="phone_number", type="string", length=15, nullable=true)
     */
    private string $phoneNumber;

    public function __construct(string $phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }
}