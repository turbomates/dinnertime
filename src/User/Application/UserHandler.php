<?php

namespace App\User\Application;

use App\Core\Infrastructure\Repository\UserRepositoryInterface;
use App\User\Application\Command\ChangePhoneNumber;
use App\User\Application\Command\Rename;
use App\User\Domain\User;
use App\User\Domain\ValueObject\Name;
use App\User\Domain\ValueObject\PhoneNumber;

class UserHandler
{
    private UserRepositoryInterface $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function rename(Rename $renameCommand)
    {
        $name = new Name($renameCommand->firstName, $renameCommand->lastName);
        $renameCommand->user->rename($name);
        $this->repository->persist($renameCommand->user);
    }

    public function changePhoneNumber(ChangePhoneNumber $changeNumberCommand)
    {
        $phoneNumber = new PhoneNumber($changeNumberCommand->phoneNumber);
        $changeNumberCommand->user->changePhoneNumber($phoneNumber);
        $this->repository->persist($changeNumberCommand->user);
    }
}