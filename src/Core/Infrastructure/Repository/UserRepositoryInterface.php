<?php


namespace App\Core\Infrastructure\Repository;


use App\User\Domain\User;
use App\User\Infrastructure\Repository\UserRepository;

interface UserRepositoryInterface
{
    public function add(User $user);

    public function findByEmail($email);
}