<?php

namespace App\User\Infrastructure\Repository;

use App\User\Domain\User;
use App\User\Domain\UserRepositoryInterface;
use App\User\Domain\ValueObject\Email;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;

class UserRepository implements UserRepositoryInterface
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function persist(User $user) : void
    {
        $this->em->persist($user);
    }

    public function findByEmail(Email $email) : ?User
    {
        return $this->createQueryBuilder()
            ->andWhere('u.email.email = :email')
            ->setParameter('email', $email->address())
            ->getQuery()
            ->getOneOrNullResult();
    }

    private function createQueryBuilder() : QueryBuilder
    {
        return $this->em->createQueryBuilder()
            ->select('u')
            ->from(User::class, 'u');
    }
}