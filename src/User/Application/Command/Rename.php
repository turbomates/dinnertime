<?php

namespace App\User\Application\Command;

use App\User\Domain\User;

class Rename
{
    public string $firstName;
    public string $lastName;
    public User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
}