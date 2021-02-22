<?php

namespace App\User\Infrastructure\QueryObject;

use App\Core\Infrastructure\QueryHandler\QueryObjectInterface;
use App\User\Domain\User;
use App\User\Domain\ValueObject\UserId;
use Doctrine\ORM\EntityManagerInterface;

class UserQuery implements QueryObjectInterface
{
    private UserId $userId;

    public function __construct(UserId $userId)
    {
        $this->userId = $userId;
    }

    public function execute(EntityManagerInterface $em) : array
    {
        return $user = $em->createQueryBuilder()
            ->select(
                'u.email.email as email, 
                u.id.id as id, u.name.firstName as firstName, 
                u.name.lastName as lastName, 
                u.phoneNumber.phoneNumber as phoneNumber')
            ->from(User::class, 'u')
            ->andWhere('u.id.id = :id')
            ->setParameter('id', $this->userId->id())
            ->getQuery()
            ->getOneOrNullResult();
    }
}