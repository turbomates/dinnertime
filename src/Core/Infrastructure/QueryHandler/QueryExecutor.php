<?php

namespace App\Core\Infrastructure\QueryHandler;

use Doctrine\ORM\EntityManagerInterface;

class QueryExecutor
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function execute(QueryObjectInterface $queryObject) : array
    {
       return $queryObject->execute($this->em);
    }
}