<?php

namespace App\User\Domain\ValueObject;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Embeddable()
 */
class PhoneNumber
{
    /**
     * @ORM\Column(name="phone_number", type="string", length=15, nullable=true)
     * @Assert\Length(min=7, max=13)
     * @Assert\Regex(pattern="/^[0-9+]*$/")
     */
    private string $phoneNumber;

    public function __construct(string $phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }
}