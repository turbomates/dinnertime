<?php

namespace App\Core\Infrastructure\Repository;

use App\User\Domain\User;
use App\User\Domain\ValueObject\Email;

interface UserRepositoryInterface
{
    public function persist(User $user);

    public function findByEmail(Email $email);
}