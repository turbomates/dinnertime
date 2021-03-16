<?php

namespace App\User\Application;

use App\User\Application\Command\ChangePhoneNumber;
use App\User\Application\Command\Rename;
use App\User\Domain\UserRepository;
use App\User\Domain\ValueObject\Name;
use App\User\Domain\ValueObject\PhoneNumber;

class UserHandler
{
    private UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function rename(Rename $renameCommand) : void
    {
        $name = new Name($renameCommand->firstName, $renameCommand->lastName);
        $user = $renameCommand->user;
        $user->rename($name);
        $this->repository->persist($user);
    }

    public function changePhoneNumber(ChangePhoneNumber $changeNumberCommand) : void
    {
        $phoneNumber = new PhoneNumber($changeNumberCommand->phoneNumber);
        $user = $changeNumberCommand->user;
        $user->changePhoneNumber($phoneNumber);
        $this->repository->persist($user);
    }
}