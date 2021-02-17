<?php

namespace App\User\Application;

use App\Core\Infrastructure\Repository\UserRepositoryInterface;
use App\User\Domain\User;

class UserHandler
{
    private UserRepositoryInterface $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function user() : User
    {
        return $this->repository->getUser();
    }
}