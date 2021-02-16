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

    public function add(User $user) : void
    {
        $this->em->persist($user);
    }

    public function findByEmail(string $email) : void
    {
       $this->em->createQueryBuilder()
           ->select('u')
           ->from(User::class, 'u')
           ->andWhere('u.email.email = :email')
           ->setParameter('email', $email)
           ->getQuery()
           ->getOneOrNullResult();
    }
}