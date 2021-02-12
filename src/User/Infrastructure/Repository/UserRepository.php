<?php


namespace App\User\Infrastructure\Repository;

use App\User\Domain\User;
use App\Core\Infrastructure\Repository\UserRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class UserRepository implements UserRepositoryInterface
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;

    }

    public function add()
    {

    }

    public function findByEmail()
    {

    }
}