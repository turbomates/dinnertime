<?php

namespace App\User\Application\Command;

use App\User\Domain\User;

class ChangePhoneNumber
{
    public string $phoneNumber;
    public User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
}