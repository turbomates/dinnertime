<?php

namespace App\User\Domain;

use App\User\Domain\User;
use App\User\Domain\ValueObject\Email;

interface UserRepositoryInterface
{
    public function persist(User $user) : void;

    public function findByEmail(Email $email) : ?User;
}