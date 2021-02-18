<?php

namespace App\User\Domain\ValueObject;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

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
        $this->validate($email);
        $this->email = $email;
    }

    public function address(): string
    {
        return $this->email;
    }

    private function validate(string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new BadRequestException('not valid email');
        }

        return true;
    }
}