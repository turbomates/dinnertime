<?php

namespace App\User\Domain\ValueObject;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable()
 */
class Name
{
    /**
     * @ORM\Column(name="first_name", type="string", length=100, nullable=true)
     */
    private ?string $firstName;
    /**
     * @ORM\Column(name="last_name", type="string", length=100, nullable=true)
     */
    private ?string $lastName;

    public function __construct(?string $firstName, ?string $lastName)
    {
            $this->firstName = $firstName;
            $this->lastName = $lastName;
    }
}